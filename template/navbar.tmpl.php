<!-- navbar -->
<div id="menu" class="navbar navbar-default navbar-fixed-top">
	<div class="navbar-header">
		<button type="button" class="btn-info navbar-toggle" 
				data-toggle="collapse" data-target=".navbar-collapse">
				<span class="glyphicon glyphicon-th-list"></span>
		</button>
		<div class="navbar-brand">
			<a href="." style="text-decoration:none"><h3 style="color:#EEE">Raymonds Blog</h3></a>
		</div>
	</div>

	<div class="collapse navbar-collapse">
		<ul class="nav navbar-nav navbar-right">
			<li class="nav <?php 
				if($_SESSION['current-page'] === 'index')
					echo active;
			?>"><a href="index.php">Home</a></li>
			<li class="nav <?php
				if($_SESSION['current-page'] === 'about')
					echo active;
			?>"><a href="about.php">About</a></li>
			<li class="nav <?php 
				if($_SESSION['current-page'] === 'contact')
					echo active;
			?>"><a href="contact.php">Contact</a></li>
		</ul>
	</div>	
</div>
<!-- navbar ended -->