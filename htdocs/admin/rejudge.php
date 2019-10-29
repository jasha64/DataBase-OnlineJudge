<?php require("admin-header.php");

if (!(isset($_SESSION[$OJ_NAME.'_'.'administrator']))){
	echo "<a href='../loginpage.php'>Please Login First!</a>";
	exit(1);
}?>
<?php if(isset($_POST['do'])){
	require_once("../include/check_post_key.php");
	if (isset($_POST['rjpid'])){
		$rjpid=intval($_POST['rjpid']);
		if($rjpid == 0) {
		    echo "Rejudge Problem ID should not equal to 0";
		    exit(1);
		}
		$sql = "update submission set result = 0 where problem_id = ?";
		pdo_query($sql, $rjpid);
		$url="../status.php?problem_id=".$rjpid;
		echo "Rejudged Problem ".$rjpid;
		echo "<script>location.href='$url';</script>";
	}
	else if (isset($_POST['rjsid'])){
		$rjsid=intval($_POST['rjsid']);
		$sql = "update submission set result = 0 where submission_id = ?" ;
		pdo_query($sql, $rjsid);
		$url="../status.php?top=".($rjsid+1);
		echo "Rejudged Runid ".$rjsid;
		echo "<script>location.href='$url';</script>";
	}
	echo str_repeat(" ",4096);
	flush();
	if($OJ_REDIS){
               
        }

}
?>
<div class="container">
<b>Rejudge</b>
	<ol>
	<li><?php echo $MSG_PROBLEM?>
	<form action='rejudge.php' method=post>
		<input type=input name='rjpid' placeholder="1001">	<input type='hidden' name='do' value='do'>
		<input type=submit value=submit>
		<?php require_once("../include/set_post_key.php");?>
	</form>
	<li><?php echo $MSG_SUBMIT?>
	<form action='rejudge.php' method=post>
		<input type=input name='rjsid' placeholder="2">	<input type='hidden' name='do' value='do'>
		<input type=hidden name="postkey" value="<?php echo $_SESSION[$OJ_NAME.'_'.'postkey']?>">
		<input type=submit value=submit>
	</form>
</div>
