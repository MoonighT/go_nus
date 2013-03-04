<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class follow extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> helper('url');
		$this -> load -> model('auth_model');
		$this -> load -> model('follow_model');
		$this -> load -> model('output_model');

	}

	function follower() {
		$request_method = strtoupper($_SERVER['REQUEST_METHOD']);
		$output = array();
		$result = array();
		try {

			if ($this -> auth_model -> isMember()) {
				$email = $this -> auth_model -> getCurrentUser();
				//if member
				switch($request_method) {
					case'GET' :
						$result = $this -> follow_model -> getFollower($email);
						$this -> output_model -> sendResponse(200, $result);
						break;
					case'POST' :
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
				$this -> output_model -> sendResponse(401, $result);
			}
		} catch(Exception $e) {
			$this -> output_model -> sendResponse(405, $result, $e -> getMessage());
		}
	}

	function followed() {
		$request_method = strtoupper($_SERVER['REQUEST_METHOD']);
		$output = array();
		$result = array();
		try {

			if ($this -> auth_model -> isMember()) {
				$email = $this -> auth_model -> getCurrentUser();
				//if member
				switch($request_method) {
					case'GET' :
						$result = $this -> follow_model -> getFollowed($email);
						$this -> output_model -> sendResponse(200, $result);
						break;
					case'POST' :
						$param = $this -> input -> post();
						$result = $this -> follow_model -> addFollowed($email, $param);
						$this -> output_model -> sendResponse(200, $result);
						break;
					case'PUT' :
						$this -> output_model -> sendResponse(405, $result);
						break;
					case'DELETE' :
						$param = explode('=', file_get_contents('php://input'));
						$param = array($param[0] => $param[1]);
						$result = $this -> follow_model -> unfollow($email, $param);
						$this -> output_model -> sendResponse(200, $result);

						break;
					default :
						$this -> output_model -> sendResponse(405, $result);
				}
			} else {
				$this -> output_model -> sendResponse(401, $result);
			}
		} catch(Exception $e) {
			$this -> output_model -> sendResponse(400, $result, $e -> getMessage());
		}
	}

}
