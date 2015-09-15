<?php

function loadComments($length) {
    if ($length == 'short') {
        while($commentinfo = mysql_fetch_assoc($commentsql)) {
            getInfo($commentinfo['username']);
            $length = strlen($user_info['first_name'].' '.$user_info['last_name'])-$length;

            return filterwords('
                <div id="comment" style="margin: 8px 0px;">
                    <a href="profile.php?u='.$user_info['username'].'" title="'.$user_info['username'].'"style="color: #000; text-transform: none; margin: 0px 3px 0px 0px;"><img src="'.$user_info['avatar'].'" style="width: 30px; height: 30px; border-radius: 50%;"/>
                    <p style="position: relative; bottom: 10px; left: 7px; display: inline;"><b>'.$user_info['first_name'].' '.$user_info['last_name'].' </b></a>'.truncate($commentinfo['comment'],$length).'</p>
                </div>
            ');
        }
    } else {
        while($commentinfo = mysql_fetch_assoc($commentsql)) {
            getInfo($commentinfo['username']);
            return filterwords('
                <div id="comment" style="margin: 8px 0px;">
                    <a href="profile.php?u='.$user_info['username'].'" title="'.$user_info['username'].'"style="color: #000; text-transform: none; margin: 0px 3px 0px 0px;"><img src="'.$user_info['avatar'].'" style="width: 30px; height: 30px; border-radius: 50%;"/>
                    <p style="position: relative; bottom: 10px; left: 7px; display: inline;"><b>'.$user_info['first_name'].' '.$user_info['last_name'].' </b></a>'.$commentinfo['comment'].'</p>
                </div>
            ');
        }
    }
}

?>
