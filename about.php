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

		<div class="col-lg-8 col-md-8">
			<h3 style="font-family: sans-serif; color:#2c3e50">About the Blogger</h3>
			<hr/>
			<p>UCSD(University of California, San Diego) third year student</p>
			<p>Major in Computer Science</p>
			<p><a href="https://github.com/cwscx">@github</a>, <a href="https://www.facebook.com/shengyang.shi.1">@fb</a></p>
			<p>wechat: cwscx941224</p>
			<img src="assets/wechatbinary.jpg" width="130px">
		</div>
	</div>
</body>
</html>