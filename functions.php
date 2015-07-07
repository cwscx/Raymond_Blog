<?php
	function navbar_template()
	{
		readfile("./template/navbar.tmpl.html");
	}

	function mysql_con()
	{
		$db = mysqli_connect('localhost', 'root', 'Ray@1224', 'blog');
		return $db;
	}
?>