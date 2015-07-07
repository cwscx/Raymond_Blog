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

	/*
	 * Check whether the passed in username/email is the administrator
	 */
	function check_admin($db, $para)
	{
		if(is_string($para))
		{
			$ok = false;

			// Check both username and email
			$sqluser = sprintf("SELECT * FROM users WHERE username LIKE '%s'", mysqli_real_escape_string($db, $para));
			$sqlemail = sprintf("SELECT * FROM users WHERE email LIKE '%s'", mysqli_real_escape_string($db, $para));

			/* Once found any paired key-value pair, return true directly */
			// Check username first
			$result = mysqli_query($db, $sqluser);
			$row = mysqli_fetch_assoc($result);

			if($row && sizeof($row) !== 0)
			{
				if($row['isAdmin'] == 1)
					return true;
			}

			// Check email then
			$result = mysqli_query($db, $sqlemail);
			$row = mysqli_fetch_assoc($result);
			if($row && sizeof($row) !== 0)
			{
				if($row['isAdmin'] == 1)
					return true;
			}

			return $ok;
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
			$sql = NULL;
			if($para === 'isAdmin')
			{
				$sql = sprintf("SELECT * FROM users WHERE %s LIKE %d", 
								mysqli_real_escape_string($db, $para),
								mysqli_real_escape_string($db, $expect_val));
			}
			else
			{
				$sql = sprintf("SELECT * FROM users WHERE %s LIKE '%s'", 
								mysqli_real_escape_string($db, $para),
								mysqli_real_escape_string($db, $expect_val));

			}
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
	 * Create a new User
	 */
	function insert_user($username, $email, $password, $isAdmin)
	{

	}
?>