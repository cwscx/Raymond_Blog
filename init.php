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
		article text(65535) NOT NULL,
		time date NOT NULL,
		clicks int(4) NOT NULL
	)";	// Use tinyint(1) to express boolean
	$result = mysqli_query($db, $sql);
	

	$tags = array();
	$tags = ['test', 'blog'];

	try{
		insert_article($db, 'First essay', 'test', $tags, 'Hello Blog!');
	}catch(Exception $e){
		// Do nothing here
		// echo $e -> getMessage();
	}

	mysqli_close($db);
?>