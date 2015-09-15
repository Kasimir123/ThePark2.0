<?php

include ('../include/dbcon.php');

$user_to = $_GET['to'];
$user_from = $sesuser['username'];

if ($user_to==$user_from) {
    echo "You can't friend yourself";
} else {
    $sql = "INSERT INTO friend_requests (user_to, user_from) VALUES ('$user_to','$user_from')";
    mysql_query($sql);
}

$addrequest = "INSERT INTO friend_requests (user_to, user_from) VALUES ('$user_to','$user_from')";

header('Location: ../profile.php');

?>
