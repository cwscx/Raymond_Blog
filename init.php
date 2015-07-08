<?php
	require_once("./functions.php");
	$db = sql_connection("blog");

	// Create the user Table to store usrs
	$sql = "CREATE TABLE articles
	(
		id int(8) NOT NULL AUTO_INCREMENT,
		PRIMARY KEY(id),
		title varchar(50) NOT NULL ,
		category varchar(25) NOT NULL,
		tags varchar(100) NOT NULL,
		intro text(1000) NOT NULL,
		article text(65535) NOT NULL,
		time date NOT NULL,
		clicks int(4) NOT NULL
	)";	// Use tinyint(1) to express boolean
	$result = mysqli_query($db, $sql);
	

	$tags = array();
	$tags = ['test', 'blog'];

	try{
		insert_article($db, 'First essay', 'test', $tags, 
			"Hello Blog! Here's the introduction of my first blog. There won't be too much material in my first 
			blog, cuz this is simply for testing my blog works correctly with php and MySQL. There will be more
			blogs. I promise.", 
			"Hello Blog! Here's the main article of my first blog. There won't be too much material in my first 
			blog, cuz this is simply for testing my blog works correctly with php and MySQL. There will be more
			blogs. I promise. You think there will be more material and paragraphs describing this website? Haha!
			\n Sorry I need to work on the next milestone of this website! See you soon!");
	}catch(Exception $e){
		// Do nothing here
		// echo $e -> getMessage();
	}

	mysqli_close($db);
?>