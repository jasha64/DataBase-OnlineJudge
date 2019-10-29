<?php
 require_once("admin-header.php");
ini_set("display_errors","On");
require_once("../include/check_get_key.php");
if (!(isset($_SESSION[$OJ_NAME.'_'.'administrator']))){
        echo "<a href='../loginpage.php'>Please Login First!</a>";
        exit(1);
}
?> 
<?php
  if($OJ_SAE||function_exists('system')){
        $id=intval($_GET['id']);
        
        $basedir = "$OJ_DATA/$id";
        if($OJ_SAE){
			;//need more code to delete files
	}else{
	    if(strlen($basedir)>16){
			system("rm -rf $basedir");
	    }
	}
        $sql = "delete from problem where problem_id = ?";
        pdo_query($sql, $id) ;
        ?>
        <script language=javascript>
                history.go(-1);
        </script>
<?php 
  }else{
  
  
  ?>
        <script language=javascript>
                alert("Nees enable system() in php.ini");
                history.go(-1);
        </script>
  <?php 
  
  }

?>
