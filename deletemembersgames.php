<? 
include('config.php'); 
include('top.php');
$IDMembers_Games = (int) $_GET['IDMembers_Games']; 
$IDMember = (int) $_GET['IDMember']; 
mysql_query("DELETE FROM `Members_Games` WHERE `IDMembers_Games` = '$IDMembers_Games' ") ; 
echo (mysql_affected_rows()) ? "<div class=\"confirmationMessage\">Game deleted for this member.</div><br /> " : "Nothing deleted.<br /> "; 
?> 
<br/>
<a href='listmembersgames.php?IDMember=<?=$IDMember ?>'><div>Back to listing</div></a>