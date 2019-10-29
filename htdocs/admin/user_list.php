<?php
require("admin-header.php");
require_once("../include/set_get_key.php");

if(!isset($_SESSION[$OJ_NAME.'_'.'administrator'])){
  echo "<a href='../loginpage.php'>Please Login First!</a>";
  exit(1);
}

if(isset($OJ_LANG)){
  require_once("../lang/$OJ_LANG.php");
}
?>

<title>User List</title>
<hr>
<center><h3><?php echo $MSG_USER.$MSG_LIST?></h3></center>

<div class='container'>

<?php
$sql = "select count(1) as ids from user";
$result = pdo_query($sql);
$row = $result[0];

$ids = intval($row['ids']);

$idsperpage = 25;
$pages = intval(ceil($ids/$idsperpage));

if(isset($_GET['page'])){ $page = intval($_GET['page']);}
else{ $page = 1;}

$pagesperframe = 5;
$frame = intval(ceil($page/$pagesperframe));

$spage = ($frame-1)*$pagesperframe+1;
$epage = min($spage+$pagesperframe-1, $pages);

$sid = ($page-1)*$idsperpage;

$sql = "";
if(isset($_GET['keyword']) && $_GET['keyword']!=""){
  $keyword = $_GET['keyword'];
  $keyword = "%$keyword%";
  $sql = "select username, nick, school from user where username like ? or nick like ? or school like ? order by username";
  $result = pdo_query($sql, $keyword, $keyword, $keyword);
}else{
  $sql = "select username, nick, school from user limit $sid, $idsperpage";
  $result = pdo_query($sql);
}
?>

<form action=user_list.php class=center>
  <input name=keyword><input type=submit value="<?php echo $MSG_SEARCH?>" >
</form>

<center>
  <table width=100% border=1 style="text-align:center;">
    <tr>
      <td>ID</td>
      <td>NICK</td>
      <td>SCHOOL</td>
      <td>DELETE</td>
    </tr>
    <?php
    foreach($result as $row){
      echo "<tr>";
        echo "<td><a href='../userinfo.php?user=".$row['username']."'>".$row['username']."</a></td>";
        echo "<td>".$row['nick']."</td>";
        echo "<td>".$row['school']."</td>";
		//echo "<td><a href=user_df_change.php?cid=".$row['username']."&getkey=".$_SESSION[$OJ_NAME.'_'.'getkey'].">"."<span class=red>销号</span>"."</a></td>";
		?>
        <td><a href=# onclick='javascript:if(confirm("警告：销号同时也会删除用户的所有提交且不可逆。确定要销号吗？")) location.href="user_df_change.php?cid=<?php echo $row['username']?>&getkey=<?php echo $_SESSION[$OJ_NAME.'_'.'getkey']?>"'><span class=red>销号</span></a></td><?php
      echo "</tr>";
    }
    ?>
  </table>
</center>

<?php
if(!(isset($_GET['keyword']) && $_GET['keyword']!=""))
{
  echo "<div style='display:inline;'>";
  echo "<nav class='center'>";
  echo "<ul class='pagination pagination-sm'>";
  echo "<li class='page-item'><a href='user_list.php?page=".(strval(1))."'>&lt;&lt;</a></li>";
  echo "<li class='page-item'><a href='user_list.php?page=".($page==1?strval(1):strval($page-1))."'>&lt;</a></li>";
  for($i=$spage; $i<=$epage; $i++){
    echo "<li class='".($page==$i?"active ":"")."page-item'><a title='go to page' href='user_list.php?page=".$i.(isset($_GET['my'])?"&my":"")."'>".$i."</a></li>";
  }
  echo "<li class='page-item'><a href='user_list.php?page=".($page==$pages?strval($page):strval($page+1))."'>&gt;</a></li>";
  echo "<li class='page-item'><a href='user_list.php?page=".(strval($pages))."'>&gt;&gt;</a></li>";
  echo "</ul>";
  echo "</nav>";
  echo "</div>";
}
?>

</div>
