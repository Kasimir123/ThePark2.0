<nav class="white" role="navigation" style="position: relative; z-index: 10;">
	<div class="nav-wrapper container">
		<?php
			$u = "";
			if (isset($_SESSION['user_login'])) {
				if ($u) {
					$uq = $_POST['u'];
				}
				echo '<div class="search_box left" style="width: 75%;">
						  <form action="profile.php?u=$uq" method= "GET" id= "search">
							  <input class="black-text" type="text" name="u" id="u" size="60" width="100px" placeholder="Search ..." />
						  </form>
					  </div>';
			}
		?>

		<ul class="right hide-on-med-and-down">
			<?php
			//Add links at top for loggin in and out, depending on if the user has already logged in
			if (isset($_SESSION['user_login'])) {
				echo '<a class="dropdown-button black-text" href="#" data-activates="headerdrop"><img src="'.$sesuser['avatar'].'" id="mediumavatar"/></a>';
			} else {
				echo '<li><a class="modal-trigger" href="#loginmodal">Log In</a></li>';
				echo '<li><a class="modal-trigger" href="#signupmodal">Sign Up</a></li>';
			}
			?>
		</ul>

		<!-- Dropdown menu -->
		<ul id='headerdrop' class='dropdown-content'>
			<li><a href="profile.php">Profile</a></li>
			<li><a href="settings.php">Settings</a></li>
			<!--<li class="divider"></li>-->
			<li><a class="modal-trigger" href="php/logout.php">Log Out</a></li>
		</ul>

		<!-- Add links to hamburger menu for mobile devices -->
		<ul id="nav-mobile" class="side-nav">
			<?php
			//Add links to hamburger menu for loggin in and out, depending on if the user has already logged in
			if (isset($_SESSION['id'])) {
				echo '<li><a href="profile.php">Profile</a></li>';
				echo '<li><a href="settings.php">Settings</a></li>';
				echo '<li><a class="modal-trigger" href="php/logout.php">Log Out</a></li>';
			} else {
				echo '<li><a class="modal-trigger" href="#loginmodal">Log In</a></li>';
				echo '<li><a class="modal-trigger" href="#signupmodal">Sign Up</a></li>';
			}
			?>
		</ul>
		<a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
	</div>
</nav>

<!-- Log in modal -->
<div id="loginmodal" class="modal align-center">
	<div class="modal-content center-align">
		<h4>Log In</h4>
		<?php include('include/login.html');?>
	</div>
</div>

<!-- Sign up modal -->
<div id="signupmodal" class="modal">
	<div class="modal-content center-align">
		<h4>Sign Up</h4>
		<?php include('include/signup.html');?>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
	$('.modal-trigger').leanModal();
});
</script>
