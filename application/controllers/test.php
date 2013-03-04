<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class test extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> model('auth_model');
	}

	function index() {
		$this -> load -> view('test');
	}

	function authtest() {
		$this -> load -> view('authtest');
	}

}
