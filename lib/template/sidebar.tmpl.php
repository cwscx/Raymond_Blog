<div class="caption col-lg-offset-1 col-md-offset-1 col-lg-3 col-md-3">
	<!-- Most popular 15 articles -->
	<h4 style='font-family: sans-serif'>
		<a style='color:#2c3e50;text-decoration:none'>Most popular blogs</a>
	</h4>
	<hr/>
			
	<?php
		$db = sql_connection('blog');
		$result = get_blog_by_clicks($db);

		foreach($result as $row)
		{
			printf("<h5><a href='./article?title=%s'>%s</a></h5>",
				htmlspecialchars($row['title']),
				htmlspecialchars($row['title']));
		}

		mysqli_close($db);
	?>
</div>