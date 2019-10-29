<?php

function addproblem($title, $time_limit, $memory_limit, $description, $input, $output, $sample_input, $sample_output, $hint, $source, $spj,$OJ_DATA) {

//	$spj=($spj);
	
	$sql = "select max(problem_id) from problem";
	$result = pdo_query($sql);
	$pid = $result[0][0] + 1;
	$sql = "insert into problem values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?, ?, 0, 0)";
	//echo $sql;
	pdo_query($sql, $pid, $title, $description, $input, $output, 
			$sample_input, $sample_output, $spj, $hint, $source, $time_limit, $memory_limit) ;
	echo "<br>Add $pid  ";
	if (isset ( $_POST ['contest_id'] )) {
		
	}
	$basedir = "$OJ_DATA/$pid";
	if(!isset($OJ_SAE)||!$OJ_SAE){
//			echo "[$title]data in $basedir";
	}
	return $pid;
}
function mkdata($pid,$filename,$input,$OJ_DATA){
	
	$basedir = "$OJ_DATA/$pid";
	
	$fp = @fopen ( $basedir . "/$filename", "w" );
	if($fp){
		fputs ( $fp, preg_replace ( "(\r\n)", "\n", $input ) );
		fclose ( $fp );
	}else{
		echo "Error while opening".$basedir . "/$filename ,try [chgrp -R www-data $OJ_DATA] and [chmod -R 771 $OJ_DATA ] ";
		
	}
	
	
	
}

?>
