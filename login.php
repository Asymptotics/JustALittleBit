<?php

include("config.php");
include ("top.php");
session_start();
 if($_SERVER["REQUEST_METHOD"] == "POST")
 {

// username and password sent from Form 

$myusername=addslashes($_POST['username']); 
 $mypassword=addslashes($_POST['password']); 

 $sql="SELECT IDAdmin FROM admins WHERE username='" . $myusername . "' and password='" . $mypassword . "'";
 //echo ($sql);
 $result=mysql_query($sql);
 $rowadmin=mysql_fetch_array($result);
 $count=mysql_num_rows($result);



// If result matched $myusername and $mypassword, table row must be 1 row

if($count==1)
 {
session_register("myusername");
$_SESSION['login_user']=$myusername;
?>
<script type="text/javascript">
window.location = "list.php";
</script>
<?
 }
 else 
 {
 $error="Your Login Name or Password is invalid";
 }
 }

?>
<form action="" method="post">
	<label>UserName :</label>
	<input type="text" name="username"/><br />
	<label>Password :</label>
	<input type="password" name="password"/><br/>
	<input type="submit" value=" Submit "/><br />
</form>