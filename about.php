<?php
	require_once(dirname(__FILE__) . "/lib/functions_template.php");

	session_start();
	$_SESSION['current-page'] = 'about';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Raymond Shi's Blog</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
</head>
<body>
	<!-- Bootstrap's js requires jquery. So jquery needs to included first -->
	<script type="text/javascript" src="js/jquery-2.1.4.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>

	<div class="container">
	<?php
		navbar_template();
		header_template();
	?>

		<div class="col-lg-offset-2 col-md-offset-2 col-lg-8 col-md-8 article" >
			<h2 style="font-family: sans-serif, 'Trebuchet MS'; color:#2c3e50">About me</h2>
			<hr/>
			<h4>Hello There!</h4>
			<br/>
			<p>I am Shengyang Shi (also by the name Raymond), a second year undergraduate student at UC San Diego. 
			I do enjoy my major, Computer Science, and have passion for Statistics and Social Science. 
			In the summer of 2015, I contributed to the development of Cat Grapes Online Education, where I worked on the ios/Android
			backend. The apps and the website will be deployed soon. I'll update as soon as it's available. Currently, I am doing research with Professor 
			<a href="http://genedesk.ucsd.edu/home/">Debashis Sahoo</a> at UC San Diego.</p>
			<br/>
			<p>
				My fields of interests include:
				<ul>
					<li>Artificial Intelligence</li>
					<li>Data Mining</li>
					<li>Computer Vision</li>
					<li>Algorithms</li>
					<li>Backend maintainence and development</li>
					<li>ios/Android development</li>
					<li>Bioinformatics</li>
					<li>and many many more!</li>
				</ul>
			</p>
			<br/>
			<p>
				I started learning Computer Science and coding since University. It's a little bit late comparing to those true geeks
				who wrote their first 'Hello World' program in Java or Python in middle school. But I do enjoy my own pace, and hunger 
				for learning new knowledge. It looks like my passion will last for a long time. 
			</p>
			<br/>
			<p>
				I like playing basketball and soccer, and enjoy watching tennis and other sports. I support Manchester United and Huston Rockets.
				If you are also fans of them, let's hang out! ^v^
			</p>
			<br/>
			<p>
				Other interesting things about me:
				<ul>
					<li>I played violin since 5. But I seldomly play it now. One of my friend told me that the music I played sounded like sawing woods.</li>
					<li>My favorite singers are Jay Chou and Eason Chen.</li>
					<li>I like playing Hearthstone!</li>
					<li>I plan to go to Atlanta this Novermember! Yellow Stone and Yosomite in the next year!</li>
				</ul>
			</p>
			<br/>
			<p>This Blog is the place I share myself with all you guys! </p>
			<p>Hope you enjoy it!</p>

			<br/>
			<br/>
			<p>Contact and Further Info
				<ul>
					<li><a href="https://www.facebook.com/shengyang.shi.1">@fb</a></li>
					<li><a href="https://www.linkedin.com/pub/shengyang-shi/b0/2b2/84">@linkedin</a></li>
					<li>wechat: cwscx941224</li>
					<li><img src="assets/wechatbinary.jpg" width="130px"></li>
				</ul>
			</p>

			<br/>

		</div>
		<div class='col-lg-12 col-lg-12 col-sm-12 col-xs-12' style="visibility:hidden">blank</div>
	</div>
</body>
</html>