<?php
$cache_time=30;
$OJ_CACHE_SHARE=false;

require_once('./include/cache_start.php');
require_once('./include/db_info.inc.php');
require_once('./include/const.inc.php');
require_once('./include/setlang.php');

$now=strftime("%Y-%m-%d %H:%M",time());

if(isset($_GET['cid']))
  $ucid="&cid=".intval($_GET['cid']);
else
  $ucid="";

require_once("./include/db_info.inc.php");

if(isset($OJ_LANG)){
  require_once("./lang/$OJ_LANG.php");
}

$pr_flag=false;
$co_flag=false;

if(isset($_GET['id'])){
  // practice
  $id=intval($_GET['id']);
  //require("oj-header.php");
  $sql = "select * from problem where problem_id = ?";
  $result = pdo_query($sql, $id);

  $pr_flag=true;
}else if(isset($_GET['cid']) && isset($_GET['pid'])){
  // contest
  
}else{
  $view_errors="<title>$MSG_NO_SUCH_PROBLEM</title><h2>$MSG_NO_SUCH_PROBLEM</h2>";
  require("template/".$OJ_TEMPLATE."/error.php");
  exit(0);
}
     
if(count($result)!=1){
  $view_errors="";
  if(isset($_GET['id'])){
    $id=intval($_GET['id']);
    $result=array();

    if($i=count($result)){
      
    }else{
      $view_title= "<title>$MSG_NO_SUCH_PROBLEM!</title>";
      $view_errors.= "<h2>$MSG_NO_SUCH_PROBLEM!</h2>";
    }
  }else{
    $view_title= "<title>$MSG_NO_SUCH_PROBLEM!</title>";
    $view_errors.= "<h2>$MSG_NO_SUCH_PROBLEM!</h2>";
  }
  require("template/".$OJ_TEMPLATE."/error.php");
  exit(0);
}else{
  $row=$result[0];
  $view_title= $row['title'];     
}


/////////////////////////Template
require("template/".$OJ_TEMPLATE."/problem.php");
/////////////////////////Common foot
if(file_exists('./include/cache_end.php'))
  require_once('./include/cache_end.php');
?>
