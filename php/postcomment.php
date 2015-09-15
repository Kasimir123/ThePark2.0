<?php

include('../include/dbcon.php');
$postid = $_POST['post'];
//$username = $_POST['name'];
$comment = $_POST['comment'];

echo $comment.'!';

mysql_query("INSERT INTO comments (post_id, username, comment) VALUES ('$postid','alex','$comment')");

?>
