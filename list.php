<? 
include('config.php'); 
include('top.php');

echo "<table class=\"memberListTable\" cellspacing=\"0\">"; 
echo "<tr>"; 
echo "<th class=\"memberList0\"><b><a href=\"list.php?sort=FaceBookName\">FaceBook Name</a></b></th>"; 
echo "<th class=\"memberList0\"><b><a href=\"list.php?sort=CoHGlobal\">CoH Global / NickName</a></b></th>"; 
echo "<th class=\"memberList0\"><b><a href=\"list.php?sort=SkypeName\">Skype Name</a></b></th>"; 
echo "<th class=\"memberList0\"><b><a href=\"list.php?sort=SteamName\">Steam Name</a></b></th>"; 

if ($sessionFaceBookName != "" || $auth)
{
	echo "<th class=\"memberList0\" colspan=\"2\">&nbsp;";
	if ($auth)
	{
		echo "<b><a href=\"new.php\">Add New Member</a></b>";
	}
	echo "</th>"; 
}

echo "</tr>"; 
$query = "SELECT FaceBookName,CoHGlobal,SkypeName,SteamName, IDMember, FaceBookLink   FROM `Members`";
$sort = "FaceBookName";
if (isset($_GET['sort']) )
{
	$sort = $_GET['sort'];
}
$query = $query . " ORDER BY " . $sort . ", FaceBookName"; 
//echo $query;
$result = mysql_query($query) or trigger_error(mysql_error()); 
$i = 0;
while($row = mysql_fetch_array($result)){ 
$i++;
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
echo "<tr  class=\"memberList\">"; 
echo "<td  class=\"memberList".($i & 1)."\" valign=\"top\"><a style=\"vertical-align:middle\" href=\"listmembersgames.php?IDMember={$row['IDMember']}\">" . nl2br( $row['FaceBookName']) . "</a>";
$FaceBookLink = $row['FaceBookLink'];
if (isset($FaceBookLink) && $FaceBookLink!="")
{
echo "<a href=\"\" style=\"vertical-align:middle\" onclick=\"javascript:window.open('{$FaceBookLink}','_blank');return false;\" >&nbsp;<img style=\"vertical-align:middle\" border=\"0\" src=\"/images/Facebook.png\" /></a>";
}
echo "</td>";  
echo "<td  class=\"memberList".($i & 1)."\" valign=\"top\">" . nl2br( $row['CoHGlobal']) . "</td>";   
echo "<td  class=\"memberList".($i & 1)."\" valign=\"top\">&nbsp;" . nl2br( $row['SkypeName']) . "</td>";  
echo "<td  class=\"memberList".($i & 1)."\" valign=\"top\">&nbsp;" . nl2br( $row['SteamName']) . "</td>";  


if ($sessionFaceBookName !="" || $auth)
{
	echo "<td class=\"memberList".($i & 1)."\" style=\"width:125px;\"  valign=\"top\">";
	if ($sessionFaceBookName == $row['FaceBookName'] || $auth)
	{
		echo "<a href=\"edit.php?IDMember={$row['IDMember']}\">Edit Member</a><BR>";
		echo "<a style=\"vertical-align:middle;\" href=\"listmembersgames.php?IDMember={$row['IDMember']}\">Edit Games</a><BR>";
	}
	echo "</td>";
}

if ($auth)
{
	echo "<td  class=\"memberList".($i & 1)."\"  valign=\"top\">";
	echo "<a href=\"delete.php?IDMember={$row['IDMember']}\"  onclick=\"return confirmDelete('" .  addslashes($row['FaceBookName']) . "');\">Delete</a>";
	echo "</td> "; 
}
/*
}
*/
echo "</tr>"; 
} 
echo "</table>"; 
include('bottom.php');
?>