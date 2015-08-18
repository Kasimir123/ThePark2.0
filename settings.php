<?php include('include/dbcon.php');?>

<html>
<head>

<?php include('include/import.php');?>

</head>
<body>

<?php include('include/header.php');?>

<div class="container" style="margin-top: -17px;">
	<div class="white">
		<h4 style="padding: 35px 0px 20px 45px;">Settings</h4>
		<div class="row">
			<div class="col s12">
				<ul class="tabs">
					<li class="tab col s3"><a href="#account">Account</a></li>
					<li class="tab col s3"><a class="active" href="#profile">Profile</a></li>
					<li class="tab col s3"><a href="#security">Security</a></li>
					<li class="tab col s3"><a href="#notifications">Notifications</a></li>
					<li class="tab col s3"><a href="#other">Other</a></li>
				</ul>
			</div>
		</div>
	</div>

	<div id="account" class="col s12" style="margin: 0px 100px">
		<div class="card">
			<div class="card-content">
				<form method="post" action="">
					<div class="row">
						<div class="col s12">
							<span>Username: </span><input type="text" name="firstname" placeholder="<?php echo $sesuser['username'];?>"/>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<!-- Change avatar variables -->
	<?php 
		$user = $sesuser['username'];
		$updateavatar = @$_POST['updateavatar'];
		
	if ($updateavatar) {
	$avatar = $_POST['avatar'];
	$info_submit_query = mysql_query("UPDATE users SET avatar='$avatar' WHERE username='$user'");	
	header("Location: profile.php");
	}
	
	?>
	
	
	<div id="profile" class="col s12" style="margin: 0px 100px">
		<!-- Change avatar card -->
		<form method="post">
		<div class="card">
			<div class="card-content">
				<img src="<?php echo $sesuser['avatar'];?>" alt="" class="circle" style="width: 60px;">
				<h5 style="display: inline; position: relative; bottom: 20px; left: 15px;">Change avatar</h5>
				<input type="text" name="avatar" placeholder="Image URL" style="margin-top: 8px; margin-bottom: 0px;" />
			</div>
			<div class="card-action">
            	<input type="submit" name="updateavatar" value="Update">
            </div>
            </form>
		</div>
		
		<!-- Bio variables -->
<?php
	$updateinfo = @$_POST['updatebio'];

if ($updateinfo) {
	$bio = $_POST['bio'];
	$info_submit_query = mysql_query("UPDATE users SET bio='$bio' WHERE username='$user'");
	header("Location: profile.php");
	
}
	

else
{

}
?>

		<!-- Change bio card -->
	<form method="post">
		<div class="card">
			<div class="card-content">
				<h5 style="display: inline;">Change bio</h5>
				<input type="text" name="bio" id="bio" placeholder="<?php echo $sesuser['bio']?>" style="margin-top: 8px; margin-bottom: 0px;"/>
			</div>
			<div class="card-action">
            	<input type="submit" name="updatebio" value="Update">
            </div>
		</div>
	</div>
	</form>
	<div id="security" class="col s12">Test 3</div>
	<div id="notifications" class="col s12">Test 4</div>
	<div id="other" class="col s12">Test 5</div>
</div>

</body>
</html>
