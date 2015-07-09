<?php
	require_once("../lib/functions_template.php");
	require_once("../lib/functions_sql.php");

	// Store the current page
	session_start();
	$_SESSION['current-page'] = NULL;
?>

<!DOCTYPE html>
<html>
<head>
	<title>Administrator</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css" />
</head>
<body>
	<!-- Bootstrap's js requires jquery. So jquery needs to included first -->
	<script type="text/javascript" src="../js/jquery-2.1.4.js"></script>
	<script type="text/javascript" src="../js/bootstrap.js"></script>

	<div class="container">
		<?php
			admin_template();
		?>
	</div>
</body>
</html>