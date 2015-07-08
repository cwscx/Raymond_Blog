<?php
	require(dirname(__FILE__) . "/lib/functions.php");
	require_once(dirname(__FILE__) . "/lib/init.php");

	// Store the current page
	session_start();
	$_SESSION['current-page'] = 'index';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Raymond Shi's homepage</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
</head>
<body>
<?php
	// When an article's title is clicked, we'll send a get to the index.php.
	// We'll handle this condition here.
	if(sizeof($_GET) > 0)
	{
		echo "xxx";
	}
?>
	<!-- Bootstrap's js requires jquery. So jquery needs to included first -->
	<script type="text/javascript" src="js/jquery-2.1.4.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	

	<div class="container">
		<?php
			navbar_template();
			header_template();
		?>
		
		<div class='caption col-lg-8 col-md-8'>
		<!-- blogs -->
		<?php
			$db = sql_connection('blog');       // database
			$result = check_exist($db, '', '');	// Get all blogs

			if($result && sizeof($result) > 0)
			{
				foreach($result as $row)
				{
					// Title, info and introduction for the article
					title($row['title']);
					info($row['category'], $row['tags'], $row['time']);
					intro($row['intro']);
				}
			}
		?>
		</div>
	</div>
</body>
</html>