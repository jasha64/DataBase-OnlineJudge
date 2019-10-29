<?php require_once("admin-header.php");?>
<?php if (!(isset($_SESSION[$OJ_NAME.'_'.'administrator']))){
	echo "<a href='../loginpage.php'>Please Login First!</a>";
	exit(1);
}
if(isset($_POST['do'])){
	require_once("../include/check_post_key.php");
	$user_id=$_POST['user_id'];
	$rightstr =$_POST['rightstr'];
	if(isset($_POST['contest'])) $rightstr="c$rightstr";
	if(isset($_POST['psv'])) $rightstr="s$rightstr";
	$sql = "update user set privilege = 1 where username = ?";
	$rows = pdo_query($sql, $user_id);
	echo "$user_id privilege added!";
	
}
?>
<div class="container">
<form method=post>
<?php require("../include/set_post_key.php");?>
	<b>Add privilege for User:</b><br />
	User:<input type=text size=10 name="user_id"><br />
	<input type='hidden' name='do' value='do'>
	<input type=submit value='Add'>
	<?php echo $MSG_HELP_ADD_PRIVILEGE; ?>
</form>
</div>
