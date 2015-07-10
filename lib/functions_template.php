<?php
	/*
	 * Get navbar template for the page.
	 */
	function navbar_template()
	{
		require_once(dirname(__FILE__) . '/template/navbar.tmpl.php');
	}

	/*
	 * Get header template for the page.
	 */
	function header_template()
	{
		require_once(dirname(__FILE__) . '/template/header.tmpl.php');
	}

	/*
	 * navbar for the administration page
	 */
	function admin_template()
	{
		require_once(dirname(__FILE__) . '/template/admin.tmpl.php');
	}

	function category_template()
	{
		require_once(dirname(__FILE__) . '/template/category.tmpl.php');
	}
?>