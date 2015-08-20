<!doctype>
<html>
<head>
	<title>Global Chat</title>
	<?php
	include('include/dbcon.php');
	?>
	<script src="jquery.js"></script>
	<script> 
		$(document).ready(function() {
		$("#messages").load('ajaxload.php');
		$(function(){
		$("#postchat").submit(function() {
			$.post('ajaxpost.php', $('#postchat').serialize(),function(chat) {
				$("#messages").append('<div>'+chat+'</div>');
				
			});
			return false;
		});
		});
				setInterval(oneSecondFunction, 1000);
				function oneSecondFunction() {
				$("#messages").load('ajaxload.php');
			
		}
	}); 
	</script>
	<?php include('include/import.php'); ?>
</head>

<body style="height: 100%;">
	<?php include('include/header.php'); ?>
	<div class="container z-depth-1" style="background: #f9f9f9;">

<!-- display -->
<div id="messages">
</div>

<hr />

<!-- Post -->
<form id="postchat">
	<label>Message</label>
	<input type="text" maxlength="255" name="messages" />
	<label></label>
	<input type="submit" value="Post Message" />
</form>
</div>


</body>

</html>
