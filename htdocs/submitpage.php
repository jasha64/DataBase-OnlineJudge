<?php
    require_once('./include/db_info.inc.php');
    require_once('./include/const.inc.php');
    require_once('./include/memcache.php');
	require_once('./include/setlang.php');
	$view_title=$MSG_SUBMIT;
 if (!isset($_SESSION[$OJ_NAME.'_'.'user_id'])){

	$view_errors= "<a href=loginpage.php>$MSG_Login</a>";
	require("template/".$OJ_TEMPLATE."/error.php");
	exit(0);
//	$_SESSION[$OJ_NAME.'_'.'user_id']="Guest";
}
$problem_id=1000;
if (isset($_GET['id'])){
	$id=intval($_GET['id']);
        $sample_sql = "select sample_input, sample_output, problem_id from problem where problem_id = ?";
}else{
	$view_errors=  "<h2>No Such Problem!</h2>";
	require("template/".$OJ_TEMPLATE."/error.php");
	exit(0);
}


 $view_src="";
 if(isset($_GET['sid'])){
	$sid=intval($_GET['sid']);
	$sql = "select * from submission where submission_id = ?";
	$result = pdo_query($sql, $sid);
	 $row = $result[0];
	if ($row && $row['username']==$_SESSION[$OJ_NAME.'_'.'user_id']) $ok=true;
	if (isset($_SESSION[$OJ_NAME.'_'.'source_browser'])) {
		$ok=true;
	}else{
		if(isset($OJ_EXAM_CONTEST_ID)){
			if($cid<$OJ_EXAM_CONTEST_ID&&!isset($_SESSION[$OJ_NAME.'_'.'source_browser'])){
				header("Content-type: text/html; charset=utf-8");
				 echo $MSG_SOURCE_NOT_ALLOWED_FOR_EXAM;
				 exit();
			}
		}
	
	}
	
	if ($ok==true){
		$sql = "select source from submission where submission_id = ?";
		$result = pdo_query($sql, $sid);
		$row=$result[0];
		if($row)
			$view_src=$row['source'];
		
	}
	
 }
if(isset($id))$problem_id = $id;
$view_sample_input = "1 2";
$view_sample_output = "3";
 if(isset($sample_sql)){
   //echo $sample_sql;
   if (isset($_GET['id'])){
		$result = pdo_query($sample_sql, $id);
   }else{
		$result = pdo_query($sample_sql, $problem_id);
   }
	 
   if($result == false)
   {
	   $view_errors=  "<h2>No Such Problem!</h2>";
	   require("template/".$OJ_TEMPLATE."/error.php");
	   exit(0);
   }

	$row=$result[0];
	$view_sample_input=$row[0];
	$view_sample_output=$row[1];
	$problem_id=$row[2];
	
	
	
 }
 
if(!$view_src){
	if(isset($_COOKIE['lastlang'])) 
		$lastlang=intval($_COOKIE['lastlang']);
	else 
		$lastlang=0; //cookie
   $template_file="$OJ_DATA/$problem_id/template.".$language_ext[$lastlang];
   if(file_exists($template_file)){
	$view_src=file_get_contents($template_file);
   }

}
	$sql = "select count(1) from submission where result < 4";
	$result = mysql_query_cache($sql); //查询是否可能有恶意卡OJ的行为
	 $row=$result[0];
	if($row[0]>10) {
		$OJ_VCODE=true;
//		$OJ_TEST_RUN=false;
//		echo "$row[0]";
	}
	


/////////////////////////Template
require("template/".$OJ_TEMPLATE."/submitpage.php");
/////////////////////////Common foot
?>

