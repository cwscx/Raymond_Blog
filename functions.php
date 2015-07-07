<?php
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

	/*
	 * Check whether the passed in key-value pair exists
	 */
	function check_exist($db, $para, $expect_val)
	{
		if(is_string($para))
		{
			$ok = true;
			$sql = sprintf("SELECT * FROM articles WHERE %s LIKE '%s'", 
							mysqli_real_escape_string($db, $para),
							mysqli_real_escape_string($db, $expect_val));

			$result = mysqli_query($db, $sql);
			$row = mysqli_fetch_assoc($result);  // Transfer select outcome to an array

			if(!$row || sizeof($row) === 0)
				$ok = false;

			return $ok;
		}
		else
			throw new Exception("String parameter required.");
	}

	/*
	 * Create a new User. If the username or the email is repeated, the user will not be added.
	 */
	function insert_article($db, $title, $subtitle, $article)
	{
		if(!check_exist($db, 'title', $title))
		{
			// printf's parameters' %s must be surrounded with ''
			$sql = sprintf("INSERT INTO blog.articles (title, subtitle, article) VALUES ('%s', '%s', '%s')",
							mysqli_real_escape_string($db, $title),
							mysqli_real_escape_string($db, $subtitle),
							mysqli_real_escape_string($db, $article));
			$result = mysqli_query($db, $sql);
		}
	}

?>