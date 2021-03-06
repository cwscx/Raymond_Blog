<?php
	/*
	 * Check whether the passed in key-value pair exists. 
	 * If exist, return the result. Else return NULL.
	 * ATTENTION: the return result might be an array, since the sql searching is not exact searching.
	 * When para is '', search without limitation.
	 * When para is 'everything', search by finding anything matches
	 */
	function blog_check_exist($db, $para, $expect_val)
	{
		if(is_string($para))
		{
			$sql = NULL;

			// Select everything from the articles
			if($para === '')
				$sql = 'SELECT * FROM articles ORDER BY id DESC';
			else if($para === 'everything')
			{
				// Search for keyword in a title/tag/category/intro/article of a blog
				$sql = sprintf("SELECT * FROM articles WHERE %s LIKE '%%%s%%' OR %s LIKE '%%%s%%' OR %s LIKE '%%%s%%' OR %s LIKE '%%%s%%' OR %s LIKE '%%%s%%' ORDER BY id DESC", 
								mysqli_real_escape_string($db, 'title'),
								mysqli_real_escape_string($db, $_GET['val']),
								mysqli_real_escape_string($db, 'category'),
								mysqli_real_escape_string($db, $_GET['val']),
								mysqli_real_escape_string($db, 'tags'),
								mysqli_real_escape_string($db, $_GET['val']),
								mysqli_real_escape_string($db, 'intro'),
								mysqli_real_escape_string($db, $_GET['val']),
								mysqli_real_escape_string($db, 'article'),
								mysqli_real_escape_string($db, $_GET['val']));
			}
			else
			{
				// Use inclusive searching
				$sql = sprintf("SELECT * FROM articles WHERE %s LIKE '%%%s%%' ORDER BY id DESC", 
								mysqli_real_escape_string($db, $para),
								mysqli_real_escape_string($db, $expect_val));
			}

			$result = mysqli_query($db, $sql);

			if(!$result || mysqli_num_rows($result) === 0)
				return NULL;

			return $result;
		}
		else
			throw new Exception("String parameter required.");
	}


	/*
	 * Check whether the passed in key-value pair exists. 
	 * If exist, return the result. Else return NULL.
	 * ATTENTION: the return result might be an array, since the sql searching is not exact searching.
	 * When para is '', search without limitation.
	 * When para is 'everything', search by finding anything matches
	 */
	function blog_check_limits($db, $para, $expect_val, $initial, $offset)
	{
		if(is_string($para))
		{
			if(is_numeric($initial) && is_numeric($offset))
			{
				if($initial >= 0 && $offset >= -1)
				{
					$sql = NULL;

					// Select everything from the articles
					if($para === '')
						$sql = sprintf('SELECT * FROM articles ORDER BY id DESC LIMIT %d, %d', $initial, $offset);
					else if($para === 'everything')
					{
						// Search for keyword in a title/tag/category/intro/article of a blog
						$sql = sprintf("SELECT * FROM articles WHERE %s LIKE '%%%s%%' OR %s LIKE '%%%s%%' OR 
										%s LIKE '%%%s%%' OR %s LIKE '%%%s%%' OR %s LIKE '%%%s%%' ORDER BY id DESC LIMIT %d, %d", 
										mysqli_real_escape_string($db, 'title'),
										mysqli_real_escape_string($db, $_GET['val']),
										mysqli_real_escape_string($db, 'category'),
										mysqli_real_escape_string($db, $_GET['val']),
										mysqli_real_escape_string($db, 'tags'),
										mysqli_real_escape_string($db, $_GET['val']),
										mysqli_real_escape_string($db, 'intro'),
										mysqli_real_escape_string($db, $_GET['val']),
										mysqli_real_escape_string($db, 'article'),
										mysqli_real_escape_string($db, $_GET['val']),
										$initial, $offset);
					}
					else
					{
						// Use inclusive searching
						$sql = sprintf("SELECT * FROM articles WHERE %s LIKE '%%%s%%' ORDER BY id DESC LIMIT %d, %d", 
										mysqli_real_escape_string($db, $para),
										mysqli_real_escape_string($db, $expect_val),
										$initial, $offset);
					}
				
					$result = mysqli_query($db, $sql);

					if(!$result || mysqli_num_rows($result) === 0)
						return NULL;
				
					return $result;
				}
				else
					throw new Exception("Initial is required to be not negative, and offset is required to be larger or equal to minus one. ");
			}
			else
				throw new Exception("Initial and Offset are required to be numbers.");
		}
		else
			throw new Exception("String parameter required.");
	}


	/*
	 * Check exactly about the title without any fuzzy search.
	 * Otherwise title with keyword inclusive will also be displayed
	 */
	function get_blog_by_title($db, $title)
	{
		if(is_string($title))
		{
			$sql = sprintf("SELECT * FROM articles WHERE title LIKE '%s'", 
								mysqli_real_escape_string($db, $title));

			$result = mysqli_query($db, $sql);

			if(!$result || mysqli_num_rows($result) === 0)
				return NULL;

			return $result;
		}
		else
			throw new Exception("String parameter required.");
	}

	/*
	 * Return the TOP 15 clicked articles
	 */
	function get_blog_by_clicks($db)
	{
		$sql = "SELECT * FROM articles ORDER BY clicks DESC LIMIT 0, 15";
		$result = mysqli_query($db, $sql);

		if(!$result || mysqli_num_rows($result) === 0)
			return NULL;

		return $result;
	}

	/*
	 * Return the TOP 8 most frequent tags
	 */
	function get_blog_by_tag_freq($db)
	{
		$result = blog_check_exist($db, '', '');
		$freq_array = array();

		// Store all the existing tags in an array
		while($row = $result -> fetch_assoc())
		{
			$tags_array = explode(',', $row['tags']);
			for($i = 0; $i < sizeof($tags_array); $i++)
			{
				if(!isset($freq_array[$tags_array[$i]]))
					$freq_array[$tags_array[$i]] = 1;
				else
					$freq_array[$tags_array[$i]]++;
			}
		}

		// Sort in descending 
		arsort($freq_array, SORT_NUMERIC);
		$keys = array_keys($freq_array);

		// Print the tags' names
		for($i = 0; $i < ((sizeof($freq_array) <= 8) ? sizeof($freq_array) : 8); $i++)
		{
			printf("<h5><a href='.?search=tags&val=%s'>%s</a></h5>",
				urlencode($keys[$i]),
				htmlspecialchars($keys[$i]));
		}
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
			print $sql;
			echo "\n isset(db): ";
			print isset($db);
			$result = mysqli_query($db, $sql);
			print "\nresult ==false: ";
			print $result == false;
			print "\n";
			return $result;
		}
		else
			throw new Exception('The title alreasy exists.');
	}


	/*
	 * This funciton will update the article already exists in db
	 */
	function update_article($db, $title, $category, $tags, $intro, $article)
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
		$sql = sprintf("UPDATE blog.articles SET category='%s', tags='%s', intro='%s', article='%s' WHERE title='%s'",
						mysqli_real_escape_string($db, $category),
						mysqli_real_escape_string($db, $tags),
						mysqli_real_escape_string($db, $intro),
						mysqli_real_escape_string($db, $article),
						mysqli_real_escape_string($db, $title));
		$result = mysqli_query($db, $sql);

		return $result;	
	}

	/*
	 * Auto increase the clicks of a blog by 1
	 */
	function update_clicks($db, $title)
	{
		$sql = sprintf("UPDATE blog.articles SET clicks = (clicks + 1) WHERE title = '%s'", $title);

		$result = mysqli_query($db, $sql);
		return $result;
	}

	/*
	 * Get a blog's click
	 */
	function get_click($db, $title)
	{
		$sql = sprintf("SELECT clicks FROM blog.articles WHERE title = '%s'", $title);

		$result = mysqli_query($db, $sql);
		return $result;
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

	/*
	 * Return all users' advices.
	 */
	function get_all_advice($db)
	{
		$sql = "SELECT * FROM advice ORDER BY id DESC";
		$result = myslqi_query($db, $sql);

		if(!$result || mysqli_num_rows($result) === 0)
			return NULL;

		return $result;
	}
?>
