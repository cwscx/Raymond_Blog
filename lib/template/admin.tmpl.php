<!-- navbar -->
<div id="menu" class="navbar navbar-default navbar-fixed-top">
	<div class="navbar-header">
		<button type="button" class="btn-info navbar-toggle" 
				data-toggle="collapse" data-target=".navbar-collapse">
				<span class="glyphicon glyphicon-th-list"></span>
		</button>
		<div class="navbar-brand">
			<a href="." style="text-decoration:none"><h3 style="color:#EEE">Raymond's Blog</h3></a>
		</div>
	</div>

	<div class="collapse navbar-collapse">
		<ul class="nav navbar-nav navbar-right">
			<li class="nav <?php 
				if($_SESSION['current-page'] === 'post')
					echo 'active';
			?>"><a href="../private/post_blog.php">Post</a></li>
			<li class="nav <?php
				if($_SESSION['current-page'] === 'comments')
					echo 'active';
			?>"><a href="../private/comments_view.php">Comments</a></li>
		</ul>
	</div>	
</div>
<!-- navbar ended -->