<?php require_once("admin-header.php");
require_once("../include/check_get_key.php");
$cid=$_GET['cid'];
echo $cid;
if(!(isset($_SESSION[$OJ_NAME.'_'."m$cid"])||isset($_SESSION[$OJ_NAME.'_'.'administrator']))) exit();
$sql="select * from user where username = ?";
$result=pdo_query($sql,$cid);
echo $result;
$num=count($result);
if ($num<1){
	echo "No Such User!";
	require_once("../oj-footer.php");
	exit(0);
}
$sql = "delete from submission where username = ?";
pdo_query($sql, $cid); //删除该用户的所有提交
$sql = "delete from user where username = ?";
pdo_query($sql, $cid); //从user表中删除该用户的信息
?>
<script language=javascript>
	history.go(-1);
</script>

