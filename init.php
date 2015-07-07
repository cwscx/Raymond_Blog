<?php
	require_once("./functions.php");
	$db = sql_connection("blog");

	// Create the user Table to store usrs
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

	/* Check the administrator exists. If there's none create a new one (me). */
	$hasAdmin = check_exist($db, 'isAdmin', 1);

	if(!$hasAdmin)
	{
		insert_user($db, 'Raymond Shi', 'shengyang.shi@hotmail.com', 'ray@1224cwscx', 1);
	}
	
	mysqli_close($db);
?>