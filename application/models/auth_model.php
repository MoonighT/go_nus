<?php
class auth_model extends CI_Model {

	function __construct() {
		parent::__construct();
		$this -> load -> model('user_model');
		define('REALM', 'realm');
	}

	

	function login() {
		$result = array('isSuccess' => false, 'user' => NULL);

		if ($this -> isMember()) {
			$result['isSuccess'] = TRUE;
			$result['user'] = $_SERVER['PHP_AUTH_USER'];
			return $result;
		} else {
			return $result;
		}
	}

	function logout() {

	}

	function isMember() {
		if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) {
			return $this -> user_model -> authenticate($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']);
		} else {
			return FALSE;
		}
	}

	function getCurrentUser() {
		if ($this -> isMember()) {
			return $_SERVER['PHP_AUTH_USER'];
		} else {
			return false;
		}
	}

}
?>