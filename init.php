<?php
	require_once("./functions.php");
	$db = sql_connection("blog");

	// Create the user Table to store usrs
	$sql = "CREATE TABLE articles
	(
		id int(8) NOT NULL AUTO_INCREMENT,
		PRIMARY KEY(id),
		title varchar(25) NOT NULL,
		subtitle varchar(50),
		article text(65535) NOT NULL
	)";	// Use tinyint(1) to express boolean
	$result = mysqli_query($db, $sql);
	
	insert_article($db, 'First essay', 'For test', 'Hello Blog!');
	mysqli_close($db);
?>