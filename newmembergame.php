<? 
include('config.php'); 
$created = false;
if (isset($_GET['IDMember']) ) { 
$IDMember = (int) $_GET['IDMember'];
}
if (isset($_POST['IDMember']) ) { 
$IDMember = (int) $_GET['IDMember'];
}


if (isset($_POST['submitted'])) { 

foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "INSERT INTO `Members_Games` ( `MemberID` ,  `GameID` ,  `MemberGameName` ,  `Instance`, `Guild`, `Info`  ) VALUES(  '{$IDMember}' ,  '{$_POST['GameID']}' ,  '{$_POST['MemberGameName']}' ,  '{$_POST['Instance']}',  '{$_POST['Guild']}',  '{$_POST['Info']}'  ) "; 

mysql_query($sql) or die(mysql_error()); 
$created = true;
}
 
$MemberName = "";
$query = "SELECT FaceBookName FROM `Members` WHERE `IDMember` = " . $IDMember;
$result = mysql_query($query) or trigger_error(mysql_error());

while($row = mysql_fetch_array($result))
{
	$MemberName = $row['FaceBookName'];
}

include('top.php');

if ($MemberName!=$sessionFaceBookName && !$auth)
{
?>
<script type="text/javascript">
window.location = "list.php";
</script>
<?
}


?>
<p><b>New Game for <?= $MemberName ?></b><br />
<form action='' method='POST'> 
<p><b>Game Name :</b><br />
<select name="GameID" >
<?
$query = "SELECT IDGame, Name FROM `Games` ORDER BY Name";
$result = mysql_query($query) or trigger_error(mysql_error());
while($row = mysql_fetch_array($result))
{
?>
<option value = "<?= nl2br( $row['IDGame']) ?>"><?=nl2br( $row['Name']) ?></option>
<?
} 
?>
</select> 
<input type='hidden' name='IDMember' value ='<?= $IDMember ?>' />
<p><b>Member Name in Game :</b><br /><input type='text' name='MemberGameName'/> 
<p><b>Instance:</b><br /><input type='text' name='Instance'/> 
<p><b>Guild:</b><br /><input type='text' name='Guild'/>
<p><b>Other information :</b><br /><textarea cols='25' rows='5' name='Info'></textarea>
<input type='hidden' value='1' name='submitted' /> 
<p><input type='submit' value='Add Game' />
</form> 
<?
if ($created)
{
echo "<div class=\"confirmationMessage\">Game Added.</div><br />"; 
}
?>
<br />
<a href='listmembersgames.php?IDMember=<?=$IDMember ?>'><div>Back To Member's game list</div></a>