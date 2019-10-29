<?php
        $cache_time=1;
        $OJ_CACHE_SHARE=false;
        require_once('./include/cache_start.php');
    require_once('./include/db_info.inc.php');
        require_once('./include/setlang.php');
        $view_title= "Welcome To Online Judge";
require_once("./include/const.inc.php");

if(isset($_GET['id']))$id=intval($_GET['id']);
if (isset($_GET['page']))
        $page=strval(intval($_GET['page']));
else $page=0;

?>

<?php
$view_problem=array();

// total submit
$sql = "select count(*) from submission where problem_id = ?";
$result = pdo_query($sql, $id) ;
$row=$result[0];
$view_problem[0][0]=$MSG_SUBMIT;
$view_problem[0][1]=$row[0];
$total=intval($row[0]);


// total users
$sql = "select count(distinct username) from submission where problem_id = ?";
$result = pdo_query($sql, $id);
$row=$result[0];

$view_problem[1][0]="$MSG_USER($MSG_SUBMIT)";
$view_problem[1][1]=$row[0];


// ac users
$sql = "select count(distinct username) from submission where problem_id = ? and result = 4";
$result = pdo_query($sql, $id);
 $row=$result[0];
$acuser=intval($row[0]);

$view_problem[2][0]="$MSG_USER($MSG_SOVLED)";
$view_problem[2][1]=$row[0];


//for ($i=4;$i<12;$i++){
        $i=3;
        $sql = "select result, count(1) from submission where problem_id = ? and result >= 4 group by result"; //result >= 4的意思是已经评测完的提交
        $result = pdo_query($sql, $id);
        foreach($result as $row){

                $view_problem[$i][0] =$jresult[$row[0]];
                $view_problem[$i][1] ="<a href=status.php?problem_id=$id&jresult=".$row[0]." >".$row[1]."</a>";
                $i++;
        }
        

//}

?>


<?php $pagemin=0; $pagemax=intval(($acuser-1)/20);

if ($page<$pagemin) $page=$pagemin;
if ($page>$pagemax) $page=$pagemax;
$start=$page*20;
$sz=20;
if ($start+$sz>$acuser) $sz=$acuser-$start;



// check whether the problem in a contest


// check whether the problem is ACed by user
$AC=false;
if (isset($OJ_AUTO_SHARE)&&$OJ_AUTO_SHARE&&isset($_SESSION[$OJ_NAME.'_'.'user_id'])){
        $sql = "select 1 from submission where problem_id = ? and result = 4 and username = ?";
        $rrs = pdo_query($sql, $id, $_SESSION[$OJ_NAME.'_'.'user_id']);
        $AC=(intval(count($rrs))>0);
        
}
//check whether user has the right of view solutions of this problem
//echo "checking...";
if(isset($_SESSION[$OJ_NAME.'_'.'user_id'])){
	if(isset($_SESSION[$OJ_NAME.'_'.'s'.$id])){
		$AC=true;
	//	echo "Yes";
	//}else{
		//$sql="select count(1) from privilege where user_id=? and rightstr=?";
		//$count=pdo_query($sql,$_SESSION[$OJ_NAME.'_'.'user_id'],"s".$id);
		//if($count&&$count[0][0]>0){
			//$AC=true;
		//}else{
			//echo "not right";
		//}

	}
}
$sql = "select * from (
  select username, count(*) as att, min(10000000000000000000 + run_time * 100000000000 + run_memory * 100000 + code_len) as score
  from submission
  where problem_id = ? and result = 4
  group by username
  order by score, submit_time desc
) as c
natural inner join (
  select submission_id, username, language, submit_time, (10000000000000000000 + run_time * 100000000000 + run_memory * 100000 + code_len) as score
  from submission
  where problem_id = ? and result = 4  
  order by score, submit_time desc
) as b
order by score, submit_time
limit $start, $sz;";

$result=pdo_query( "SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''))");
$result = pdo_query($sql, $id, $id);

$view_solution=array();
$j=0;
$last_user_id='';
$i=$start+1;
foreach($result as $row){
        if($row['username']==$last_user_id) continue;
        $sscore=strval($row['score']);
        $s_time=intval(substr($sscore,1,8));
        $s_memory=intval(substr($sscore,9,6));
        $s_cl=intval(substr($sscore,15,5));

        $view_solution[$j][0]= $i;
        $view_solution[$j][1]= $row['submission_id'];
        if (intval($row['att'])>1) $view_solution[$j][1].=  "(".$row['att'].")";
        $view_solution[$j][2]=  "<a href='userinfo.php?user=".$row['username']."'>".$row['username']."</a>";
        $view_solution[$j][3]=  "$s_memory KB";

        $view_solution[$j][4]=  "$s_time MS";

        if (!(isset($_SESSION[$OJ_NAME.'_'.'user_id'])&&!strcasecmp($row['username'],$_SESSION[$OJ_NAME.'_'.'user_id']) ||
                isset($_SESSION[$OJ_NAME.'_'.'administrator'])||
                (isset($OJ_AUTO_SHARE)&&$OJ_AUTO_SHARE&&$AC))){
                $view_solution[$j][5]= $language_name[$row['language']];
        }else{
                $view_solution[$j][5]=  "<a target=_blank href=showsource.php?id=".$row['submission_id'].">".$language_name[$row['language']]."</a>";
        }
        $view_solution[$j][6]=  "$s_cl B";
        $view_solution[$j][7]=  $row['submit_time'];
        $j++;
        $last_user_id=$row['username'];
	$i++;
}


$view_recommand=Array();
if(isset($_GET['id'])){
  $id=intval($_GET['id']);
        if(isset($_SESSION[$OJ_NAME.'_'.'user_id']))$user_id=($_SESSION[$OJ_NAME.'_'.'user_id']);
	$sql = "select source from problem where problem_id = ?";
	$result = pdo_query($sql, $id);
	$source=$result[0][0];
        $sql = "select problem_id from problem where source like ? and problem_id != ? limit 10"; //从数据库中查询源码，并通过源码相似度推荐相似题目

        $result=pdo_query( $sql,"%$source%",$id);
        $i=0;
         foreach($result as $row){
                $view_recommand[$i][0]=$row['problem_id'];
                $i++;
        }
        
}

/////////////////////////Template
require("template/".$OJ_TEMPLATE."/problemstatus.php");
/////////////////////////Common foot
if(file_exists('./include/cache_end.php'))
        require_once('./include/cache_end.php');
?>

