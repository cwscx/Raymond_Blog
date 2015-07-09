<?php
	require_once(dirname(__FILE__) . "/lib/functions_template.php");
	require_once(dirname(__FILE__) . "/lib/functions_blog_format.php");
	require_once(dirname(__FILE__) . "/lib/functions_sql.php");
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
			$result = NULL;

			// When a tag/category/keyword is searched
			if(sizeof($_GET) > 0)
			{
				if($_GET['search'] === 'everything')
					$result = blog_check_exist($db, 'everything', $_GET['val']);
				else if($_GET['search'] === 'category')
					$result = blog_check_exist($db, 'category', $_GET['val']);
				else if($_GET['search'] === 'tags')
					$result = blog_check_exist($db, 'tags', $_GET['val']);
			}
			else
				$result = blog_check_exist($db, '', '');	// Get all blogs

			if($result)
			{
				foreach($result as $row)
				{
					// Title, info and introduction for the article
					title($row['title'], $row['clicks']);
					info($row['category'], $row['tags'], $row['time']);
					intro($row['intro']);
				}
			}
			else
			{
				header('Location: ./404.php');
			}

			mysqli_close($db);
		?>
		</div>
	</div>
</body>
</html>