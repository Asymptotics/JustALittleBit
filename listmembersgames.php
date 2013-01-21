<? 
include('config.php'); 
include('top.php');

if (isset($_GET['IDMember']) ) { 
$IDMember = (int) $_GET['IDMember'];
}
if (isset($_POST['IDMember']) ) { 
$IDMember = (int) $_GET['IDMember'];
}

$result = mysql_query("SELECT FaceBookName FROM  Members WHERE IDMember = " . $IDMember) or trigger_error(mysql_error()); 
if($row = mysql_fetch_array($result))
{
?>
<b>Games played by <?= stripslashes(nl2br( $row['FaceBookName'])) ?> </b>
<br /><br />
<a href='list.php'><div>Back To Member's list</div></a>
<br />
<?
}
echo "<table class=\"memberListTable\" cellspacing=\"0\">"; 
echo "<tr>"; 
//echo "<td><b>MemberID</b></td>"; 
//echo "<td><b>GameID</b></td>"; 
echo "<th class=\"memberList0\"><b>Game</b></th>"; 
echo "<th class=\"memberList0\"><b>Member Name in that game</b></th>"; 
echo "<th class=\"memberList0\"><b>Instance</b></th>"; 
echo "<th class=\"memberList0\"><b>Guild</b></th>";
echo "<th class=\"memberList0\"><b>Info</b></th>";
if ($sessionFaceBookName == stripslashes(nl2br( $row['FaceBookName'])) || $auth)
{
	echo "<td class=\"memberList0\" colspan=\"2\"><b><a href=\"newmembergame.php?IDMember=" . $IDMember . "\">Add New Game</a></b></td>"; 
}
echo "</tr>"; 
$result = mysql_query("SELECT Name, FaceBookName, MemberGameName, Instance, IDMembers_Games, Guild, Info FROM Members, Members_Games, Games WHERE Members.IDMember = Members_Games.MemberID AND Games.IDGame = Members_Games.GameID AND Members.IDMember = " . $IDMember . " ORDER BY Name") or trigger_error(mysql_error()) ; 

?>

<?
$i=0;
while($row = mysql_fetch_array($result)){ 
$i++;
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
echo "<tr class=\"memberList\">";   
//echo "<td valign='top'>" . nl2br( $row['MemberID']) . "</td>";  
//echo "<td valign='top'>" . nl2br( $row['GameID']) . "</td>";  
echo "<td valign='top' class=\"memberList".($i & 1)."\">&nbsp;" . nl2br( $row['Name']) . "</td>";  
echo "<td valign='top' class=\"memberList".($i & 1)."\">&nbsp;" . nl2br( $row['MemberGameName']) . "</td>";  
echo "<td valign='top' class=\"memberList".($i & 1)."\">&nbsp;" . nl2br( $row['Instance']) . "</td>";  
echo "<td valign='top' class=\"memberList".($i & 1)."\">&nbsp;" . nl2br( $row['Guild']) . "</td>"; 
echo "<td valign='top' style='width:200px' class=\"memberList".($i & 1)."\">&nbsp;" . nl2br( $row['Info']) . "</td>"; 
if ($sessionFaceBookName == stripslashes(nl2br( $row['FaceBookName'])) || $auth)
{
	echo "<td valign='top' class=\"memberList".($i & 1)."\"><a href=\"editmembersgames.php?IDMembers_Games={$row['IDMembers_Games']}\">Edit</a></td>";
	echo "<td valign='top' class=\"memberList".($i & 1)."\"><a href=\"deletemembersgames.php?IDMembers_Games={$row['IDMembers_Games']}&IDMember={$IDMember}\"  onclick=\"return confirmDelete('" .  addslashes($row['Name']) . " for " . addslashes($row['FaceBookName']) . "');\">Delete</a></td> "; 
}
echo "</tr>"; 
} 
echo "</table>"; 
?>
<br />
<a href='list.php'><div>Back To Member's list</div></a>
<?
include('bottom.php'); 
?>