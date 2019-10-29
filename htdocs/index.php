<?php
////////////////////////////Common head
$cache_time = 30;
$OJ_CACHE_SHARE = true;
require_once( './include/cache_start.php' );
require_once( './include/db_info.inc.php' );
require_once( './include/memcache.php' );
require_once( './include/setlang.php' );
$view_title = "Welcome To Online Judge";
$result = false;
///////////////////////////MAIN	

$view_news .= "<div class='panel-footer'>This <a href=http://cm.baylor.edu/welcome.icpc>ACM/ICPC</a> OnlineJudge is a GPL product from <a href=https://github.com/zhblue/hustoj>hustoj</a></div>";
$view_apc_info = "";

/////////////////////////Template
require( "template/" . $OJ_TEMPLATE . "/index.php" );
/////////////////////////Common foot
if ( file_exists( './include/cache_end.php' ) )
	require_once( './include/cache_end.php' );
?>