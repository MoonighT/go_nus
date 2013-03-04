<?php

date_default_timezone_set('Asia/Singapore');

function get_root_url() {
	$page_url = 'http';
	if (!empty($_SERVER['HTTPS']))
		$page_url .= "s";
	$page_url .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
		$page_url .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"];
	} else {
		$page_url .= $_SERVER["SERVER_NAME"];
	}

	// if 'mobile' folder is found, use it as root, otherwise, use the real root
	$uri = $_SERVER['REQUEST_URI'];
	$index = strpos($uri, 'mobile');
	if ($index !== false)
		return $page_url . substr($uri, 0, $index) . 'mobile/';
	return $page_url . '/';
}

function get_file_url($relative_path) {
	return base_url() . '/application/views/' . $relative_path;
}

function get_file_path($relative_path) {
	return base_url() . '/application/views/' . $relative_path;
}

function get_current_page() {
	return empty($_GET['page']) ? 1 : $_GET['page'];
}



?>