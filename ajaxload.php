<?php
mysql_connect("mysql1.000webhost.com","a4028871_test2","test123") or die("Couldn't connect to sql server") ;
mysql_select_db("a4028871_test2") or die("Couldn't select DB") ;

$DB = mysql_query("SELECT * FROM messages ORDER BY id ASC LIMIT 20");
while ($get = mysql_fetch_assoc($DB)) {
$get2 = $get['message'];
$get3 = $get['username'];
$chat = $get2;
$username1 = $get3;
echo '<div>' . '<br />' . $username1 . ': ' . $chat . '</div>';
}
?>
