<? 
include('config.php'); 
$created = false;
if (isset($_POST['submitted'])) { 
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "INSERT INTO `Members` ( `FaceBookName` ,  `CoHGlobal` ,  `NickName` ,  `SkypeName` ,  `SteamName` ,  `FaceBookLink`  ) VALUES(  '{$_POST['FaceBookName']}' ,  '{$_POST['CoHGlobal']}' ,  '{$_POST['NickName']}' ,  '{$_POST['SkypeName']}' ,  '{$_POST['SteamName']}'  ,  '{$_POST['FaceBookLink']}' ) "; 
mysql_query($sql) or die(mysql_error()); 
(mysql_affected_rows()) ? ($created=true) : ($created=false);
} 
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
<p><b>FaceBook Name:</b><br /><input type='text' name='FaceBookName'/> 
<p><b>CoH Global:</b><br /><input type='text' name='CoHGlobal'/> 
<p><b>NickName:</b><br /><input type='text' name='NickName'/> 
<p><b>Skype Name:</b><br /><input type='text' name='SkypeName'/> 
<p><b>Steam Name:</b><br /><input type='text' name='SteamName'/> 
<p><b>Facebook Profile Link:</b><br /><input type='text' name='FacebookLink'/> 
<p><input type='submit' value='Add Member' /><input type='hidden' value='1' name='submitted' /> 
</form> 
<?
if($created){
echo "<div class=\"confirmationMessage\">Member Created.</div>"; 
}
?>
<br />
<a href='list.php'><div>Back To Member's list</div></a>