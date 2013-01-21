<?php

include("config.php");
include ("top.php");
session_start();
 if($_SERVER["REQUEST_METHOD"] == "POST")
 {
	
	// user Facebook name sent from form
	if (isset($_POST['FBName']))
	{
		echo $_POST['FBName'];
		$memberFacebookname=addslashes($_POST['FBName']); 
		session_register("FaceBookName");
		$_SESSION['FaceBookName']= str_replace ('\\', '', $memberFacebookname);
	}
		?>	
		<script type="text/javascript">
		window.location = "list.php";
		</script>
<?
 }
$myusername=addslashes($_POST['username']);
?>
<html>
	<head>
	</head>
	<body>
		<div id="fb-root"></div>
		<script>
		  // Additional JS functions here
		  window.fbAsyncInit = function() {
			FB.init({
			  appId      : '271930842929838', // App ID
			  channelUrl : '//justalittlebit.free.fr/channel.html', // Channel File
			  status     : true, // check login status
			  cookie     : true, // enable cookies to allow the server to access the session
			  xfbml      : true  // parse XFBML
			});

			// Additional init code here
			FB.getLoginStatus(function(response) {
				if (response.status === 'connected') {
					// connected
					testAPI();
				} else if (response.status === 'not_authorized') {
					// not_authorized
					login();
				} else {
					// not_logged_in
					login();
				}
				});
			};

		  // Load the SDK Asynchronously
		  (function(d){
			 var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
			 if (d.getElementById(id)) {return;}
			 js = d.createElement('script'); js.id = id; js.async = true;
			 js.src = "//connect.facebook.net/en_US/all.js";
			 ref.parentNode.insertBefore(js, ref);
		   }(document)); 
		function login() {
			FB.login(function(response) {
				if (response.authResponse) {
					// connected
					testAPI();
				} else {
				}
			});
		}
		function testAPI() {
		FB.api('/me', function(response) {
			document.memberAuth.FBName.value = response.name;
			document.memberAuth.submit();
		});
		}
		</script>
		
		<form name="memberAuth" method="post" action ="">
			<input type="hidden" name ="FBName" id="FBName" />
		</form>
		
	</body>
</html>