<?php
	require("./functions.php");
	require_once("./init.php");

	session_start();
	$_SESSION['index'] = 1;
	$_SESSION['about'] = 0;
	$_SESSION['contact'] = 0;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Raymond Shi's homepage</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
</head>
<body>
	<!-- Bootstrap's js requires jquery. So jquery needs to included first -->
	<script type="text/javascript" src="js/jquery-2.1.4.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	
	<div class="container">
		<div id="menu" class="navbar navbar-default navbar-fixed-top">
			<div class="navbar-header">
				<button type="button" class="btn-info navbar-toggle" 
						data-toggle="collapse" data-target=".navbar-collapse">
						<span class="glyphicon glyphicon-th-list"></span>
				</button>
				<div class="navbar-brand">
					<a href="." style="text-decoration:none"><h3 style="color:#EEE">Raymond's Blog</h3></a>
				</div>
			</div>

			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-right">
					<li class="nav <?php 
						if($_SESSION['index'] === 1)
							echo active;
					?>"><a href="index.php">Home</a></li>
					<li class="nav <?php 
						if($_SESSION['about'] === 1)
							echo active;
					?>"><a href="about.php">About</a></li>
					<li class="nav <?php 
						if($_SESSION['contact'] === 1)
							echo active;
					?>"><a href="contact.php">Contact</a></li>
				</ul>
			</div>
		</div>


		<h1>I'm still working on it</h1>
	</div>
</body>
</html>