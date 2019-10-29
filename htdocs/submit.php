<?php session_start();
require_once("include/db_info.inc.php");
if (!isset($_SESSION[$OJ_NAME.'_'.'user_id'])){
	require_once("oj-header.php");
	echo "<a href='loginpage.php'>$MSG_Login</a>";
	require_once("oj-footer.php");
	exit(0);
}
require_once("include/memcache.php");
require_once("include/const.inc.php");
$now=strftime("%Y-%m-%d %H:%M",time());
$user_id=$_SESSION[$OJ_NAME.'_'.'user_id'];

        $sql = "select count(1) from submission where result < 4";
        $result = mysql_query_cache($sql); //防止恶意卡OJ
         $row=$result[0];
        if($row[0]>50) $OJ_VCODE=true;
        
if($OJ_VCODE)$vcode=$_POST["vcode"];
$err_str="";
$err_cnt=0;
if($OJ_VCODE&&($_SESSION[$OJ_NAME.'_'."vcode"]==null||$vcode!= $_SESSION[$OJ_NAME.'_'."vcode"]||$vcode==""||$vcode==null) ){
        $_SESSION[$OJ_NAME.'_'."vcode"]=null;
        $err_str=$err_str."Verification Code Wrong!\\n";
        $err_cnt++;
	require("template/".$OJ_TEMPLATE."/error.php");
	
	exit(0);
}

if (isset($_POST['cid'])){
	
}else{
	$id=intval($_POST['id']);
	$sql = "select problem_id from problem where problem_id = '$id' ";
}
//echo $sql;	

$res=mysql_query_cache($sql);
if (isset($res)&&count($res)<1&&!isset($_SESSION[$OJ_NAME.'_'.'administrator'])&&!((isset($cid)&&$cid<=0)||(isset($id)&&$id<=0))){
		
		$view_errors=  "Where do find this link? No such problem.<br>";
		require("template/".$OJ_TEMPLATE."/error.php");
		exit(0);
}




$test_run=false;
if (isset($_POST['id'])) {
	$id=intval($_POST['id']);
        $test_run=($id<=0);
}else if (isset($_POST['pid']) && isset($_POST['cid'])&&$_POST['cid']!=0){
	$pid=intval($_POST['pid']);
	$cid=intval($_POST['cid']);
        $test_run=($cid<0);
	if($test_run) $cid=-$cid;
	// check user if private
	
}else{
       $id=0;
/*
	$view_errors= "No Such Problem!\n";
	require("template/".$OJ_TEMPLATE."/error.php");
	exit(0);
*/
       $test_run=true;
}
$language=intval($_POST['language']);
if ($language>count($language_name) || $language<0) $language=0;
$language=strval($language);


$source=$_POST['source'];
$input_text="";
if(isset($_POST['input_text']))$input_text=$_POST['input_text'];
if(get_magic_quotes_gpc()){
	$source=stripslashes($source);
	$input_text=stripslashes($input_text);
}
if(isset($_POST['encoded_submit'])){
   $source=base64_decode($source);
}


$input_text=preg_replace ( "(\r\n)", "\n", $input_text );
$source=($source);
$input_text=($input_text);
$source_user=$source;
if($test_run) $id=-$id;
//use append Main code
$prepend_file="$OJ_DATA/$id/prepend.".$language_ext[$language];
if(isset($OJ_APPENDCODE)&&$OJ_APPENDCODE&&file_exists($prepend_file)){
     $source=file_get_contents($prepend_file)."\n".$source;
}
$append_file="$OJ_DATA/$id/append.".$language_ext[$language];
//echo $append_file;
if(isset($OJ_APPENDCODE)&&$OJ_APPENDCODE&&file_exists($append_file)){
     $source.=("\n".file_get_contents($append_file));
     //echo "$source";
}
//end of append 
if($language==6)
   $source="# coding=utf-8\n".$source;
if($test_run) $id=0;

$len=strlen($source);
//echo $source;




setcookie('lastlang',$language,time()+360000);

$ip = ($_SERVER['REMOTE_ADDR']);
if( !empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ){
    $REMOTE_ADDR = $_SERVER['HTTP_X_FORWARDED_FOR'];
    $tmp_ip=explode(',',$REMOTE_ADDR);
    $ip =(htmlentities($tmp_ip[0],ENT_QUOTES,"UTF-8"));
}
if ($len<2){
	$view_errors="Code too short!<br>";
	require("template/".$OJ_TEMPLATE."/error.php");
	exit(0);
}
if ($len>65536){
	$view_errors="Code too long!<br>";
	require("template/".$OJ_TEMPLATE."/error.php");
	exit(0);
}

// last submit
$now=strftime("%Y-%m-%d %X",time()-10);
$sql = "select in_date from submission where in_date > ? and user_id = ? order by in_date desc limit 1"; //禁止用户频繁提交（查询上一次提交时间）
$res=pdo_query($sql,$user_id,$now);
if (count($res)==1){
	
		$view_errors="You should not submit more than twice in 10 seconds.....<br>";
		require("template/".$OJ_TEMPLATE."/error.php");
		exit(0);
	
}


{

	$sql = "select max(submission_id) from submission";
	$result = pdo_query($sql);
	$sid = $result[0][0] + 1;
	$sql = "insert into submission(submission_id, problem_id, username, submit_time, language, source, code_len, result) values(?, ?, ?, NOW(), ?, ?, ?, 14)";
	pdo_query($sql, $sid, $id, $user_id, $language, $source, $len);
		
	$sql = "update submission set result = 0 where submission_id = ?";
	pdo_query($sql, $sid); //设置result初值，送core评测
}


	 $statusURI=strstr($_SERVER['REQUEST_URI'],"submit",true)."status.php";
	 if (isset($cid)) 
	    $statusURI.="?cid=$cid";
	    
        $sid="";
        if (isset($_SESSION[$OJ_NAME.'_'.'user_id'])){
                $sid.=session_id().$_SERVER['REMOTE_ADDR'];
        }
        if (isset($_SERVER["REQUEST_URI"])){
                $sid.=$statusURI;
        }
   // echo $statusURI."<br>";
  
        $sid=md5($sid);
        $file = "cache/cache_$sid.html";
    //echo $file;  
    if($OJ_MEMCACHE){
		$mem = new Memcache;
                if($OJ_SAE)
                        $mem=memcache_init();
                else{
                        $mem->connect($OJ_MEMSERVER,  $OJ_MEMPORT);
                }
        $mem->delete($file,0);
    }
	else if(file_exists($file)) 
	     unlink($file);
    //echo $file;
    
  $statusURI="status.php?user_id=".$_SESSION[$OJ_NAME.'_'.'user_id'];
  if (isset($cid))
	    $statusURI.="&cid=$cid";
	 
   if(!$test_run){	
	header ("Location: $statusURI");
   }else{
   	if(isset($_GET['ajax'])){
                echo $insert_id;
        }else{
		?><script>window.parent.setTimeout("fresh_result('<?php echo $insert_id;?>')",1000);</script><?php
        }
   }
?>
