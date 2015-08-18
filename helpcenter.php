<?php

include('include/dbcon.php');

//Redirect user to main page if not signed in
if (!isset($_SESSION['user_login'])) {
		header('Location: index.php');
}

?>

<html>
<head>

<?php include('include/import.php'); ?>

<style>

.masonry-grid:after { content: ''; display: block;  clear: both; } /* clearfix */
.masonry-grid { margin: 0 auto; }
.grid-item { width: 49%; float: left; margin-bottom: 8px; }

</style>

</head>

<body style=" height: 100%;">

	<?php include('include/header.php'); ?>

	<?php
		error_reporting(0);

		if ($_GET['c']) {
			$category = $_GET['c'];
		} else {
			$category = 'all';
		}

		$category = ucfirst($category); //Capitalize string

		error_reporting(E_ALL);
	?>

	<!-- Dropdown Trigger -->
	<a class='dropdown-button btn' href='#' data-activates='dropdown1'><?php echo $category;?></a>

	<!-- Dropdown Structure -->
	<ul id='dropdown1' class='dropdown-content'>
		<li><a href="helpcenter.php?c=all">All</a></li>
		<li><a href="helpcenter.php?c=math">Math</a></li>
		<li><a href="helpcenter.php?c=science">Science</a></li>
		<li><a href="helpcenter.php?c=english">English</a></li>
		<li><a href="helpcenter.php?c=history">History</a></li>
		<li><a href="helpcenter.php?c=foreign%20language">Foreign Language</a></li>
		<li><a href="helpcenter.php?c=health">Health</a></li>
		<li><a href="helpcenter.php?c=performing%20arts">Performing Arts</a></li>
		<li><a href="helpcenter.php?c=visual%20arts">Visual Arts</a></li>
		<li><a href="helpcenter.php?c=technology">Technology</a></li>
	</ul>

</body>

<script type="text/javascript">

$('.dropdown-button').dropdown({
      inDuration: 300,
      outDuration: 225,
      constrain_width: false, // Does not change width of dropdown to that of the activator
      hover: true, // Activate on hover
      belowOrigin: false // Displays dropdown below the button
    }
  );

</script>

</html>
