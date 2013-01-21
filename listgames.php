<? 
include('config.php'); 
include('top.php'); 
?>
<a href='list.php'><div>Back To Member's list</div></a>
<br>
<?
echo "<table class=\"memberListTable\" cellspacing=\"0\">";
echo "<tr>";  
echo "<td class=\"memberList0\"><b><a href=\"listgames.php?sort=Name\">Name</b></td>"; 
echo "<td class=\"memberList0\"><b><a href=\"listgames.php?sort=Website\">Website</b></td>"; 
echo "<td class=\"memberList0\"><b><a href=\"listgames.php?sort=MemberToContact\">Member to Contact</b></td>"; 
if ($auth)
{
	echo "<td class=\"memberList0\" colspan=\"2\">";
	echo "<b><a href=newgame.php>Add New Game</a></b>";
	echo "</td>"; 
}
echo "</tr>"; 

$query = "SELECT IDGame,Name,Website,MemberToContact FROM `Games`";
$sort = "Name";
if (isset($_GET['sort']) )
{
	$sort = $_GET['sort'];
}
$query = $query . " ORDER BY " . $sort . ", Name"; 

$result = mysql_query($query) or trigger_error(mysql_error()); 
$i=0;
while($row = mysql_fetch_array($result)){ 
$i++;
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
echo "<tr  class=\"memberList\" >";   
echo "<td valign='top' class=\"memberList".($i & 1)."\">&nbsp;<a href=listgamemembers.php?IDGame={$row['IDGame']}>" . nl2br( $row['Name']) . "</a></td>";  
echo "<td valign='top' class=\"memberList".($i & 1)."\">&nbsp;<a href =\"\" onclick=\"javascript:window.open('" . nl2br( $row['Website']) . "', '_blank');return false;\">" . nl2br( $row['Website']) . "</a></td>";  
echo "<td valign='top' class=\"memberList".($i & 1)."\">&nbsp;" . nl2br( $row['MemberToContact']) . "</td>";  
if ($auth)
{
echo "<td valign='top' class=\"memberList".($i & 1)."\" >&nbsp;<a href=editgame.php?IDGame={$row['IDGame']}>Edit</a></td>";
echo "<td valign='top' class=\"memberList".($i & 1)."\" >";
echo "&nbsp;<a href=\"deletegame.php?IDGame={$row['IDGame']}\"   onclick=\"return confirmDelete('" .  addslashes($row['Name']) . "');\">Delete</a>";
echo "</td> "; 
}
echo "</tr>"; 
} 
echo "</table>"; 
?>
<br>
<a href='list.php'><div>Back To Member's list</div></a>
<?
include('bottom.php'); 
?>