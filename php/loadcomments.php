<?php
    include('../include/dbcon.php');
    include('../include/functions.php');
    $postid = $_POST['id'];
    $commentsql = mysql_query("SELECT * FROM comments WHERE post_id = '$postid' ORDER BY timestamp");

    while($commentinfo = mysql_fetch_assoc($commentsql)) {
        getInfo($commentinfo['username']);
        echo filterwords('
            <div class="comment" style="margin: 8px 0px;">
                <a href="profile.php?u='.$user_info['username'].'" title="'.$user_info['username'].'"style="color: #000; text-transform: none; margin: 0px 3px 0px 0px;"><img src="'.$user_info['avatar'].'" style="width: 30px; height: 30px; border-radius: 50%;"/>
                <p style="position: relative; bottom: 10px; left: 7px; display: inline;"><b>'.$user_info['first_name'].' '.$user_info['last_name'].' </b></a><span id="cmtstring">'.$commentinfo['comment'].'</span></p>
            </div>
        ');
    }
?>
