<?php 

include('include/dbcon.php');
include('include/functions.php');
$user = $sesuser['username'];

$message = $_POST['messages'];
$message = filterwords($message);
$time = date('Y-m-d H:i:s');
mysql_query("INSERT INTO messages VALUES ('','$message','$user','$time') ");
echo $message;

?>

