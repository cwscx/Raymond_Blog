<?php
	require_once("./functions.php");
	$db = sql_connection("blog");

	// Create Table to store usrs
	$sql = "CREATE TABLE users
	(
		id int(4) NOT NULL AUTO_INCREMENT,
		PRIMARY KEY(id),
		username varchar(25) NOT NULL,
		email varchar(25) NOT NULL,
		password varchar(50) NOT NULL,
		isAdmin tinyint(1) NOT NULL
	)";	// Use tinyint(1) to express boolean
	$result = mysqli_query($db, $sql);

	
	$sql = "SELECT * FROM users WHERE isAdmin=1";
	$result = mysqli_query($db, $sql);
	$row = mysqli_fetch_assoc($result);  // Transfer select outcome to an array

	if(!$row || sizeof($row) === 0)
	{
		$hash = password_hash("ray@1224cwscx", PASSWORD_DEFAULT);

		// printf's parameters' %s must be surrounded with ''
		$sql = sprintf("INSERT INTO blog.users (username, email, password, isAdmin) VALUES ('%s', '%s', '%s', %d)",
						mysqli_real_escape_string($db, 'Raymond Shi'),
						mysqli_real_escape_string($db, 'shengyang.shi@hotmail.com'),
						mysqli_real_escape_string($db, $hash),
						mysqli_real_escape_string($db, 1));
		$result = mysqli_query($db, $sql);
	}
	
	mysqli_close($db);
?>