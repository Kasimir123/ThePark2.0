<?php 

	
	include('include/dbcon.php');


$user = $sesuser['username'];


	$message = $_POST['messages'];
	$time = date('Y-m-d H:i:s');
	mysql_query("INSERT INTO messages VALUES ('','$message','$user','$time') ");
	echo $message;

?>

