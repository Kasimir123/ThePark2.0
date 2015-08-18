<?php

include('include/dbcon.php');

//Redirect user to main page if not signed in
if (!isset($_SESSION['user_login'])) {
	header('Location: index.php');
}

//Redirect user to main page if requested user doesn't exist
$currentusername = $currentuser['username'];
$sql_find_username = mysql_query("SELECT username FROM users WHERE username = '$currentusername'");
if (mysql_num_rows($sql_find_username) == 0) {
	header('Location: index.php');
}
$user = $sesuser['username'];
?>

<html>
<head>

<?php include('include/import.php'); ?>

<style>

#coverphoto {
		height: 470px;
		background-image: url(<?php echo $currentuser['cover'];?>);
		background-size: cover;
		background-position: 50% 50%;
		/*
		-webkit-box-shadow: inset 0px 17px 5px -15px rgba(0,0,0,0.2);
		   -moz-box-shadow: inset 0px 17px 5px -15px rgba(0,0,0,0.2);
				box-shadow: inset 0px 17px 5px -15px rgba(0,0,0,0.2);*/
}

#gradient {
		height: inherit;
		background: rgba(0,0,0,.5);
		background: linear-gradient(0deg, rgba(0,0,0,.4), rgba(0,0,0,.1), rgba(0,0,0,0));
		position: relative;
}

#info {
		color: #FFF;
		width: 100%;
		text-align: center;
		position: absolute;
		bottom: 0;
		padding: 25px;
}

#profileavatar {
		width: 150px; border-radius: 50%;
		-webkit-box-shadow: 0px 2px 8px 0px rgba(0,0,0,0.6);
			 -moz-box-shadow: 0px 2px 8px 0px rgba(0,0,0,0.6);
						box-shadow: 0px 2px 8px 0px rgba(0,0,0,0.6);
}

#name { font-size: 27pt; font-weight: 300; }

#bio { font-size: 14pt; position: relative; bottom: 8px; }

.masonry-grid:after { content: ''; display: block;  clear: both; } /* clearfix */
.masonry-grid { margin: 0 auto; }
.grid-item { width: 49%; float: left; margin-bottom: 8px; }

</style>

</head>
<body style=" height: 100%;">

<?php include('include/header.php'); ?>

<div class="container z-depth-1" style="background: #f9f9f9;">

	<!-- Cover photo -->
	<div id="coverphoto">
			<div id="gradient">
					<div id="info">
							<img id="profileavatar" src="<?php echo $currentuser['avatar'];?>"/>
							<h3 id="name"><?php echo $currentuser['first_name'].' '.$currentuser['last_name'];?></h3>
							<h5 id="bio"><?php echo '@'.$currentuser['username'];?></h5>
					</div>
			</div>
	</div>

	<!-- Tabs and content -->
	<div id="tabs">
		<div class="s12" style="margin-bottom: 12px;">
			<ul class="tabs" style="width: 100px; background: #eaeaea;">
				<li class="tab"><a href="#about">About</a></li>
				<li class="tab"><a href="#interests">Interests</a></li>
				<li class="tab"><a class="active" href="#posts">Posts</a></li>
				<li class="tab"><a href="#photos">Photos</a></li>
				<li class="tab"><a href="#places">Places</a></li>
			</ul>
		</div>

		<div style="padding: 5px 20px;"><!-- Container for content -->

			<!-- About tab -->
			<div id="about" class="col s12">
				<div class="row">
					<div class="col s12 m6">
						<div class="card">
							<!-- Friends card -->
							<div class="card-content">
								<span class="card-title black-text">Friends</span>
								<br/>
								<style> #avatar { margin: 5px 5px 0px 5px; } </style>
								<?php include('include/friends/all.php');?>
							</div>

							<div class="card-action">
								<!-- Links -->
								<a href="#friendsmodal" class="teal-text modal-trigger">See all friends</a>
								<!-- send friend request -->
								<?php
									//Add friend script
									$message = '';

									if (isset($_POST['addfriend'])) {
										$user_to = $currentuser['username'];
										$user_from = $sesuser['username'];
									 
										if ($user_to != $user_from) {
											$create_request = mysql_query("INSERT INTO friend_requests (user_to, user_from) VALUES ('$user_to','$user_from')");
											$message = "Your friend Request has been sent!";
										}
										echo $message; //This is temporary
									}

									//Remove friend and cancel request script
									if (isset($_POST['removefriend'])) {
										$user_to = $currentuser['username'];
										$user_from = $sesuser['username'];

										$create_request = mysql_query("DELETE FROM friend_requests WHERE (user_from = '$user_from' AND user_to = '$user_to') OR (user_from = '$user_to' AND user_to = '$user_from')");
										$message = "You are no longer friends.";

										echo $message; //This is temporary
									}
								?>
							</div>

							<form action="<?php echo 'profile.php?u='.$username; ?>" method="POST">

								<?php
									$friendButton = '';

									if ($currentuser['username'] != $sesuser['username']) {
										if (checkFriends($sesuser['username'],$currentuser['username'])) {
											if (checkAccepted($sesuser['username'],$currentuser['username'])) {
												//If the two users are already friends, create remove friend button
												$friendButton = '<input type="submit" name="removefriend" value="Remove Friend">';
											} else {
												//If the other friend hasn't accepted yet, create cancel request button
												$friendButton = '<input type="submit" name="removefriend" value="Cancel Request">';
											}
										} else {
											//If they are friends, create add friend button
											$friendButton = '<input type="submit" name="addfriend" value="Add Friend">';
										}
									}

									echo "$friendButton";
									
								?>

							</form>
								
							<!-- All friends modal -->
							<div id="friendsmodal" class="modal modal-fixed-footer">
								<div class="modal-content">
									<!-- Title -->
									<h5><?php $string = $currentuser['first_name']; echo $string.'\''.($string[strlen($string) - 1] != 's' ? 's' : '');?> friends</h5>
									<br/>
									<?php include('include/friends/formatted.php');?>
								</div>
								<div class="modal-footer">
									<a href="#!" class="modal-action teal-text waves-effect waves-teal btn-flat" onmouseup="$('#friendsmodal').closeModal();">Done</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Interests tab -->
			<div id="interests" class="col s12">Test 2</div>

			<!-- Posts tab -->
			<div id="posts">
				<?php include('include/posts.php');?>
			</div>

			<!-- Photos tab -->
			<div id="photos" class="col s12">Test 4</div>
			<!-- Places tab -->
			<div  id="places" class="col s12">Test 5</div>

		</div>
	</div>
</div>



<script>

$(document).ready( function() {

$('.masonry-grid').masonry({
	itemSelector: '.grid-item',
	isFitWidth: true,
	gutter: 10
	});   
});

</script>

</body>
</html>
