<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class member extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> helper('url');
		//BASEURL
		define('WEBSITE_URL', base_url() . 'index.php/');
		define('VIEW_URL', WEBSITE_URL . '../application/views/');

	}

	function index() {
		$this -> load -> view('index');
	}

}
