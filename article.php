<?php
	require(dirname(__FILE__) . "/lib/functions.php");

	session_start();
	$_SESSION['current-page'] = NULL;
?>

<!DOCTYPE html>
<html>
<head>
	<title>Raymond Shi's Blog</title>
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

		
	</div>
</body>
</html>