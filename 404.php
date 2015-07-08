<?php
	require(dirname(__FILE__) . "/lib/functions.php");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Raymond Shi's Homepage</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
</head>
<body>
	<!-- Bootstrap's js requires jquery. So jquery needs to included first -->
	<script type="text/javascript" src="js/jquery-2.1.4.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	
	<div class="container">
		<?php
			navbar_template();
			header_template();
		?>

		<br/>
		<br/>
		<div class="well col-lg-8 col-md-8">
			<h3>OOOOOOOOOOOps......T^T......</h3>
			<h3>I didn't write the paragraph you want to read.</h3>
			<h3><a href="contact.php">Contact</a> me for your idea. I'm happy to listen from you!</h3> 
		</div>
	</div>
</body>
</html>