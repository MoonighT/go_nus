<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class user extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> helper('url');
		$this -> load -> model('auth_model');
		$this -> load -> model('user_model');
		$this -> load -> model('user_msg_model');
		$this -> load -> model('output_model');

	}

	function index() {
		//only for insert new user
		$request_method = strtoupper($_SERVER['REQUEST_METHOD']);
		$output = array();
		$result = array();
		if ($this -> auth_model -> isMember()) {
			$this -> output_model -> sendResponse(405, $result);
		} else {
			if ($request_method == 'POST') {
				$param = $this -> input -> post();
				$result = $this -> user_model -> insertUser($param);
				$this -> output_model -> sendResponse(200, $result);
			}
		}
	}

	function login() {
		$result = array();
		$request_method = strtoupper($_SERVER['REQUEST_METHOD']);
		if ($request_method == 'POST') {
			$result = $this -> auth_model -> login();
			$this -> output_model -> sendResponse(200, $result);
		} else {
			$this -> output_model -> sendResponse(405, $result);
		}
	}

	function logout() {
		$request_method = strtoupper($_SERVER['REQUEST_METHOD']);
		$result = array();
		if ($request_method == 'POST') {
			$result1 = $this -> auth_model -> logout();
			$this -> output_model -> sendResponse(200, $result);
		} else {
			$this -> output_model -> sendResponse(405, $result);
		}
	}

	function info() {
		$request_method = strtoupper($_SERVER['REQUEST_METHOD']);
		$output = array();
		$result = array();
		try {

			if ($this -> auth_model -> isMember()) {
				//if member

				$email = $this -> auth_model -> getCurrentUser();
				switch($request_method) {
					case'GET' :
						$param = $this -> uri -> uri_to_assoc();
						$result = $this -> user_model -> getUserWithCondition($param);
						$this -> output_model -> sendResponse(200, $result);
						break;
					case'POST' :
						$data = $this -> input -> post();
						$result = $this -> user_model -> updateUser($email, $data);
						$this -> output_model -> sendResponse(200, $result);
						break;
					case'PUT' :
						$this -> output_model -> sendResponse(405, $result);
						break;
					case'DELETE' :
						$this -> output_model -> sendResponse(405, $result);
						break;
					default :
						$this -> output_model -> sendResponse(405, $result);
				}
			} else {
				$this -> output_model -> sendResponse(401, "NOT LOGING");
			}
		} catch(Exception $e) {
			$this -> output_model -> sendResponse(400, $result, $e -> getMessage());
		}
	}

	function msg() {
		//user/msg/params
		$request_method = strtoupper($_SERVER['REQUEST_METHOD']);
		$output = array();
		$result = array();

		if ($this -> auth_model -> isMember()) {
			//if member
			$email = $this -> auth_model -> getCurrentUser();
			//$email = 'elleyjiao@gmail.com';
			switch($request_method) {
				case'GET' :
					$param = $this -> uri -> uri_to_assoc();
					$result = $this -> user_msg_model -> getUserMsgWithCondition($param, $email);
					$this -> output_model -> sendResponse(200, $result);
					break;
				case'POST' :
					$param = $this -> input -> post();
					$result = $this -> user_msg_model -> insertUserMsg($param, $email);
					$this -> output_model -> sendResponse(200, $result);
					break;
				case'PUT' :
					$this -> output_model -> sendResponse(405, $result);
					break;
				case'DELETE' :
					//TODO logout
					$this -> output_model -> sendResponse(405, $result);
					break;
				default :
					$this -> output_model -> sendResponse(405, $result);
			}
		} else {
			//else
			$this -> output_model -> sendResponse(401, $result);
		}
	}

	function location() {
		//user/location/params
		$request_method = strtoupper($_SERVER['REQUEST_METHOD']);
		$output = array();
		$result = array();

		if ($this -> auth_model -> isMember()) {
			//if member
			$email = $this -> auth_model -> getCurrentUser();
			//$email = 'elleryjiao@gmail.com';
			switch($request_method) {
				case'GET' :
					$result = $this -> user_model -> getUserLastLocation($email);
					$this -> output_model -> sendResponse(200, $result);
					break;
				case'POST' :
					$param = $this -> input -> post(null, TRUE);
					$result = $this -> user_model -> updateUserLastLocation($email, $param);
					$this -> output_model -> sendResponse(200, $result);
					break;
				case'PUT' :
					break;
				case'DELETE' :
					break;
				default :
					$output['error'] = 'NO METHOD';
					$output['method'] = $request_method;
					$this -> load -> view('error', $output);
			}
		} else {
			//else
			$this -> output_model -> sendResponse(401, $result);
		}
	}

}
