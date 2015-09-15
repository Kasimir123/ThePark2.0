	<!-- php for post system -->
	<?php
		$user = $sesuser['username'];

		$post = @$_POST['post-textarea'];
		if ($post != "") {
		$added_by = $user;
		$user_posted_to = $username;

		$sqlCommand = "INSERT INTO posts (body, added_by, user_posted_to) VALUES('$post','$added_by','$user_posted_to')";  
		$query = mysql_query($sqlCommand) or die (mysql_error()); 

		}
	?>

	<style>
		.loadcomments {
			transition: .3s ease-in-out all;
		}

		.comment:nth-last-of-type(n+3) {
			display: none;
		}
	</style>

	<div class="masonry-container">
	<div class="grid">
		<div class="grid-sizer"></div>

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
			$username = $currentuser['username'];
			$getposts = mysql_query("SELECT * FROM posts WHERE user_posted_to= '$username' ORDER BY id DESC") or die (mysql_error());

			while ($row = mysql_fetch_assoc($getposts)) {
				$username = $row['added_by'];
				getInfo($username);
				$postid = $row['id'];
				$commentsql = mysql_query("SELECT * FROM comments WHERE post_id = '$postid' ORDER BY timestamp");

				//echo $user_info['email'];

				echo filterwords( '
				<div class="grid-item card post" id="post'.$row['id'].'">
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
								<p style="position: relative; bottom: 5px;">'.date('M j',strtotime($row['date_added'])).'</p>
							</div>
						</div>
						<div style="padding-top: 5px;">
							<p style="line-height: 24px;">'.htmlspecialchars($row['body']).'</p>
						</div>
					</div>
					<div class="card-action grey lighten-5" style="padding: 15px 20px;">
						'); 
						if (mysql_num_rows($commentsql) > 2) {
							echo '<i class="material-icons loadcomments" style="position: absolute; right: 10px; margin-top: 3px; cursor: pointer;">keyboard_arrow_down</i>';
						}; echo filterwords('

						<div id="commentscontainer" style="max-height: 200px; overflow: scroll;">

							'); 

								while($commentinfo = mysql_fetch_assoc($commentsql)) {
							        getInfo($commentinfo['username']);
							        echo filterwords('
							            <div class="comment" style="margin: 8px 0px;">
							                <a href="profile.php?u='.$user_info['username'].'" title="'.$user_info['username'].'"style="color: #000; text-transform: none; margin: 0px 3px 0px 0px;"><img src="'.$user_info['avatar'].'" style="width: 30px; height: 30px; border-radius: 50%;"/>
							                <p style="position: relative; bottom: 10px; left: 7px; display: inline;"><b>'.$user_info['first_name'].' '.$user_info['last_name'].' </b></a><span id="cmtstring">'.$commentinfo['comment'].'</span></p>
							            </div>
							        ');
							    }

							 echo filterwords('
							
						</div>

						<form class="comment" onsubmit="submitComment(\''.$row['id'].'\'); return false;" style="margin: 0;">
							<input type="text" id="commentinput" style="display: block; border: solid 1px #E0E0E0; border-radius: 2px; width: 100%; padding: 6px; height: 20px; margin-top: 2px; font-size: 10pt;" placeholder="Add a comment..."></input>
						</form>

					</div>
				</div>
				');
			}
		?>
	</div>

	<script>

		var bool = false,
			postid = '';

		$('.post').each(function(count) { //Truncate comments when document loads
			var comment1 = $(this).find('.comment:last-child #cmtstring'); //Find first comment
			var comment2 = $(this).find('.comment:nth-last-child(2) #cmtstring'); //Find second comment

			comment1.text(truncate(comment1.text(), 42)); //Truncate first comment
			comment2.text(truncate(comment2.text(), 42)); //Truncate second comment
		});

		$('.loadcomments').click(function() {
			if (bool == false) {
				postid = $(this).parent().parent().attr('id').substring(4); // Get id of post
				
				$('#commentscontainer').load('../php/loadcomments.php',{id: postid});

				$(this).parent().find('.comment').css({'display':'block'});
				$(this).css({'transform':'rotate(180deg)'});
				//Scroll to bottom of comments list
				var container = $(this).parent().find('#commentscontainer');
				container.scrollTop(container.height());
			} else {
				$('#commentscontainer').load('../php/loadcomments.php',{id: postid});
				$(this).parent().find('.comment:nth-last-of-type(n+3)').css({'display':'none'});
				$(this).css({'transform':'rotate(0deg)'});
			}
			bool = !bool;
		})

		function truncate(string, length) {
			if (typeof length !== 'undefined') { length = 40; }

			var shortened = string,
				len = string.length;

			if (len > length) {
				shortened = jQuery.trim(string).substring(0, length).split(" ").slice(0, -1).join(" ") + "...";
			}

			return shortened;
		}

		function submitComment(number) {
			var input = $('#post'+number).find('#commentinput'),
				comment = input.val(),
				postnumber = number; //Can't pass parameter directly into post request

	        $.post('../php/postcomment.php', {post: postnumber, comment: comment},function(messages) {
	            input.val('');
	            $()
	        });

	        return false;
	    };

	</script>
		
