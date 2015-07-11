<?php
	require_once("../lib/functions_template.php");
	require_once("../lib/functions_sql.php");

	// Store the current page
	session_start();
	$_SESSION['current-page'] = 'post';
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

			// values to store in db
			$title = '';
			$category = '';
			$tags = '';
			$intro = '';
			$article = '';

			$ok = true;

			// if the submit button is clicked, check and store each value
			if(isset($_POST['submit']))
			{
				if(!isset($_POST['title']) || $_POST['title'] === '')
					$ok = false;
				else
					$title = $_POST['title'];

				if(!isset($_POST['category']) || $_POST['category'] === '')
					$ok = false;
				else
					$category = $_POST['category'];

				if(!isset($_POST['tags']) || $_POST['tags'] === '')
					$ok = false;
				else
					$tags = $_POST['tags'];

				if(!isset($_POST['intro']) || $_POST['intro'] === '')
					$ok = false;
				else
					$intro = $_POST['intro'];

				if(!isset($_POST['article']) || $_POST['article'] === '')
					$ok = false;
				else
					$article = $_POST['article'];

				// If everyting is entered. store it
				if($ok)
				{
					$db = sql_connection("blog");
					try
					{
						$result = insert_article($db, $title, $category, $tags, $intro, htmlspecialchars($article));
					}
					catch(Exception $e)
					{
						echo $e -> getMessage();
					}
					
					mysqli_close($db);
				}
			}
		?>

		<h2>This is the Administrator page to post new blogs!</h2>
		<hr />
		<br />

		<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
			<!-- form to store values -->
			<form action="" method="post">
				<div class="form-group">
					<label for="title">Title</label>
					<input type="text" name="title" class="form-control" 
						   placeholder="e.g. The difference between require and require_once in PHP" value="<?php 
						   		echo $title;
						   ?>" >
				</div>
				<div class="form-group">
					<label for="category">Category</label>
					<input type="text" name="category" class="form-control" 
						   placeholder="PHP" value="<?php 
						   		echo $category;
						   ?>" >
				</div>
				<div class="form-group">
					<label for="tags">Tags
						<i style="color:#666">&nbsp;(Attention: If there are multiple tags, tags should be separated by ','. c++ should be written as cpp.)</i>
					</label>
					
					<input type="text" name="tags" class="form-control" 
						   placeholder="Data-mining, python, algorithm" value="<?php 
						   		echo $tags;
						   ?>" >				
				</div>
				<div class="form-group">
					<label for="intro">Introduction</label>
					<textarea name="intro" rows="5" class="form-control" placeholder="e.g. Introduction."><?php
						echo $intro;
					?></textarea>
				</div>
				<div class="form-group">
					<label for="article">Article
						<i style="color:#666">&nbsp;(Attention: In order to have multiple paragraphs, separate each paragraphs by '\n'.)</i>
					</label>
					<textarea name="article" rows="10" class="form-control" placeholder="e.g. Paragraph1 \n Paragraph2 \n Paragraph3"><?php
						echo $article;
					?></textarea>
				</div>
				<input class="btn btn-primary" type="submit" name="submit" value="Sumbit" />
			</form>
		</div>
	</div>
</body>
</html>