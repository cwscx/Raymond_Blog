<?php
	require_once(dirname(__FILE__) . "/lib/function_sql_connection_pw_provided.php");
	require_once(dirname(__FILE__) . "/lib/functions_template.php");
	require_once(dirname(__FILE__) . "/lib/functions_blog_format.php");
	require_once(dirname(__FILE__) . "/lib/functions_sql.php");

	// Get the paragraph's name
	// $_GET has already been urldecoded by default
	$para_name = $_GET['title'];
	$db = sql_connection('blog');

	// Title is unique, and the result is proved to be not null.
	$result = get_blog_by_title($db, $para_name);

	// If nothing is found from db, redirect to 404 page...
	if(!$result)
		//header('Location: ./404.php');
	
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
			category_template();
		?>

		<div class='caption col-lg-8 col-md-8 article'>
			<?php
				// This for loop will be executed only once...
				// Since the title is unique.
				while($row = $result -> fetch_assoc())
				{
					title($row['title'], $row['clicks']);
					info($row['category'], $row['tags'], $row['time']);
					paragraphs($row['article']);

					update_clicks($db, $row['title']);
				}

				mysqli_close($db);
			?>
		</div>
		

		<!-- sidebar -->
		<?php
			sidebar_template();
		?>
	</div>
	<div class='col-lg-12 col-lg-12 col-sm-12 col-xs-12' style="visibility:hidden">blank</div>
</body>
</html>
