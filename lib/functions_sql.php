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
	 * Check whether the passed in key-value pair exists. 
	 * If exist, return the result. Else return NULL.
	 * ATTENTION: the return result might be an array, since the sql searching is not exact searching.
	 */
	function blog_check_exist($db, $para, $expect_val)
	{
		if(is_string($para))
		{
			$sql = NULL;

			// Select everything from the articles
			if($para === '')
				$sql = 'SELECT * FROM articles';
			else
			{
				// Use inclusive searching
				$sql = sprintf("SELECT * FROM articles WHERE %s LIKE '%%%s%%'", 
								mysqli_real_escape_string($db, $para),
								mysqli_real_escape_string($db, $expect_val));
			}

			$result = mysqli_query($db, $sql);
			$row = mysqli_fetch_assoc($result);

			if(!$result || sizeof($row) === 0)
				return NULL;

			return $result;
		}
		else
			throw new Exception("String parameter required.");
	}

	/*
	 * Create a new article. If the title is repeated, the article won't be added.
	 * ATTENTION: For Article, if you want to have separate paragraphs, add '\\n'
	 * at the place where you want a second paragraph.
	 * For intro,  it in just one paragraph.
	 * For tags, either array or array in string form will be ok.
	 */
	function insert_article($db, $title, $category, $tags, $intro, $article)
	{
		if(!blog_check_exist($db, 'title', $title))
		{
			$string_array = '';

			// Check whether tags is an array and its length.
			if(is_array($tags))
			{
				if(sizeof($tags) > 4)
					throw new Exception('Tag Discription of this article is too long.');
				
				$string_array = implode(',', $tags);
			}
			else if(is_string($tags))
				$string_array = $tags;
			else
				throw new Exception('Tag needs to be either an array or an array in string form.');

			// printf's parameters' %s must be surrounded with ''
			$sql = sprintf("INSERT INTO blog.articles (title, category, tags, intro, article, time, clicks) 
							VALUES ('%s', '%s', '%s', '%s', '%s', now(), %d)",
							mysqli_real_escape_string($db, $title),
							mysqli_real_escape_string($db, $category),
							mysqli_real_escape_string($db, $string_array),
							mysqli_real_escape_string($db, $intro),
							mysqli_real_escape_string($db, $article),
							0);
			$result = mysqli_query($db, $sql);
			return $result;
		}
		else
			throw new Exception('The title alreasy exists.');
	}

	/*
	 * Add user's comments to db
	 */
	function insert_advice($db, $name, $email, $category, $comment)
	{
		$sql = sprintf("INSERT INTO blog.advice (name, email, category, comment) VALUES ('%s', '%s', '%s', '%s')",
						mysqli_real_escape_string($db, $name),
						mysqli_real_escape_string($db, $email),
						mysqli_real_escape_string($db, $category),
						mysqli_real_escape_string($db, $comment));
		$result = mysqli_query($db, $sql);
		return $result;
	}
?>