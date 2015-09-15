<?php 

include('../include/dbcon.php');
$id = $sesuser['id'];

mysql_query("DELETE FROM users WHERE id = '$id'");

?>
