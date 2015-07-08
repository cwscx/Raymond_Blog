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
		<!-- navbar -->
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
		<!-- navbar ended -->

		<h2 >Literally, this is Raymond Shi's Personal Blog</h2>
		<p><!-- Fill this later --></p>
		
		<!-- blogs -->
		<?php
			$db = sql_connection('blog');       // database
			$result = check_exist($db, '', '');	// Get all blogs

			if($result && sizeof($result) > 0)
			{
				foreach($result as $row)
				{
					// Transfer the tags from string to array
					$tags = explode(',', $row['tags']);

					$blogs = "<div class='caption col-lg-8 col-md-8'>
								<h3 style='font-family: sans-serif'>%s</h3>
							<hr/>
							<p style='color:#aaa'>
								Category:&nbsp;
								<a>%s</a>&nbsp;
								|&nbsp;Tags:&nbsp;";
					foreach($tags as $value)
					{
						$blogs = $blogs . sprintf("<a href='tag.php?val=%s'>%s</a>&nbsp;",
													htmlspecialchars($value),
													htmlspecialchars($value));
					}
					$blogs = $blogs . "|&nbsp;Date:&nbsp;";

					$blogs = $blogs .
					"		</p>
						</div>";
						printf($blogs,
						htmlspecialchars($row['title']),
						htmlspecialchars($row['category']));
				}
			}
		?>
	</div>
</body>
</html>