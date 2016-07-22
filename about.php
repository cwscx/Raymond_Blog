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
			<p>I am Shengyang Shi (also by the name Raymond), a thrid year undergraduate student at <a href="https://ucsd.edu/">UC San Diego</a> and an current intern in <a href="https://www.salesforce.com/">Salesforce.com . </a> </p>

			<p>I do enjoy my major, Computer Science, and have passion for Statistics and Social Science. 
				My fields of interests include:
				<ul>
					<li>Web Development</li>
						<ul>
							<li><a href="http://raymondssy.com/">Raymond Blog</a> (<a href="https://github.com/cwscx/Raymond_Blog">source code</a>)</li>
							<li><a href="https://budget-controller.herokuapp.com/">Budget Controller</a> (<a href="https://github.com/cwscx/budget-controller">source code</a>)</li>
							<li>Source code for other websites, please refer to my <a href="https://github.com/cwscx?tab=repositories">github</a> account.</li>
						</ul>
					<li>AI</li>
						<ul>
							<li>Machine Learning:</li>
								<ul>
									<li><a href="https://github.com/cwscx/RNN_Article_Trainer">RNN Article Trainer</a></li>
								</ul>
							<li>Articial Intelligence</li>
								<ul>
									<li><a href="https://github.com/cwscx/fantastic_maze">Robot Operating System Package: Fantastic Maze</a></li>
									<li><a href="https://github.com/cwscx/Berkeley-AI-Pacman">Pacman</a></li>
								</ul>
						</ul>
					<li>Infrastructure</li>
					<li>Algorithms</li>
					<li>and many many more!</li>
				</ul>
			</p>
			<br/>
			<p>
				Technically, I started learning Computer Science and coding since University. It's a little bit late comparing to those true geeks
				who wrote their first 'Hello World' program in Java or Python in middle school. But I do enjoy my own pace, and hunger 
				for learning new knowledge. It looks like my passion will last for a long time. 
			</p>
			<br/>
			<p>
				Personally, I love sports, music, food and etc. Machester United is my favourite team. Jay Chou is my favourite singer. And I love any food that tastes good. OMG but food in SF is really expensive. T^T
			</p>
			<br/>
			<p>
				Other interesting things about me:
				<ul>
					<li>I play violin since 5. But my mom told me that the music I played sounded like sawing woods. O.o</li>
					<li>The genre of books I love most is history.</li>
					<li>I like Python and Java. Wait, then why do I use PHP for this website? Ehh, I just wanna try something new.</li>
					<li>I have acrophobia. Roller-Coaster is literally a life-once experience to me.</li>
					<li>I love my family. I like my friends. I am passionate about my life.</li>
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