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
$IDGame = (int) $_GET['IDGame']; 
//Delete all members/games links associated with this game
mysql_query("DELETE FROM `Members_Games` WHERE `GameID` = '$IDGame' ") ; 
mysql_affected_rows();
//Now delete the game
mysql_query("DELETE FROM `Games` WHERE `IDGame` = '$IDGame' ") ; 
echo (mysql_affected_rows()) ? "<div class=\"confirmationMessage\">Game deleted.</div><br /> " : "Nothing deleted.<br /> "; 
?> 
<br/>
<a href='listgames.php'><div>Back to Games list</div></a>