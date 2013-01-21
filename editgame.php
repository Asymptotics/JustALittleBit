<? 
include('config.php'); 
$edited = false;

if (isset($_GET['IDGame']) ) { 
$IDGame = (int) $_GET['IDGame']; 
if (isset($_POST['submitted'])) { 
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "UPDATE `Games` SET `Name` =  '{$_POST['Name']}' ,  `Website` =  '{$_POST['Website']}' ,  `MemberToContact` =  '{$_POST['MemberToContact']}'   WHERE `IDGame` = '$IDGame' "; 
(mysql_affected_rows()) ? ($edited=true) : ($edited=false); 
mysql_query($sql) or die(mysql_error()); 
} 
$row = mysql_fetch_array ( mysql_query("SELECT * FROM `Games` WHERE `IDGame` = '$IDGame' ")); 

include('top.php');

if (!$auth)
{
?>
<script type="text/javascript">
window.location = "list.php";
</script>
<?
}
?>


<form action='' method='POST'> 
<p><b>Name:</b><br /><input type='text' name='Name' value='<?= stripslashes($row['Name']) ?>' /> 
<p><b>Website:</b><br /><input type='text' name='Website' value='<?= stripslashes($row['Website']) ?>' /> 
<p><b>MemberToContact:</b><br /><input type='text' name='MemberToContact' value='<?= stripslashes($row['MemberToContact']) ?>' /> 
<p><input type='submit' value='Edit Game' /><input type='hidden' value='1' name='submitted' /> 
</form> 
<? 
if($edited){
echo "<div class=\"confirmationMessage\">Game Edited.</div>"; 
}
} ?>  
<br>
<a href='listgames.php'><div>Back To Game's list</div></a>

