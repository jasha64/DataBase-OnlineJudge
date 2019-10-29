<?php 
	require_once("./include/my_func.inc.php");
    
	function check_login($user_id,$password){
		global $view_errors,$OJ_EXAM_CONTEST_ID,$MSG_WARNING_DURING_EXAM_NOT_ALLOWED,$MSG_WARNING_LOGIN_FROM_DIFF_IP;	
		$pass2 = 'No Saved';
		session_destroy();
		session_start();
		$sql = "select username, password from user where username = ?";
		$result = pdo_query($sql, $user_id); //登录验证：先查出用户的正确密码
		if(count($result)==1){
			$row = $result[0];
			if( pwCheck($password,$row['password'])){
				$user_id=$row['username'];
				$ip = ($_SERVER['REMOTE_ADDR']);
				if( !empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ){
				    $REMOTE_ADDR = $_SERVER['HTTP_X_FORWARDED_FOR'];
				    $tmp_ip=explode(',',$REMOTE_ADDR);
				    $ip =(htmlentities($tmp_ip[0],ENT_QUOTES,"UTF-8"));
				}
				
				//$sql="INSERT INTO `loginlog` VALUES(?,'login ok',?,NOW())";
				//pdo_query($sql,$user_id,$ip);
				return $user_id;
			}
		}
		return false; 
	}
?>
