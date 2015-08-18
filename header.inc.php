<?php 
include ( "./inc/connect.inc.php" ); 
session_start();
if (isset($_SESSION['user_login'])) {
$user = $_SESSION["user_login"];
}
else {
$user = "";
}
?>
<!doctype html>
<html>
	<head>
		<title>The Park</title>
		<script src="http:ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
		<script src="main.js" type="text/javascript"></script>
		<link rel="stylesheet" type="text/css" href="index.css">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	</head>
	<body>
		<div class= "headerMenu"></div>
			<div id= "wrapper"> 
				<div class= "logo" style="width: 200px;">
					<h1 style="	background-color: #66BB6A; width: 150px; height: 38px; position: relative; top: -50px; font-size: 30px; color: white; font-family: Franklin Gothic">The Park</h1>
				</div>
				
				
					<?php
					if (isset($_SESSION['user_login'])) {
if ($u) {
	$uq = $_POST['u'];
}
					echo '<div class= "search_box">
					<form action="profile.php?u=$uq" method= "GET" id= "search">
						<input type= "text" name= "u" id="u" size= "60" placeholder= "Search ..." />
					</form>
				</div>';
			}
				?>
				<?php
				if (isset($_SESSION['user_login'])) {
					echo '<div id ="menu">
					<a href="profile.php?u='.$_SESSION["user_login"].'"/>Profile</a>
					<a href="features.php"/>Features</a>
					<a href="account_settings.php"/>Account Settings</a>
					<a href="logout.php"/>Log Out</a>
					</div>';
				}
				 else {
				echo '<div id="menu">
					<a href="index.php"/>Sign Up</a>
					<a href="index.php"/>Log In</a>
				</div>';
				}
				?>
				</div>
				<div id="wrapper">
				<br />
				<br />
				<br />
				<br />
				<br />
