<? 
include('config.php'); 
include('top.php');

if (isset($_GET['IDGame']) ) { 
$IDGame = (int) $_GET['IDGame'];
}
if (isset($_POST['IDGame']) ) { 
$IDGame = (int) $_POST['IDGame'];
}
$result = mysql_query("SELECT DISTINCT Name FROM  Members, Games, Members_Games WHERE Members.IDMember = Members_Games.MemberID AND Games.IDGame = Members_Games.GameID AND Games.IDGame = " . $IDGame) or trigger_error(mysql_error()); 
if($row = mysql_fetch_array($result))
{
?>
<b>People in  <u><?= nl2br( $row['Name']) ?></u> </b>
<br />
<br />
<a href='listgames.php'><div>Back To Game's list</div></a>
<br />
<?
}

echo "<table class=\"memberListTable\" cellspacing=\"0\">"; 
echo "<tr>"; 
//echo "<td><b>IDMembers Games</b></td>"; 
//echo "<td><b>MemberID</b></td>"; 
//echo "<td><b>GameID</b></td>"; 
echo "<td class=\"memberList0\"><b><a href=\"listgamemembers.php?IDGame=".$IDGame."&sort=FaceBookName\">People (by Facebook Name)</a></b></td>"; 
echo "<td class=\"memberList0\"><b><a href=\"listgamemembers.php?IDGame=".$IDGame."&sort=MemberGameName\">Name in game</a></b></td>"; 
echo "<td class=\"memberList0\"><b><a href=\"listgamemembers.php?IDGame=".$IDGame."&sort=Instance\">Instance</a></b></td>"; 
echo "<td class=\"memberList0\"><b><a href=\"listgamemembers.php?IDGame=".$IDGame."&sort=Guild\">Guild</a></b></td>"; 
echo "<td class=\"memberList0\"><b><a href=\"listgamemembers.php?IDGame=".$IDGame."&sort=Info\">Other Info</a></b></td>"; 
echo "</tr>"; 
$query = "SELECT FaceBookName, MemberGameName, Instance, Guild, Info FROM Members, Members_Games, Games WHERE Members.IDMember = Members_Games.MemberID AND Games.IDGame = Members_Games.GameID AND Games.IDGame = " . $IDGame;  
$sort = "FaceBookName";
if (isset($_GET['sort']) )
{
	$sort = $_GET['sort'];
}
$query = $query . " ORDER BY " . $sort . ", FaceBookName"; 

$result = mysql_query($query) or trigger_error(mysql_error());
$i=0;
while($row = mysql_fetch_array($result)){ 
$i++;
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
echo "<tr class=\"memberList\">";  
//echo "<td valign='top'>" . nl2br( $row['IDMembers_Games']) . "</td>";  
//echo "<td valign='top'>" . nl2br( $row['MemberID']) . "</td>";  
//echo "<td valign='top'>" . nl2br( $row['GameID']) . "</td>";  
echo "<td valign='top'  class=\"memberList".($i & 1)."\">&nbsp;" . nl2br( $row['FaceBookName']) . "</td>"; 
echo "<td valign='top'  class=\"memberList".($i & 1)."\">&nbsp;" . nl2br( $row['MemberGameName']) . "</td>"; 
echo "<td valign='top'  class=\"memberList".($i & 1)."\">&nbsp;" . nl2br( $row['Instance']) . "</td>"; 
echo "<td valign='top'  class=\"memberList".($i & 1)."\">&nbsp;" . nl2br( $row['Guild']) . "</td>"; 
echo "<td valign='top'  class=\"memberList".($i & 1)."\">&nbsp;" . nl2br( $row['Info']) . "</td>"; 
//echo "<td valign='top'><a href=edit.php?IDMembers_Games={$row['Instance']}>Edit</a></td><td><a href=delete.php?IDMembers_Games={$row['IDMembers_Games']}>Delete</a></td> "; 
echo "</tr>"; 
} 
echo "</table>"; 
?>
<br />
<a href='listgames.php'><div>Back To Game's list</div></a>
<?
include('bottom.php'); 
?>