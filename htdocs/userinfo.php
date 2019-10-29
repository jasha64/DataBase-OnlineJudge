<?php
 $cache_time=10; 
 $OJ_CACHE_SHARE=false;
	require_once('./include/cache_start.php');
    require_once('./include/db_info.inc.php');
	require_once('./include/setlang.php');
	require_once("./include/const.inc.php");
	require_once("./include/my_func.inc.php");
 // check user
$user=$_GET['user'];
if (!is_valid_user_name($user)){
	echo "No such User!";
	exit(0);
}
$view_title=$user ."@".$OJ_NAME;
$sql = "select nick, school, email from user where username = ?";
$result = pdo_query($sql, $user);
$row_cnt=count($result);
if ($row_cnt==0){ 
	$view_errors= "No such User!";
	require("template/".$OJ_TEMPLATE."/error.php");
	exit(0);
}

 $row=$result[0];
$school=$row['school'];
$email=$row['email'];
$nick=$row['nick'];

// count solved
$sql = "select count(distinct problem_id) as ac from submission where username = ? and result = 4";
$result = pdo_query($sql, $user);
 $row=$result[0];
$AC=$row['ac'];

// count submission
$sql = "select count(submission_id) as Submit from submission where username = ?";
$result = pdo_query($sql, $user) ;
 $row=$result[0];
$Submit=$row['Submit'];

// update solved 
$sql = "update user set ac_count = '".strval($AC)."', submit_count = '".strval($Submit)."' where username = ?";
$result = pdo_query($sql, $user);
$sql = "select count(*) as Rank from user where solved > ?";
$result = pdo_query($sql, $AC);
 $row=$result[0];
$Rank=intval($row[0])+1;

$sql = "select result, count(1) from submission where username = ? and result >= 4 group by result order by result";
	$result = pdo_query($sql, $user); //查询用户历次提交的状态，以便绘制提交统计图
	$view_userstat=array();
	$i=0;
	 foreach($result as $row){
		$view_userstat[$i++]=$row;
	}
    
/////////////////////////Template
require("template/".$OJ_TEMPLATE."/userinfo.php");
/////////////////////////Common foot
if(file_exists('./include/cache_end.php'))
	require_once('./include/cache_end.php');
?>

