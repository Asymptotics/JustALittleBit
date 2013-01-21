<? 
include('config.php'); 
$edited = false;

if (isset($_GET['IDMember']) ) { 
$IDMember = (int) $_GET['IDMember']; 
if (isset($_POST['submitted'])) { 
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "UPDATE `Members` SET  `FaceBookName` =  '{$_POST['FaceBookName']}' ,  `CoHGlobal` =  '{$_POST['CoHGlobal']}' ,  `SkypeName` =  '{$_POST['SkypeName']}' ,  `SteamName` =  '{$_POST['SteamName']}' ,  `FaceBookLink` =  '{$_POST['FaceBookLink']}'   WHERE `IDMember` = '$IDMember' "; 
(mysql_affected_rows()) ? ($edited=true) : ($edited=false); 
mysql_query($sql) or die(mysql_error()); 
} 
$row = mysql_fetch_array ( mysql_query("SELECT * FROM `Members` WHERE `IDMember` = '$IDMember' ")); 

include('top.php');
?>

<form action='' method='POST'> 
<p><b>FaceBook Name:</b><br /><input type='text' name='FaceBookName' value="<?= stripslashes($row['FaceBookName']) ?>" /> 
<p><b>CoH Global:</b><br /><input type='text' name='CoHGlobal' value="<?= stripslashes($row['CoHGlobal']) ?>" /> 
<p><b>Skype Name:</b><br /><input type='text' name='SkypeName' value="<?= stripslashes($row['SkypeName']) ?>" /> 
<p><b>Steam Name:</b><br /><input type='text' name='SteamName' value="<?= stripslashes($row['SteamName']) ?>" /> 
<p><b>Facebook Profile Link:</b><br /><input type='text' name='FaceBookLink' value="<?= stripslashes($row['FaceBookLink']) ?>" /> 
<p><input type='submit' value='Edit Member' /><input type='hidden' value='1' name='submitted' /> 
</form> 
<? 
if($edited){
echo "<div class=\"confirmationMessage\">Member Edited.</div>"; 
}
} ?> 
<br />
<a href='list.php'><div>Back To Member's list</div></a>