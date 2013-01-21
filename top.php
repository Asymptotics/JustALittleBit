<?
// Admin auth
 session_start();
 $auth = false;
 $user_check=$_SESSION['login_user'];
 $ses_sql=mysql_query("select username from admins where username='$user_check' ");


 $rowadm=mysql_fetch_array($ses_sql);

 $login_session=$rowadm['username'];

 if(!isset($login_session))
 {
	$auth = false;
 }
 else
 {
	$auth = true;
 }
 
 //Facebook Member authent
  $sessionFaceBookName=$_SESSION['FaceBookName'];
  
 
?>
<html>
<head>
<STYLE type="text/css">
BODY
{
	font-family : Arial, Verdana;
	font-size :15px;
}

h1
{
	font-size :35px;
}

A{ color:DarkRed; text-decoration: none; font-weight:bold;}


A:visited { color:DarkRed;text-decoration: none;font-weight:bold;}

A:hover { color:Green;text-decoration: none;font-weight:bold;}

INPUT
{
	border:1px solid darkred; 
}

   .memberListTable
   {
		vertical-align:middle;
		border-color :black;
		border-width : 1px;
		border-style:solid;
   }
   .memberList0
   {
		vertical-align:middle;
		border-color :black;
		border-width : 1px;
		border-style:solid;
   }
   .memberList1
   {
		vertical-align:middle;
		background-color : #BBBBBB;
		border-color :black;
		border-width : 1px;
		border-style:solid;
   }
   
   .highlighted
   {
		background-color : yellow !important;
   }
   
   .confirmationMessage
   {
		color : green;
   }
   .menu
   {
		font-size : 20px;
   }
 </STYLE>
<script  src="/js/jquery-1.8.3.min.js" type="text/javascript"></script>
<script type="text/JavaScript" >

function confirmDelete(itemToDelete)
{
	if (window.confirm("Are you sure you want to delete " + itemToDelete))
	{
		return true;
	}
	else
	{
		return false;
	}
}

// Popup window code
function newPopup(url) {
	popupWindow = window.open(
		url,'popUpWindow','height=700,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=no,menubar=no,location=no,directories=no,status=yes')
}


</script>
</head>
<body>
<table>
<tr>
<td colspan="2">
<h1><b><a href='http://justalittlebit.free.fr'  >Just A Little List</a></b></h1>
<?
 if(isset($sessionFaceBookName))
 {
?>
	Welcome, <b><?= $sessionFaceBookName ?></b><br>
<?
}
?>
</td>
</tr>
<tr>
<td>
<a href='list.php' class="menu" >Members</a>
</td>
<td>
<a href='listgames.php'  class="menu">Games</a>
</td>
<td>
<a href=""  class="menu" onclick="javascript:newPopup('help.html');return false;">Help</a>
</td>
</tr>
<tr>
<td colspan="2">
<a href='login.php'  >Log as an admin</a>
</td>
</tr>
</table>

<BR/><BR/>
This page requires pop-ups to log in and edit your content. Not all functions will work if your browser refuses pop-up windows
<BR />
Don't see your name in the list? Contact us at <a href="mailto:justalittlebit@free.fr">justalittlebit@free.fr</a>.
<BR/><BR/>