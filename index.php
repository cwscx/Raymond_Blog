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
			category_template();
		?>
		
		<!-- blogs -->
		<div class='caption col-lg-8 col-md-8'>
		<?php
			$db = sql_connection('blog');       // database
			$result = NULL;						// s
			$pages = 1;
			$current_page = 1;

			// if search is not set for $_GET, return all the rows
			if(!isset($_GET['search']))
				$result = blog_check_exist($db, '', '');	// Get all blogs
			// if search for everything, return all the rows that match the key word in any area.
			else if($_GET['search'] === 'everything')
				$result = blog_check_exist($db, 'everything', $_GET['val']);
			else if($_GET['search'] === 'category')
				$result = blog_check_exist($db, 'category', $_GET['val']);
			else if($_GET['search'] === 'tags')
				$result = blog_check_exist($db, 'tags', $_GET['val']);
				
			// If a not null result is reached by the select command
			if($result)
			{
				$num = mysqli_num_rows($result);	// number of all corresponding query result
				// Number of pages
				if($num % 5 > 0)
					$pages = intval($num / 5) + 1;
				else
					$pages = intval($num / 5);

				// if cp(current page) is set, load it as the value of GET method
				// otherwise, load it as the first page.
				if(isset($_GET['cp']))
					$current_page = $_GET['cp'];
				else
					$current_page = 1;

				// Redo query for each page by setting limits
				if(!isset($_GET['search']))
					$result = blog_check_limits($db, '', '', ($current_page - 1) * 5, 5);
				// When searched in the searching bar
				else if($_GET['search'] === 'everything')
					$result = blog_check_limits($db, 'everything', $_GET['val'], ($current_page - 1) * 5, 5);
				else if($_GET['search'] === 'category')
					$result = blog_check_limits($db, 'category', $_GET['val'], ($current_page - 1) * 5, 5);
				else if($_GET['search'] === 'tags')
					$result = blog_check_limits($db, 'tags', $_GET['val'], ($current_page - 1) * 5, 5);

				// If the limited sql select has a result, print them out
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

				// Panigation
				if(isset($_GET['search']) && isset($_GET['val']))
					panigation($pages, $current_page, $_GET['search'], $_GET['val']);
				else
					panigation($pages, $current_page, '', '');
			}
			else
				header('Location: ./404.php');

			mysqli_close($db);
		?>
		</div>


		<!-- sidebar -->
		<?php
			sidebar_template();
		?>
		
	</div>
</body>
</html>
