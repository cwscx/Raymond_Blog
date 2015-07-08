<?php
	require(dirname(__FILE__) . "/lib/functions.php");

	session_start();
	$_SESSION['current-page'] = NULL;

	// Get the paragraph's name
	$para_name = $_GET['title'];
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

		<div class='caption col-lg-8 col-md-8'>
			<?php
				$db = sql_connection('blog');
				$result = check_exist($db, 'title', $para_name);
				$row = mysqli_fetch_assoc($result);

				if($result && sizeof($row) > 0)
				{
					foreach($result as $row)
					{
						title($row['title']);
						info($row['category'], $row['tags'], $row['time']);
						paragraphs($row['article']);
					}
				}
				else
				{
					
				}
			?>
		</div>
	</div>
</body>
</html>