<? 
include('config.php'); 

if (isset($_GET['IDMember']) ) { 
$IDMember = (int) $_GET['IDMember']; 
}
if (isset($_POST['IDMember']) ) { 
$IDMember = (int) $_POST['IDMember']; 
}

if (isset($_POST['submitted'])) { 
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "INSERT INTO  Members_Games (MemberID, GameID, MemberGameName, Insance) values ()"; 
(mysql_affected_rows()) ? ($edited=true) : ($edited=false); 
mysql_query($sql) or die(mysql_error()); 
} 
*/
$row = mysql_fetch_array ( mysql_query("SELECT * FROM `Members_Games` WHERE `IDMember` = '$IDMember' ")); 

include('top.php');
?>
<p><b>
Games played
</b>
<br>
<?
$query = "SELECT IDGame,Name,Website,MemberToContact FROM `Members` ORDER by Name";
$result = mysql_query($query) or trigger_error(mysql_error());
?>
</p>
<form action='' method='POST'>
<input type="hidden" name ="IDMember" value = "<?= $IDMember ?>">
<br/>

<?
$query = "SELECT IDGame,Name,Website,MemberToContact FROM `Games` ORDER by Name";
$result = mysql_query($query) or trigger_error(mysql_error());
?>
<div>
<select>
<?
while($row = mysql_fetch_array($result)){ 
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
?>
<option value = "$row['IDGame']"><?= nl2br( $row['Name']) ?></option>
<?
}
?>
</select>
<input type='submit' value='Add game' name='submitted' />
</div>
<div>

</div>
<div>
<input type='hidden' value='1' name='submitted' /> 
</div>
</form> 