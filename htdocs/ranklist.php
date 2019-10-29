<?php
        $OJ_CACHE_SHARE=false;
        $cache_time=30;
        require_once('./include/cache_start.php');
    require_once('./include/db_info.inc.php');
        require_once('./include/setlang.php');
        require_once('./include/memcache.php');
        $view_title= $MSG_RANKLIST;

        $scope="";
        if(isset($_GET['scope']))
                $scope=$_GET['scope'];
        if($scope!=""&&$scope!='d'&&$scope!='w'&&$scope!='m')
                $scope='y';
	$where="";
	if(isset($_GET['prefix'])){
		$prefix=$_GET['prefix'];
		$where="where username like ?";
	}else{
		$where="where 1 ";
	}
        $rank = 0;
        if(isset( $_GET ['start'] ))
                $rank = intval ( $_GET ['start'] );

                if(isset($OJ_LANG)){
                        require_once("./lang/$OJ_LANG.php");
                }
                $page_size=50;
                //$rank = intval ( $_GET ['start'] );
                if ($rank < 0)
                        $rank = 0;

                $sql = "select username, nick, ac_count, submit_count from user $where order by ac_count desc, submit_count limit " . strval ( $rank ) . ",$page_size"; //利用SQL中的order by计算排名

                if($scope){
                        $s="";
                        switch ($scope){
                                case 'd':
                                        $s=date('Y').'-'.date('m').'-'.date('d');
                                        break;
                                case 'w':
                                        $monday=mktime(0, 0, 0, date("m"),date("d")-(date("w")+7)%8+1, date("Y"));
                                        //$monday->subDays(date('w'));
                                        $s=strftime("%Y-%m-%d",$monday);
                                        break;
                                case 'm':
                                        $s=date('Y').'-'.date('m').'-01';
                                        ;break;
                                default :
                                        $s=date('Y').'-01-01';
                        }
                        //echo $s."<-------------------------";
$sql = "select user.username, nick, s.ac_count, t.submit_count
	from user inner join
		(select username, count(distinct problem_id) as ac_count
		from submission 
		where submit_time > str_to_date('$s', '%Y-%m-%d') and result = 4 
		group by username
		order by ac_count desc limit " . strval ( $rank ) . ", $page_size) as s 
		on user.username = s.username
	inner join
		(select username, count(problem_id) as submit_count
		from submission 
		where submit_time > str_to_date('$s', '%Y-%m-%d') 
		group by username
		order by submit_count desc) as t 
		on user.username = t.username
	order by s.ac_count desc, t.submit_count
	limit 0, 50";
//限定时间范围内的排名，我们通过查询时在连接的同时筛选提交时间来达到目的
//                      echo $sql;
                }


      
		
		if(isset($_GET['prefix'])){
			$result = pdo_query($sql,$_GET['prefix']."%");
		}else{
                	$result = mysql_query_cache($sql) ;
		}
                if($result) $rows_cnt=count($result);
                else $rows_cnt=0;
                $view_rank=Array();
                $i=0;
                for ( $i=0;$i<$rows_cnt;$i++ ) {
					
                        $row=$result[$i];
                        
                        $rank ++;

                        $view_rank[$i][0]= $rank;
                        $view_rank[$i][1]=  "<div class=center><a href='userinfo.php?user=" .htmlentities ( $row['username'],ENT_QUOTES,"UTF-8") . "'>" . $row['username'] . "</a>"."</div>";
                        $view_rank[$i][2]=  "<div class=center>" . htmlentities ( $row['nick'] ,ENT_QUOTES,"UTF-8") ."</div>";
                        $view_rank[$i][3]=  "<div class=center><a href='status.php?user_id=" .htmlentities ( $row['username'],ENT_QUOTES,"UTF-8") ."&jresult=4'>" . $row['ac_count']."</a>"."</div>";
                        $view_rank[$i][4]=  "<div class=center><a href='status.php?user_id=" . htmlentities ($row['username'],ENT_QUOTES,"UTF-8") ."'>" . $row['submit_count'] . "</a>"."</div>";

                        if ($row['submit_count'] == 0)
                                $view_rank[$i][5]= "0.000%";
                        else
                                $view_rank[$i][5]= sprintf ( "%.03lf%%", 100 * $row['ac_count'] / $row['submit_count'] );

//                      $i++;
                }

                $sql = "select count(1) from user";
                $result = mysql_query_cache($sql);
                 $row=$result[0];
                $view_total=$row[0];




/////////////////////////Template
require("template/".$OJ_TEMPLATE."/ranklist.php");
/////////////////////////Common foot
if(file_exists('./include/cache_end.php'))
        require_once('./include/cache_end.php');
?>
