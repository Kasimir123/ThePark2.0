<style>
.title { font-weight: 500; }
</style>

<ul class="collection">

<?php
include('include/dbcon.php');

//Selects all of user's friends
$username = $currentuser['username'];
$sql_get_friends = "SELECT user_from FROM friend_requests WHERE user_to = '$username' UNION SELECT user_to FROM friend_requests WHERE user_from = '$username'";
$friends_result = mysql_query($sql_get_friends);
$friendid = '';

//Create frienders avatars
while($friendrow = mysql_fetch_assoc($friends_result)) {

    //Get friend's info from users table and store as array
    $friendname = $friendrow['user_from'];
    $sql_friend_info = mysql_query("SELECT * FROM users WHERE username = '$friendname'");
    $friend_info = mysql_fetch_assoc($sql_friend_info);

    //Check if the friend request has been confirmed
    $accepted_array = mysql_fetch_row(mysql_query("SELECT accepted FROM friend_requests WHERE user_from = '$friendname' AND user_to = '$username' OR user_to = '$friendname' AND user_from = '$username'"));
    //Create boolean value for accepted or not accepted
    $accepted = $accepted_array[0];

    if ($accepted==1) {
        echo '
        <li class="collection-item avatar">
            <a href="profile.php?u='.$friend_info['username'].'" class="black-text" style="text-transform: none;">
                <img src="'.$friend_info['avatar'].'" alt="" class="circle">
                <span class="title">'.$friend_info['first_name'].' '.$friend_info['last_name'].'</span>
                <p>'.$friend_info['username'].'<br>
            </a>
            '.$friend_info['email'].'
            </p>
            <a href="#!" class="secondary-content"><i class="material-icons teal-text">message</i></a>
        </li>
        ';
    }
}

?>

</ul>
