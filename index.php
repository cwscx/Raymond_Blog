<?php
	require("./functions.php");
	require_once("./init.php");

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
		?>

		<h2 >Literally, this is Raymond Shi's Personal Blog</h2>
		<p style="font-size:15px">Focus on Data Mining, Machine Learning, Web/Mobile application. --- Let's go Geek.</p>
		
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

					// Try to concat blogs together
					// Head, subline, category 
					$blogs = "<div class='caption col-lg-8 col-md-8'>
								<h3 style='font-family: sans-serif'>
									<a style='color:black' href='index.php?val=%s'>%s</a>
								</h3>
							<hr/>
							<p style='color:#aaa'>
								Category:&nbsp; 
								<a href='category.php?val=%s'>%s</a>&nbsp;&nbsp;";

					// Tags
					$blogs = $blogs . "|&nbsp;&nbsp;Tags:&nbsp;&nbsp;";
					foreach($tags as $value)
					{
						$blogs = $blogs . sprintf("<a href='tag.php?val=%s'>%s</a>&nbsp;&nbsp;",
													htmlspecialchars($value),
													htmlspecialchars($value));
					}

					// Date
					$blogs = $blogs . "|&nbsp;&nbsp;Date:&nbsp;&nbsp;";
					$blogs = $blogs . sprintf("%s", htmlspecialchars($row['time'])) . '</p>';

					// Article
					$blogs = $blogs . sprintf("%s", htmlspecialchars($row['intro']));

					// End
					$blogs = $blogs . "</div>";

					// Print it out
					printf($blogs,
						htmlspecialchars($row['title']),
						htmlspecialchars($row['title']),
						htmlspecialchars($row['category']),
						htmlspecialchars($row['category']));
				}
			}
		?>
	</div>
</body>
</html>