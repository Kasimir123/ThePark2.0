<?php

include('../include/dbcon.php');

//Create variables from form
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$md5 = hash('sha256', $password);
$d = date("Y-m-d");

// username check

$u_check = mysql_query("SELECT username FROM users WHERE username= '$username'");
$check = mysql_num_rows($u_check);

// email check

$e_check = mysql_query("SELECT email From users WHERE email ='$email'");
$email_check = mysql_num_rows($e_check);

$sql_signup = "INSERT INTO users (first_name, last_name, email, username, password,sign_up_date) VALUES ('$firstname','$lastname','$email','$username','$md5','$d')";

if ($check == 0) {
	if ($email_check == 0) {
		if (strlen($username) > '4') {
			if (strlen($password) > '7') {
				if (mysql_query($sql_signup)) {
					session_start();
					$_SESSION['user_login']=$username;

					header('Location: ../profile.php');
				} else {
					echo 'Failed to create account';
				}
			} else {
				echo 'Password must be at least 8 characters long';
			}
		} else {
			echo 'Username is too short';
		}
	} else {
		echo 'This email has already been used';
	}
} else {
	echo 'Username is taken';
}


?>
