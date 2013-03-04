<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class location extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> helper('url');
		$this -> load -> model('auth_model');
		$this -> load -> model('location_model');
		$this -> load -> model('location_msg_model');
		$this -> load -> model('output_model');

	}

	function info() {
		$request_method = strtoupper($_SERVER['REQUEST_METHOD']);
		$output = array();
		$result = array();
		try {
			//TODO AUTHENTICATION
			if ($this -> auth_model -> isMember()) {
				//if member
				switch($request_method) {
					case'GET' :
						$result = $this -> location_model -> getAllLocation();
						$this -> output_model -> sendResponse(200, $result);
						break;
					case'POST' :
						$this -> output_model -> sendResponse(405, $result);
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
				switch($request_method) {
					case'GET' :
						$result = $this -> location_model -> getAllLocation();
						$this -> output_model -> sendResponse(200, $result);
						break;
					case'POST' :
						$this -> output_model -> sendResponse(405, $result);
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
			switch($request_method) {
				case'GET' :
					$param = $this -> uri -> uri_to_assoc();
					$result = $this -> location_msg_model -> getLocationMsgWithCondition($param, $email);
					$this -> output_model -> sendResponse(200, $result);
					break;
				case'POST' :
					$param = $this -> input -> post();
					$result = $this -> location_msg_model -> insertLocationMsg($param, $email);
					$this -> output_model -> sendResponse(200, $result);
					break;
				case'PUT' :
					$this -> output_model -> sendResponse(405, $result);
					break;
				case'DELETE' :
					$this -> output_model -> sendResponse(405, $result);
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

	//@Depratiated
	function user() {

		//location/user/params
		$request_method = strtoupper($_SERVER['REQUEST_METHOD']);
		$output = array();
		$result = array();

		if ($this->auth_model->isMember()) {
			//if member
			$email = $this -> auth_model -> getCurrentUser();
			//$email = 'elleryjiao@gmail.com';
			switch($request_method) {
				case'GET' :
					$this -> output_model -> sendResponse(200, $result);
					break;
				case'POST' :
					$this -> output_model -> sendResponse(405, $result);
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
			//else
			$this -> output_model -> sendResponse(401, $result);
		}
	}

}
