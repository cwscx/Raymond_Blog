<?php
	/*
	 * Print the title for an article
	 */
	function title($title, $clicks)
	{
		if(is_string($title))
		{
			printf("
				<h3 style='font-family: sans-serif, Trebuchet MS, Palatino Linotype;'>
					<a style='color:black' href='article.php?title=%s'>%s</a>
					<span class='badge'>%s℉</span>
				</h3>
				<hr/>
				",
				urlencode($title),
				htmlspecialchars_decode($title),
				htmlspecialchars_decode($clicks));
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
			$tags_array = explode(",", $tags); 	// Transfer the tags from string to array
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
					Category:&nbsp;<a href='.?search=%s&val=%s'>%s</a>&nbsp;&nbsp;|&nbsp;&nbsp;
					",
				urlencode('category'),
				urlencode($category),
				htmlspecialchars_decode($category));

		// Tags
		print("Tags:&nbsp;&nbsp;");
		foreach($tags_array as $value)
		{	
			printf("<a href='.?search=%s&val=%s'>%s</a>&nbsp;&nbsp;",
					urlencode('tags'),
					urlencode($value),
					htmlspecialchars_decode($value));
		}

		// Date
		printf("|&nbsp;&nbsp;
					Date:&nbsp;&nbsp;%s
				</p>
				", 
				htmlspecialchars_decode($time));
	}

	/*
	 * Print the introduction of the article
	 */
	function intro($introduction)
	{
		if(is_string($introduction))
			printf("<p>%s</p><br/>", htmlspecialchars_decode($introduction));
		else
			throw new Exception("String is required for introduction.");
	}

	/*
	 * Print the paragraphs.
	 */
	function paragraphs($paragraphs)
	{
		echo '<br/>';
		$paragraphs_array = array();
		if(is_string($paragraphs))
			$paragraphs_array = explode('\n', $paragraphs);
		else if(is_array($paragraphs))
			$paragraphs_array = $paragraphs;
		else
			throw new Exception("Paragraphs is required to be an array or an array in string form.");

		foreach($paragraphs_array as $para)
		{
			printf('<p>%s</p>', htmlspecialchars_decode($para));    //htmlspecialchars deleted for tag uses
		}
	}

	/* 
	 * Function to implement pagination due to different cases 
	 */
	function panigation($pages, $current_page, $para, $value)
	{
		// left panigation "<<"
		echo "
			<nav>
				<ul class='pagination'>
					";
		// If the current page is the first page, block the left panigation
		if($current_page === 1)
			echo "<li class='disabled'>";
		else
			echo "<li>";
		// Set the href address due to different request
		if($para === '' && $value === '')
		{
			echo "<a href='.' aria-label='Previous'><span aria-hidden='true'>&laquo;</span></a></li>
					";
		}
		else
		{
			printf("<a href='.?search=%s&val=%s' aria-label='Previous'><span aria-hidden='true'>&laquo;</span></a></li>
					", 
					urlencode($para),
					urlencode($value));
		}


		// middle pages
		// When the page number is less than 5, 
		// OR the page number is larger than 5, but the difference between current page and page number is larger than 2,
		// and the current page is less than or equal to 3. They should consider another case that when 1 is clicked
		if($pages <= 5 || ($pages > 5 && ($pages - $current_page) >= 2 && $current_page <= 3))
		{
			// Always start from the first page(1)
			for($i = 1; $i <= ($pages <= 5 ? $pages : 5); $i++)
			{
				if($i === 1)
				{
					if($para === '' && $value === '')
					{
						printf("<li><a href='.'>%d</a></li>
					", $i);
					}
					else
					{
						printf("<li><a href='.?search=%s&val=%s'>%d</a></li>
					",
						urlencode($para),
						urlencode($value),
						$i);
					}
				}
				else
				{
					if($para === '' && $value === '')
					{
						printf("<li><a href='.?cp=%d'>%d</a></li>
					", urlencode($i), $i);
					}
					else
					{
						printf("<li><a href='.?search=%s&val=%s&cp=%d'>%d</a></li>
					", 
						urlencode($para),
						urlencode($value),
						urlencode($i), $i);
					}
				}
			}
		}
		// If the page number is larger than 5, the page difference  is still larger than or equal to 2, 
		// but the current page is larger than 3. Always keep the selected page in the middle of the panigation
		else if(($pages - $current_page) >= 2 && $current_page > 3)
		{
			for($i = $current_page - 2; $i <= $current_page + 2; $i++)
			{
				if($para === '' && $value === '')
				{
					printf("<li><a href='.?cp=%d'>%d</a></li>
					", urlencode($i), $i);
				}
				else
				{
					printf("<li><a href='.?search=%s&val=%s&cp=%d'>%d</a></li>
					", 
					urlencode($para),
					urlencode($value),
					urlencode($i), $i);
				}
			}
		}
		// If the page difference is less than 2, take the last 5 pages
		else
		{
			for($i = $pages - 4; $i <= $pages; $i++)
			{
				if($para === '' && $value === '')
				{
					printf("<li><a href='.?cp=%d'>%d</a></li>
					", urlencode($i), $i);
				}
				else
				{
					printf("<li><a href='.?search=%s&val=%s&cp=%d'>%d</a></li>
					", 
					urlencode($para),
					urlencode($value),
					urlencode($i), $i);
				}
			}
		}

		// right panigation
		// When the last page is reached, the right panigation is diabled
		if($current_page == $pages)
			echo "<li class='disabled'>";
		else
			echo "<li>";
		// Set right panigation's href due to different request
		if($para === '' && $value === '')
		{
			printf("<a href='.?cp=%d' aria-label='Next'><span aria-hidden='true'>&raquo;</span></a></li>
				</ul>
			</nav>", $pages);
		}
		else
		{
			printf("<a href='.?search=%s&val=%s&cp=%d' aria-label='Next'><span aria-hidden='true'>&raquo;</span></a></li>
				</ul>
			</nav>
", 
					urlencode($para),
					urlencode($value),
					urlencode($pages));
		}
	}
?>
