<?php
	require_once("functions.php");

	session_start();
	$_SESSION['index'] = 0;
	$_SESSION['about'] = 0;
	$_SESSION['contact'] = 1;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Raymond Shi's Blog</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
</head>
<body>
	<script type="text/javascript" src="js/jquery-2.1.4.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	
<?php
	$name='';
	$email='';
	$category='';
	$comment='';
	$ok=true;

	if(isset($_POST['submit']))
	{
		if(!isset($_POST['name']) || $_POST['name'] === '')
			$ok = false;
		else
			$name = $_POST['name'];

		if(!isset($_POST['email']) || $_POST['email'] === '')
			$ok = false;
		else
			$email = $_POST['email'];

		if(!isset($_POST['category']) || $_POST['category'] === '')
			$ok = false;
		else
			$category = $_POST['category'];

		if(!isset($_POST['comment']) || $_POST['comment'] === '')
			$ok = false;
		else
			$comment = $_POST['comment'];
	}

	if($ok)
	{
		//$db = mysql_con('blog_contact');
	}
?>

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

		<h1>Contact Me</h1>
		<p>Tell me anything that intrigues you! We can talk about fascinating ideas, stories, places, etc. together! </p>

		<div class="col-lg-8 col-md-8 well <?php
			// When the form is submitted and everything is ok or the form is unsubmitted
			if((isset($_POST['submit']) && $ok) || !isset($_POST['submit']))
				echo hidden;
		?>">
			<p>Oooooops...You don't wanna message me T^T?</p>
		</div>

		<br/>
		<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
			<form action="" method="post">
				<div class="form-group">
					<label for="name">Name</label>
					<input type="text" name="name" class="form-control" 
						   placeholder="e.g. Raymond Shi"/>
				</div>
				<div class="form-group">
					<label for="email">Eamil</label>
					<input type="email" name="email" class="form-control" 
						   placeholder="e.g. example@example.com"/>
				</div>
				<div class="form-group">
					<label for="category">Category</label>
					<select class="form-control" name="category">
						<option value="idea" selected>Idea</option>
						<option value="food">Food</option>
						<option vlaue="place">Place & Landscape</option>
						<option value="sport">Sports</option>
						<option value="other">Other</option>
					</select>
				</div>
				<div class="form-group">
					<label for="comment">Comments</label>
					<textarea name="comment" rows="5" class="form-control" placeholder="e.g. I love u~"></textarea>
				</div>
				<input class="btn btn-primary" type="submit" name="submit" value="Sumbit" />
			</form>
		</div>
	</div>
</body>
</html>