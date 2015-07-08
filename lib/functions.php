<?php
	/*
	 * Get navbar template for the page.
	 */
	function navbar_template()
	{
		require_once(dirname(__FILE__) . '/template/navbar.tmpl.php');
	}

	/*
	 * Get header template for the page.
	 */
	function header_template()
	{
		require_once(dirname(__FILE__) . '/template/header.tmpl.php');
	}

	/*
	 * Print the title for an article
	 */
	function title($title)
	{
		if(is_string($title))
		{
			printf("
				<h3 style='font-family: sans-serif'>
					<a style='color:black' href='article.php?title=%s'>%s</a>
				</h3>
				<hr/>
				",
				htmlspecialchars($title),
				htmlspecialchars($title));
		}
		else
			throw new Exception('Title is required to be a String.');
	}

	/*
	 * Print the info of the article.
	 * Category, tags and time included
	 */
	function info($category, $tags, $time)
	{	
		// Check the tags as an array
		$tags_array = array();
		if(!is_array($tags))
			$tags_array = explode(',', $tags); 	// Transfer the tags from string to array
		else if(is_string($tags))
			$tags_array = $tags;
		else
			throw new Exception('Tags needs to be an array or an array in string form.');

		// String format checking
		if(!is_string($category))
			throw new Exception('Category needs to be a String.');
		if(!is_string($time))
			throw new Exception('Time needs to be a string.');

		// Category
		printf("<p style='color:#999'>
					Category:&nbsp; 
					<a href='category.php?val=%s'>%s</a>
					&nbsp;&nbsp;|&nbsp;&nbsp;",
				htmlspecialchars($category),
				htmlspecialchars($category));

		// Tags
		print("Tags:&nbsp;&nbsp;");
		foreach($tags_array as $value)
		{	
			printf("<a href='tag.php?val=%s'>%s</a>&nbsp;&nbsp;",
					htmlspecialchars($value),
					htmlspecialchars($value));
		}

		// Date
		printf("|&nbsp;&nbsp;Date:&nbsp;&nbsp;%s</p>", 
				htmlspecialchars($time));
	}

	/*
	 * Print the introduction of the article
	 */
	function intro($introduction)
	{
		if(is_string($introduction))
			printf("<p>%s</p>", htmlspecialchars($introduction));
		else
			throw new Exception("String is required for introduction.");
	}

	/*
	 * Print the paragraphs.
	 */
	function paragraphs($paragraphs)
	{
		$paragraphs_array = array();
		if(is_string($paragraphs))
			$paragraphs_array = explode('\n', $paragraphs);
		else if(is_array($paragraphs))
			$paragraphs_array = $paragraphs;
		else
			throw new Exception("Paragraphs is required to be an array or an array in string form.");

		foreach($paragraphs_array as $para)
		{
			printf('<p>%s</p>', $para);    //htmlspecialchars deleted for tag uses
		}
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
	 */
	function insert_article($db, $title, $category, $tags, $intro, $article)
	{
		if(!blog_check_exist($db, 'title', $title))
		{
			// Check whether tags is an array and its length.
			if(!is_array($tags))
				throw new Exception('Array required for tags.');
			if(sizeof($tags) > 4)
				throw new Exception('Tag Discription of this article is too long.');

			$string_array = implode(',', $tags);

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
		}
		else
			throw new Exception('The title alreasy exists.');
	}
?>