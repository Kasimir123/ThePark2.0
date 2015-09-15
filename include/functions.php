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
    $number = mysql_num_rows(mysql_query("SELECT id FROM friend_requests WHERE user_from = '$name1' AND user_to = '$name2' OR user_to = '$name2' AND user_from = '$name1'"));
    if ($number == 1) {
        return true;
    } else {
        return false;
    }
}

//Check if the two specified users' friendship has been accepted
function checkAccepted($name1, $name2) {
    $accepted_array = mysql_fetch_row(mysql_query("SELECT accepted FROM friend_requests WHERE user_from = '$name1' AND user_to = '$name2' OR user_to = '$name2' AND user_from = '$name1'"));
    $accepted = $accepted_array[0];
    if ($accepted == '0') {
        return false;
    } else {
        return true;
    }
}

function filterwords($text){

    $filterWords = array('darn','fuck','mother fucker','motherfucking','motherfucker','shit','bitch','bitches','goddamn','dick','dicks','fux','whore','vagina','vaginas','pussy','damn','tit','tits','crap','fucker','fuckable','fuckboy','fucky','nigger','negro','ass','boobies','boobs','porn','fucking','retarded','sex','69','truffle butter','sexy','poussey','cum','cumm','arse','arsehole','arse hole','g-spot','g spot','nigga' );
    $filterCount = sizeof($filterWords);

    for($i=0; $i<$filterCount; $i++){
        $text = preg_replace('/\b'.$filterWords[$i].'\b/ie',"str_repeat('*',strlen('$0'))",$text);
    }

    return $text;
}

//Convert any timestamp into easily readable times, ex 'Just now', '2m', '4h'
function easyTime($timestamp) {
    $timestamp = strtotime($timestamp.' EDT');
    $currenttime = time();
    $messAge = $currenttime - $timestamp;

    global $easyTime;

    if ($messAge < '60') {
        $easyTime = 'Just now';
    } else if ($messAge/60 < '60') {
        $easyTime = floor($messAge/60).'m';
    } else if ($messAge/3600 < '24') {
        $easyTime = floor($messAge/3600).'h';
    } else if ($messAge/86400 < '7') {
        $easyTime = floor($messAge/86400).'d';
    } else if ($messAge/605500 < '52') {
        $easyTime = floor($messAge/605500).'w';
    } else {
        $easyTime = floor($messAge/31536000).'y';
    }
    
    return $easyTime;
}

function truncate($text, $length) {
    $text = $text." ";
    $text = substr($text,0,$length);
    $text = substr($text,0,strrpos($text,' '));
    $text = $text."...";
    return $text;
}

function loadComments($length) {
    if ($length == 'short') {

    } else {

    }
}

?>
