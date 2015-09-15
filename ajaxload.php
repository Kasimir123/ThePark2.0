<?php
include('include/dbcon.php');
include('include/functions.php');

//Delete old messages
mysql_query("DELETE FROM messages WHERE added < (NOW() - INTERVAL 24 HOUR)");

$messages = mysql_query("SELECT * FROM messages ORDER BY id ASC");
$time = '';
$id = '';

while ($message = mysql_fetch_assoc($messages)) {
	if ($message['username']==$sesuser['username']) {
		//Load messages that were posted by you

		//Get information about the user who posted the message
		getInfo($message['username']);

		//Get info for last message in the loop
		$id = $message['id']-1;
		$lastmessage = mysql_fetch_assoc(mysql_query("SELECT * FROM messages WHERE id = $id"));

		/*If the last message was not posted in the last minute or a different user sent it than the last,
		start a new message bubble*/
		if (strtotime($message['added'])-$time >60 || $lastmessage['username'] != $message['username']) {
			echo filterwords('
			<div class="msgto">
				<span class="msgcontent">
			');
		} 	

		//Insert message text
		echo filterwords('
					<span class="string">'.$message['message'].'</span>
		');

		//Get info for next message in the loop
		$id = $message['id']+1;
		$nextmessage = mysql_fetch_assoc(mysql_query("SELECT * FROM messages WHERE id = $id"));
		$nexttime = strtotime($nextmessage['added']);

		/*If the next message was posted more than 60 seconds after the current one OR there are no more messages,
		end the current mesage bubble*/
		if ($nexttime-strtotime($message['added']) > 60 || !$nexttime || $nextmessage['username'] != $message['username']) {
			echo filterwords('
				</span>
				<div class="info">
					'.easyTime($message['added']).'
				</div>
				<a href="profile.php?u='.$user_info['username'].'"><img class="avatar" src="'.$user_info['avatar'].'"></a>
			</div>
			');
		}
		
		//Reset message timestamp for use in next part of loop
		$time = strtotime($message['added']);

	} else {
		//Load messages that weren't posted by you

		//Get information about the user who posted the message
		getInfo($message['username']);

		//Get info for last message in the loop
		$id = $message['id']-1;
		$lastmessage = mysql_fetch_assoc(mysql_query("SELECT * FROM messages WHERE id = $id"));

		/*If the last message was not posted in the last minute or a different user sent it than the last,
		start a new message bubble*/
		if (strtotime($message['added'])-$time >60 || $lastmessage['username'] != $message['username']) {
			echo filterwords('
			<div class="msgfrom">
				<a href="profile.php?u='.$user_info['username'].'"><img class="avatar" src="'.$user_info['avatar'].'"></a>
				<span class="msgcontent">
			');
		} 	

		//Insert message text
		echo filterwords('
					<span class="string">'.$message['message'].'</span>
		');

		//Get timestamp for next message in the loop
		$id = $message['id']+1;
		$nexttime = mysql_fetch_row(mysql_query("SELECT added FROM messages WHERE id = $id"));
		$nexttime = strtotime($nexttime[0]);

		/*If the next message was posted more than 60 seconds after the current one or there are no more messages,
		end the current mesage bubble*/
		if ($nexttime-strtotime($message['added']) > 60 || !$nexttime || $nextmessage['username'] == $message['username']) {
			echo filterwords('
				</span>
				<div class="info">
					'.$user_info['first_name'].' - '.easyTime($message['added']).'
				</div>
			</div>
			');
		}

		//Reset message timestamp for use in next part of loop
		$time = strtotime($message['added']);
	}
}

?>
