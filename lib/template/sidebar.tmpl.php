<div class="caption col-lg-offset-1 col-lg-3 col-md-4 hidden-sm hidden-xs">
	<!-- Most popular 15 articles -->
	<h4>Most popular Blogs</h4>
	<hr/>
			
	<?php
		$db = sql_connection('blog');
		$result = get_blog_by_clicks($db);

		while($row = $result -> fetch_assoc())
		{
			printf("<h5><a href='./article.php?title=%s'>%s</a></h5>",
				urlencode($row['title']),
				htmlspecialchars_decode($row['title']));
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
