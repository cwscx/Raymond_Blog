<div class="caption col-lg-offset-1 col-md-offset-1 col-lg-3 col-md-3 col-sm-4 hidden-xs">
	<!-- Most popular 15 articles -->
	<h4>Most popular Blogs</h4>
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
	?>
	<br/>


	<!-- Most frequent tags -->
	<h4>Most frequent Tags</h4>
	<hr/>

	<?php
		get_blog_by_tag_freq($db);

		mysqli_close($db);
	?>
</div>
