<?php 

	
	include('include/dbcon.php');


$user = $sesuser['username'];


	$message = $_POST['messages'];
	mysql_query("INSERT INTO messages VALUES ('','$message','$user') ");
	echo $message;

?>

