<? 
include('config.php');
include('top.php');

if (isset($_GET['IDMembers_Games']) ) { 
$IDMembers_Games = (int) $_GET['IDMembers_Games'];
}
if (isset($_POST['IDMembers_Games']) ) { 
$IDMembers_Games = (int) $_POST['IDMembers_Games'];
}
$edited = false;

if (isset($_POST['submitted'])) { 
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "UPDATE `Members_Games` SET `MemberGameName` = '{$_POST['MemberGameName']}' ,  `Instance` =  '{$_POST['Instance']}', 
 `Guild` =  '{$_POST['Guild']}',`Info` =  '{$_POST['Info']}'
   WHERE `IDMembers_Games` = {$IDMembers_Games} "; 
//echo $sql;
mysql_query($sql) or die(mysql_error()); 
(mysql_affected_rows()) ? ($edited=true) : ($edited=false);

} 

$row = mysql_fetch_array ( mysql_query("SELECT FaceBookName, Name, MemberGameName, Instance, IDGame, MemberID, Guild, Info  
FROM `Members_Games` , Games, Members
WHERE Members_Games.GameID = Games.IDGame
AND Members_Games.MemberID = Members.IDMember
AND `IDMembers_Games` ='{$IDMembers_Games}'"));
 
if (stripslashes($row['FaceBookName'])!=$sessionFaceBookName && !$auth)
{
?>
<script type="text/javascript">
window.location = "list.php";
</script>
<?
}

?>

<form action='' method='POST'> 
<input type='hidden' name='IDMembers_Games' value='<?= stripslashes($IDMembers_Games) ?>' /> 
<p><b><u><?= stripslashes($row['FaceBookName']) ?> in <a href='listgamemembers.php?IDGame=<?=stripslashes($row['IDGame'])?> " '><?= stripslashes($row['Name']) ?></a></u>
<p><b>Member Name in Game :</b><br /><input type='text' name='MemberGameName' value='<?= stripslashes($row['MemberGameName']) ?>' /> 
<p><b>Instance:</b><br /><input type='text' name='Instance' value='<?= stripslashes($row['Instance']) ?>' /> 
<p><b>Guild:</b><br /><input type='text' name='Guild'  value='<?= stripslashes($row['Guild']) ?>'/>
<p><b>Other information :</b><br /><textarea cols='25' rows='5' name='Info'  value='<?= stripslashes($row['Info']) ?>'><?= stripslashes($row['Info']) ?></textarea>
<p><input type='submit' value='Edit Game' /><input type='hidden' value='1' name='submitted' /> 
</form> 
<?
if ($edited)
{
echo "<div class=\"confirmationMessage\"> Game edited. "; 
}
?>
<br />
<a href='listmembersgames.php?IDMember=<?=$row['MemberID']?>'><div>Back To <?=stripslashes($row['FaceBookName'])?>'s game list</div></a>