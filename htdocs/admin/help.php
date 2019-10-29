<?php require_once("admin-header.php");

	if(isset($OJ_LANG)){
		require_once("../lang/$OJ_LANG.php");
	}
	

?>
<html>
<head>
<title><?php echo $MSG_ADMIN?></title>
</head>

<body>
	
<hr>
<h4>
<ul>

  <li><a class='btn btn-danger' href="../status.php" target="_top"><b><?php echo $MSG_SEEOJ?></b></a><?php echo $MSG_HELP_SEEOJ?>
  <?php if (isset($_SESSION[$OJ_NAME.'_'.'administrator'])){?>
  <li><a class='btn btn-warning' href="user_list.php" target="main"><b><?php echo $MSG_USER.$MSG_LIST?></b></a><?php echo $MSG_HELP_USER_LIST?>
  <?php }
  if (isset($_SESSION[$OJ_NAME.'_'.'administrator'])||isset( $_SESSION[$OJ_NAME.'_'.'password_setter'] )){?>
  <li><a class='btn btn-warning' href="changepass.php" target="main"><b><?php echo $MSG_SETPASSWORD?></b></a><?php echo $MSG_HELP_SETPASSWORD?>
  <?php }
  if (isset($_SESSION[$OJ_NAME.'_'.'administrator'])){?>
  <li><a class='btn btn-warning' href="privilege_list.php" target="main"><b><?php echo $MSG_PRIVILEGE.$MSG_LIST?></b></a><?php echo $MSG_HELP_PRIVILEGE_LIST?>
  <li><a class='btn btn-warning' href="privilege_add.php" target="main"><b><?php echo $MSG_ADD.$MSG_PRIVILEGE?></b></a><?php echo $MSG_HELP_ADD_PRIVILEGE?>
  <?php }
  if (isset($_SESSION[$OJ_NAME.'_'.'administrator'])||isset($_SESSION[$OJ_NAME.'_'.'contest_creator'])||isset($_SESSION[$OJ_NAME.'_'.'problem_editor'])){?>
  <li><a class='btn btn-success' href="problem_list.php" target="main"><b><?php echo $MSG_PROBLEM.$MSG_LIST?></b></a><?php echo $MSG_HELP_PROBLEM_LIST?>
  <?php }
  if (isset($_SESSION[$OJ_NAME.'_'.'administrator'])||isset($_SESSION[$OJ_NAME.'_'.'problem_editor'])){?>
  <li><a class='btn btn-success' href="problem_add_page.php" target="main"><b><?php echo $MSG_ADD.$MSG_PROBLEM?></b></a><?php echo $MSG_HELP_ADD_PROBLEM?>
  <?php }
  if (isset($_SESSION[$OJ_NAME.'_'.'administrator'])){?>
  
  <?php }?>
  <?php 
  if (isset($_SESSION[$OJ_NAME.'_'.'administrator'])){?>
  <li><a class='btn btn-primary' href="rejudge.php" target="main"><b><?php echo $MSG_REJUDGE?></b></a><?php echo $MSG_HELP_REJUDGE?>
  <?php }?>
  <li><a class='btn btn-primary' href="https://github.com/zhblue/hustoj/" target="_blank"><b>HUSTOJ</b></a>
  <?php
  if (isset($_SESSION[$OJ_NAME.'_'.'administrator'])){?>
  
  <?php }
  if (isset($OJ_ONLINE)&&$OJ_ONLINE){?>
  <li><a class='btn btn-primary' href="../online.php" target="main"><b><?php echo $MSG_ONLINE?></b></a><?php echo $MSG_HELP_ONLINE?>
  <?php }?>
  <li><a class='btn btn-primary' href="http://shang.qq.com/wpa/qunwpa?idkey=d52c3b12ddaffb43420d308d39118fafe5313e271769277a5ac49a6fae63cf7a" target="_blank">手机QQ加官方群23361372</a>
	
</ul>
<h4>
</body>
</html>
