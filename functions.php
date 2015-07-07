<?php
	/*
	 * Navbar template
	 */
	function navbar_template()
	{
		readfile("./template/navbar.tmpl.html");
	}

	/*
	 * Build up sql connection of given database. 
	 * If the given name is not created, create one new database.
	 * Return the db connection.
	 */
	function sql_connection($db_name)
	{
		/* Check if the passed in db name is a string */
		if(is_string($db_name))
		{
			$db = mysqli_connect('localhost', 'root', 'Ray@1224');
			if($db_name === '')		// Default db name is blog
				$db_name = "blog";

			$sql = sprintf("CREATE DATABASE %s", mysqli_real_escape_string($db, $db_name));
			$result = mysqli_query($db, $sql);	// Create the db in case the db is not created.

			// Build the connection
			$db = mysqli_connect('localhost', 'root', 'Ray@1224', $db_name);

			return $db;
		}
		else
			throw new Exception("String parameter required.");
	}

	function check_admin($username, $db)
	{
		if(is_string($username))
		{
			$sql = sprintf("SELECT * FROM users WHERE username='%s'", mysqli_real_escape_string($db, $username));
			$result = mysqli_query($db, $sql);
			$row = mysqli_fetch_assoc($result);

			if(!$row || sizeof($row) === 0)
				return 0;
			else
				return 1;
		}
		else
			throw new Exception("String parameter required.");
	}
?>