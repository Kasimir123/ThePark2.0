<style>

#post-textarea {
	height: 87px;
	border: solid 1px #E0E0E0;
	border-radius: 4px;
	resize: none;
	background: #FFF;
}

</style>
<!-- php for post system -->
<?php
	$user = $sesuser['username'];

	$post = @$_POST['post-textarea'];
	if ($post != "") {
	$date_added = date("Y-m-d");
	$added_by = $user;
	$user_posted_to = $username;

	$sqlCommand = "INSERT INTO posts VALUES('', '$post','$date_added','$added_by','$user_posted_to')";  
	$query = mysql_query($sqlCommand) or die (mysql_error()); 

	}
 function filterwords($body){
 $filterWords = array('darn','fuck','mother fucker','motherfucking','motherfucker','shit','poo','goddamn','dick','dicks','fux','whore','vagina','vaginas','pussy','damn','tit','tits','crap','fucker','fuckable','fuckboy','fucky','nigger','negro','ass','boobies','boobs','porn','fucking','retarded','sex','69','truffle butter','sexy','poussey','cum','cumm','arse','arsehole','arse hole','g-spot','g spot','nigga' );
 $filterCount = sizeof($filterWords);
 for($i=0; $i<$filterCount; $i++){
  $body = preg_replace('/\b'.$filterWords[$i].'\b/ie',"str_repeat('*',strlen('$0'))",$body);
 }
 return $body;
 }
?>

<div class="masonry-grid">

	<!-- Write post card -->
	<div class="grid-item card grey lighten-5">
		<form style="margin-bottom: 0px;" method="POST">
			<div class="card-content">            
				<textarea id="post-textarea" name="post-textarea" placeholder="Write on <?php if ($currentuser['username']==$sesuser['username']) { echo 'your'; } else { $string = $currentuser['first_name']; echo $string.'\''.($string[strlen($string) - 1] != 's' ? 's' : ''); }?> profile..." style="padding: 8px;"></textarea>
			</div>
			<div class="card-action">
				<button type="submit" class="teal-text btn-flat" name="send" style="height: 24px; line-height: 0px; padding: 0px;">Post</button>
				<div class="right">
					<style>.material-icons { margin: 0px 7px; color: #666; }</style>
					<i class="material-icons">insert_photo</i>
					<i class="material-icons">link</i>
					<i class="material-icons">movie</i>
					<i class="material-icons">event</i>
				</div>
			</div>
		</form>
	</div>
	<?php
		//Allow use of user defined functions
		include('functions.php');

		$username = $currentuser['username'];
		$getposts = mysql_query("SELECT * FROM posts WHERE user_posted_to= '$username' ORDER BY id DESC") or die (mysql_error());
			
		while ($row = mysql_fetch_assoc($getposts)) {
			$username = $row['added_by'];
			getInfo($username);
			//echo $user_info['email'];

			echo filterwords( '
			<div class="grid-item card">
				<div class="card-content">
					<div><!-- Name and avatar of post -->
						<div class="right">
							<i class="material-icons grey-text hover-icon">flag</i>
						</div>
						<a href="profile.php?u='.$user_info['username'].'">
						<img src="'.$user_info['avatar'].'" class="circle" style="width: 50px;">
						<div style="display: inline-block; position: relative; bottom: 4px; left: 11px; overflow: visible;">
							<span class="title black-text">'.$user_info['first_name'].' '.$user_info['last_name'].'</span>
						</a>
							<p style="position: relative; bottom: 5px;">'.$row['date_added'].'</p>
						</div>
					</div>
					<div style="padding-top: 5px;">
						<p style="line-height: 24px;">'.htmlspecialchars($row['body']).'</p>
					</div>
				</div>
				<div class="card-action">
					<a href="#" class="teal-text">Reply</a>
				</div>
			</div>
			');
		}
	?>


</div>
