<?php

//Get all friends from specified user and return as num array
function getFriends($username) {
    $sql = "SELECT user_from FROM friend_requests WHERE user_to = '$username' UNION SELECT user_to FROM friend_requests WHERE user_from = '$username'";
    $result = mysql_query($sql);
    global $all_friends;
    $all_friends = array();

    while($friendrow = mysql_fetch_assoc($result)) {
        $friendname = $friendrow['user_from'];
        array_push($all_friends,$friendname);
    }
}

//Get all information from specified user etc. first name, avatar, email
function getInfo($name) {
    global $user_info;
    $sql = mysql_query("SELECT * FROM users WHERE username = '$name'");
    $user_info = mysql_fetch_assoc($sql);
}

//Check if the two specified users are friends
function checkFriends($name1, $name2) {
    global $arefriends;
    $number = mysql_num_rows(mysql_query("SELECT id FROM friend_requests WHERE user_from = '$name1' AND user_to = '$name2' OR user_to = '$name2' AND user_from = '$name1'"));
    if ($number == 0) {
        return false;
    } else {
        return true;
    }
}

//Check if the two specified users' friendship has been accepted
function checkAccepted($name1, $name2) {
    $accepted_array = mysql_fetch_row(mysql_query("SELECT accepted FROM friend_requests WHERE user_from = '$name1' AND user_to = '$name2' OR user_to = '$name2' AND user_from = '$name1'"));
    $accepted = $accepted_array[0];
    if ($accepted != 0) {
        return true;
    } else {
        return false;
    }
}

?>
