<?php
 $cache_time=10;
	$OJ_CACHE_SHARE=false;
	require_once('./include/cache_start.php');
    require_once('./include/db_info.inc.php');
	require_once('./include/setlang.php');
	$view_title= "Source Code";
   
require_once("./include/const.inc.php");
if (!isset($_GET['id'])){
	$view_errors= "No such code!\n";
	require("template/".$OJ_TEMPLATE."/error.php");
	exit(0);
}
$ok=false;
$id=intval($_GET['id']);
$sql = "select * from submission where submission_id = ?";
$result = pdo_query($sql, $id);
$row=$result[0];
$slanguage=$row['language'];
$sresult=$row['result'];
$stime=$row['run_time'];
$smemory=$row['run_memory'];
$sproblem_id=$row['problem_id'];
$view_user_id=$suser_id=$row['username'];
//$contest_id=$row['contest_id'];



if(isset($OJ_EXAM_CONTEST_ID)){
	
}

if (isset($OJ_AUTO_SHARE)&&$OJ_AUTO_SHARE&&isset($_SESSION[$OJ_NAME.'_'.'user_id'])){
	$sql = "select submission_id from submission where result = 4 and problem_id = $sproblem_id and username = ?"; //从数据库中查询这个人这道题目的所有AC code
	$rrs = pdo_query($sql, $_SESSION[$OJ_NAME.'_'.'user_id']);
	$ok=(count($rrs)>0);
	
}

//check whether user has the right of view solutions of this problem
//echo "checking...";
if(isset($_SESSION[$OJ_NAME.'_'.'s'.$sproblem_id])){
	$ok=true;
}
$view_source="No source code available!";
if (isset($_SESSION[$OJ_NAME.'_'.'user_id'])&&$row && $row['username']==$_SESSION[$OJ_NAME.'_'.'user_id']) $ok=true;
if (isset($_SESSION[$OJ_NAME.'_'.'administrator'])) $ok=true;

		$sql = "select source from submission where submission_id = ?";
		$result=pdo_query($sql, $id);
		 $row=$result[0];
		if($row)
			$view_source=$row['source'];

/////////////////////////Template
require("template/".$OJ_TEMPLATE."/showsource.php");
/////////////////////////Common foot
if(file_exists('./include/cache_end.php'))
	require_once('./include/cache_end.php');
?>

