<?php
include ("./include/dbcon.php");

session_start();
if (!isset($_SESSION["user_login"])) {

}
else
{
	$username = $_SESSION["user_login"];
}

$post = $_POST['post'];
if ($post != "") {
$date_added = date("Y-m-d");
$user_posted_to = $username;
$added_by = $user;

$sqlCommand = "INSERT INTO posts VALUES('', '$post', '$date_added', 'added_by', '$user_posted_to')";
$query = mysql_query($sqlCommand) or die (mysql_error());
}
else
{
echo "You must enter something into the post field before you can send it ...";
}
?>
