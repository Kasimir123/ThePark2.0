<?php

//Prevent deprecation errors from showing
error_reporting(0);

//Connect to database and select database
mysql_connect("mysql1.000webhost.com","a4028871_test2","test123") or die("Couldn't connect to sql server") ;
mysql_select_db("a4028871_test2") or die("Couldn't select DB") ;

//Start session
session_start();

global $currentuser;
global $sesuser;

//Get id from either session variable or url and set as $currentuser
if ($_GET['u']) {
    $currentuser = $_GET['u'];
} else if ($_SESSION['user_login']) {
    $currentuser = $_SESSION['user_login'];
}

//Set $sesuser to username of person logged in
$sesuser = $_SESSION['user_login'];

//Get current user's row and covert to array
$sql_fetch_row = "SELECT * FROM users WHERE username = '$currentuser'";
$result = mysql_query($sql_fetch_row);
$currentuser = mysql_fetch_assoc($result);

//Get logged in user's row and convert to array
$sql_fetch_row = "SELECT * FROM users WHERE username = '$sesuser'";
$result = mysql_query($sql_fetch_row);
$sesuser = mysql_fetch_assoc($result);

//Turn error reporting back on
error_reporting(E_ALL);

?>
