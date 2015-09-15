<?php
//Add friend script

if (isset($_POST['addfriend'])) {
    $user_to = $currentuser['username'];
    $user_from = $sesuser['username'];
    getInfo($user_from);
    $user_from_name = $user_info['first_name'].' '.$user_info['last_name'];
 
    if ($user_to != $user_from) {
        $create_request = mysql_query("INSERT INTO friend_requests (user_to, user_from) VALUES ('$user_to','$user_from')");
        $send_notification = mysql_query("INSERT INTO notifications (username, type, user_from, message) VALUES ('$user_to','friend_request','$user_from','$user_from_name wants to be friends with you')");
    }
}

//Remove friend and cancel request script
if (isset($_POST['removefriend'])) {
    $user_to = $currentuser['username'];
    $user_from = $sesuser['username'];

    $remove_friend = mysql_query("DELETE FROM friend_requests WHERE (user_from = '$user_from' AND user_to = '$user_to') OR (user_from = '$user_to' AND user_to = '$user_from')");

}
?>
