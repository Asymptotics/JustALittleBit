<? 
include('config.php'); 
$created = false;
if (isset($_POST['submitted'])) { 
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "INSERT INTO `Games` (`Name` ,  `Website` ,  `MemberToContact`  ) VALUES( '{$_POST['Name']}' ,  '{$_POST['Website']}' ,  '{$_POST['MemberToContact']}'  ) "; 
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
<p><b>Name:</b><br /><input type='text' name='Name'/> 
<p><b>Website:</b><br /><input type='text' name='Website'/> 
<p><b>MemberToContact:</b><br /><input type='text' name='MemberToContact'/> 
<p><input type='submit' value='Add Game' /><input type='hidden' value='1' name='submitted' /> 
</form> 

<?
if($created){
echo "<div class=\"confirmationMessage\">Game Created.</div>"; 
}
?>
<br>
<a href='listgames.php'><div>Back To Game's list</div></a>