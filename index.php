<?php

include('include/dbcon.php');


/* if (isset($_SESSION['user_login'])) {
	header('Location: home.php');
}
*/
//Login script
if (isset($_POST["user_login"]) && isset($_POST["password_login"])) {
	//Replace unwanted characters, set username and password variables
    $user_login = preg_replace('#[^A-Za-z0-9]#i', '', $_POST["user_login"]);
    $password_login = preg_replace('#[^A-Za-z0-9]#i', '', $_POST["password_login"]);

    //Encrypt password using MD5
    $password_login_md5 = md5($password_login);

    //Check database for row with the username and password that was entered
    $sql = mysql_query("SELECT id FROM users WHERE username='$user_login' AND password='$password_login_md5' LIMIT 1");

    //Check if SQL query returned result, if so, allow login
    $userCount = mysql_num_rows($sql);
    if ($userCount == 1) {
        while($row = mysql_fetch_array($sql)) { 
             $id = $row["id"];
    	}	

        $_SESSION["user_login"] = $user_login;
        header("location: home.php");
        exit();
    } else {
    echo 'That Log In information is incorrect, please try again';
    exit();
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>The Park</title>

	<?php include('include/import.php'); ?>

</head>
<body>
	<?php include('include/header.php') ?>

	<div id="index-banner" class="parallax-container" style="width: 100%">
		<div class="section no-pad-bot">
			<div class="container">
				<br><br>
				<h1 class="header center green-text text-lighten-1">The Park</h1>
				<div class="row center">
					<h5 class="header col s12 light">Connect to your Community</h5>
				</div>
				<div class="row center">
					<?php 
						error_reporting(0);
						if ($_SESSION['id']) {
							echo '<a class="btn-large waves-effect waves-light green" href="profile.php">Go to profile</a>';
						} else {
							echo '<a class="modal-trigger btn-large waves-effect waves-light green" href="#loginmodal">Log in</a>';
						}
						error_reporting(E_ALL);
					?>
				</div>
				<br><br>

			</div>
		</div>
		<div class="parallax"><img src="http://i.imgur.com/w79DYdw.jpg" alt="Unsplashed background img 1"></div>
	</div>


	<div class="container">
		<div class="section">
			<!--   Icon Section   -->
			<div class="row">
				<div class="col s12 m4">
					<div class="icon-block">
						<h2 class="center brown-text"><i class="material-icons">face</i></h2>
						<h5 class="center">Connect with friends</h5>

						<p class="light">Talk all of your closest friends, or find new ones. You can share photos, meet new friends in Global Chat, or just talk to your best friends!</p>
					</div>
				</div>

				<div class="col s12 m4">
					<div class="icon-block">
						<h2 class="center brown-text"><i class="material-icons">explore</i></h2>
						<h5 class="center">Discover posts</h5>

						<p class="light">You'll see everthing your friends, family, and others have posted, or follow other people and places you're interested in.</p>
					</div>
				</div>

				<div class="col s12 m4">
					<div class="icon-block">
						<h2 class="center brown-text"><i class="material-icons">favorite</i></h2>
						<h5 class="center">Get help from others</h5>

						<p class="light">You can ask for help on anything that you need. Just simply post a help wanted poster on the help wanted page!</p>
					</div>
				</div>
			</div>

		</div>
	</div>


	<div class="parallax-container valign-wrapper">
		<div class="section no-pad-bot">
			<div class="container">
				<div class="row center">
					<h5 class="header col s12 light">Meet new friends and chat with old ones</h5>
				</div>
			</div>
		</div>
		<div class="parallax"><img src="http://i.imgur.com/Aiq2XEu.jpg" alt="Unsplashed background img 2"></div>
	</div>

	<div class="container">
		<div class="section">

			<div class="row">
				<div class="col s12 center">
					<h3><i class="mdi-content-send brown-text"></i></h3>
					<h4>About Us</h4>
					<p class="left-align light">The Park is a social networking site created by two Myers Park students for Myers Park. The Park was created for the Myers Park community to come together. It offers a safe way for people talk to old friends, meet new ones, and recieve help quickly by people who have already had to go through the same issues. The site will be free to use forever and will constantly be updated with new features.</p>
				</div>
			</div>

		</div>
	</div>


	<div class="parallax-container valign-wrapper">
		<div class="section no-pad-bot">
			<div class="container">
				<div class="row center">
					<h5 class="header col s12 light">Get help from your peers</h5>
				</div>
			</div>
		</div>
		<div class="parallax"><img src="http://i.imgur.com/Y0s2Bkz.jpg" alt="Unsplashed background img 3"></div>
	</div>

	<?php include('include/footer.php') ?>

	</body>
</html>
