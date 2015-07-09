<?php
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
?>