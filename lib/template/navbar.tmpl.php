<?php
	// Redirection for navbar searching
	if (isset($_POST['submit']))
		header(sprintf('Location: .?search=everything&val=%s', $_POST['search']));
?>

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
				if($_SESSION['current-page'] === 'index')
					echo 'active';
			?>"><a href=".">Home</a></li>
			<li class="nav <?php
				if($_SESSION['current-page'] === 'about')
					echo 'active';
			?>"><a href="about.php">About</a></li>
			<li class="nav <?php 
				if($_SESSION['current-page'] === 'contact')
					echo 'active';
			?>"><a href="contact.php">Contact</a></li>
		</ul>

		<form class="navbar-form navbar-right" role="search" action="." method="post">
			<div class="form-group">
				<input type="text" name="search" class="form-control" placeholder="search">
			</div>
			<button type="submit" name="submit" class="btn btn-default">Submit</button>
		</form>
	</div>	
</div>
<!-- navbar ended -->