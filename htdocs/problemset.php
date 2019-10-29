<?php 
	$OJ_CACHE_SHARE=false;
	$cache_time=60;
	require_once('./include/db_info.inc.php');
	require_once('./include/const.inc.php');
	require_once('./include/cache_start.php');
	require_once('./include/memcache.php');
	require_once('./include/setlang.php');
    $view_title= "Problem Set";
$first=1000;
  //if($OJ_SAE) $first=1;
$sql="select max(problem_id) from problem";
$page_cnt=100;
$result=mysql_query_cache($sql);
$row=$result[0];
$cnt=$row[0]-$first;
$cnt=$cnt/$page_cnt;

$page="1";

$pstart=$first+$page_cnt*intval($page)-$page_cnt;
$pend=$pstart+$page_cnt;

$sub_arr=Array();
// submit
if (isset($_SESSION[$OJ_NAME.'_'.'user_id'])){
$sql="select problem_id from submission where username = ?".
	" group by problem_id";
$result = pdo_query($sql, $_SESSION[$OJ_NAME.'_'.'user_id']);
foreach ($result as $row)
	$sub_arr[$row[0]]=true;
}

$acc_arr=Array();
// ac
if (isset($_SESSION[$OJ_NAME.'_'.'user_id'])){
$sql="select problem_id from submission where username = ?".
	" and result = 4".
	" group by problem_id";
$result=pdo_query($sql,$_SESSION[$OJ_NAME.'_'.'user_id']);
foreach ($result as $row)
	$acc_arr[$row[0]]=true;
}

if(isset($_GET['search'])&&trim($_GET['search'])!=""){
	$search = "%".($_GET['search'])."%";
    $filter_sql = " (title like ? or category like ?)"; //实现题目搜索的思路：先根据筛选条件写出SQL语句尾，然后连接到查询题目时的SQL语句后面
    $pstart=0;
    $pend=100;

}else{
     $filter_sql="  problem_id >= '".strval($pstart)."' and problem_id < '".strval($pend)."' ";
}

if (isset($_SESSION[$OJ_NAME.'_'.'administrator'])){
	
	$sql = "select problem_id, title, category, submit_count, ac_count from problem where $filter_sql "; 
	
}
else {
	$now=strftime("%Y-%m-%d %H:%M",time());
	$sql = "select problem_id, title, category, submit_count, ac_count from problem where $filter_sql";

}
$sql .= " order by problem_id";

if(isset($_GET['search'])&&trim($_GET['search'])!=""){
	$result=pdo_query($sql,$search,$search);
}else{
	$result=mysql_query_cache($sql);
}

$view_total_page=intval($cnt+1);

$cnt=0;
$view_problemset=Array();
$i=0;
foreach ($result as $row){
	
	
	$view_problemset[$i]=Array();
	if (isset($sub_arr[$row['problem_id']])){
		if (isset($acc_arr[$row['problem_id']])) 
			$view_problemset[$i][0]="<div class='label label-success'>Y</div>";
		else 
			$view_problemset[$i][0]= "<div class='label label-danger'>N</div>";
	}else{
		$view_problemset[$i][0]= "<div class=none> </div>";
	}

	$category=array();
	$cate=explode(" ",$row['category']);
	foreach($cate as $cat){
		array_push($category,trim($cat));	
	}

	$view_problemset[$i][1]="<div class='center'>".$row['problem_id']."</div>";;
	$view_problemset[$i][2]="<div class='left'><a href='problem.php?id=".$row['problem_id']."'>".$row['title']."</a></div>";;
	$view_problemset[$i][3]="<div class='center'>";
	foreach($category as $cat){
		if(trim($cat)=="")continue;
		$hash_num=hexdec(substr(md5($cat),0,15));
		$label_theme=$color_theme[$hash_num%count($color_theme)];
		if($label_theme=="") $label_theme="default";
		$view_problemset[$i][3].="<a title='".htmlentities($cat,ENT_QUOTES,'UTF-8')."' class='label label-$label_theme' style='display: inline-block;' href='problemset.php?search=".htmlentities($cat,ENT_QUOTES,'UTF-8')."'>".mb_substr($cat,0,4,'utf8')."</a>&nbsp;";
	}
	$view_problemset[$i][3].="</div >";
	$view_problemset[$i][4]="<div class='center'><a href='status.php?problem_id=".$row['problem_id']."&jresult=4'>".$row['ac_count']."</a></div>";
	$view_problemset[$i][5]="<div class='center'><a href='status.php?problem_id=".$row['problem_id']."'>".$row['submit_count']."</a></div>";
	
	
	$i++;
}


require("template/".$OJ_TEMPLATE."/problemset.php");
if(file_exists('./include/cache_end.php'))
	require_once('./include/cache_end.php');
?>
