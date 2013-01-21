<? 
include('config.php'); 
include('top.php');

if (!$auth)
{
?>
<script type="text/javascript">
window.location = "list.php";
</script>
<?
}

$IDMember = (int) $_GET['IDMember']; 
//Delete all members/games links associated with this Member
mysql_query("DELETE FROM `Members_Games` WHERE `MemberID` = '$IDMember' ") ; 
mysql_affected_rows();
mysql_query("DELETE FROM `Members` WHERE `IDMember` = '$IDMember' ") ; 
echo (mysql_affected_rows()) ? "<div class=\"confirmationMessage\">Member deleted.</div><br /> " : "Nothing deleted.<br /> "; 
?> 
<br/>
<a href='list.php'><div>Back To Member's list</div></a>