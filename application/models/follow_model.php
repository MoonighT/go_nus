<?php
class follow_model extends CI_Model {
	function __construct() {
		parent::__construct();
		$this -> load -> model('user_model');
	}

	var $tableName = 'follow';
	var $notNullKeys = array('user', 'user_followed');
	var $primaryKeys = array('user', 'user_followed');

	function getAllFollow() {
		$q = $this -> db -> get($this -> tableName);
		return $this -> prepareResult($q);
	}

	function getFollower($email) {
		$q = $this -> db -> select('user');
		$this -> db -> where('user_followed', $email);
		$q = $this -> db -> get($this -> tableName);
		return $this -> prepareResult($q);
	}

	function getFollowed($email) {
		$q = $this -> db -> select('user_followed');
		$this -> db -> where('user', $email);
		$q = $this -> db -> get($this -> tableName);
		return $this -> prepareResult($q);
	}

	function unfollow($email, $param) {
		if (!isset($param['user_followed'])) {
			return false;
		} else {
			$user_followed = urldecode($param['user_followed']);
			if (!$this -> isValidInput($email, $user_followed)) {
				$this -> db -> delete($this -> tableName, array('user' => $email, 'user_followed' => $user_followed));
				if ($this -> db -> affected_rows() > 0) {
					return TRUE;
				} else {
					return $param;
				}
			} else {
				return FALSE;
			}
		}
	}

	function addFollowed($user, $param) {
		if (isset($param['user_followed']) && ($this -> isValidInput($user, $param['user_followed']))) {
			$user_followed = $param['user_followed'];
			$query = "INSERT INTO `" . $this -> tableName . "` (`user`, `user_followed`, `timestamp`) 
			VALUES ('" . $user . "', '" . $user_followed . "',  CURRENT_TIMESTAMP)";
			$this -> db -> query($query);

			return TRUE;
		} else {
			return FALSE;
		}

	}

	function isValidInput($user, $user_followed) {
		if ($this -> user_model -> isExist(array('email' => $user)) && $this -> user_model -> isExist(array('email' => $user_followed))) {
			$this -> db -> where('user', $user);
			$this -> db -> where('user_followed', $user_followed);
			$q = $this -> db -> get($this -> tableName);
			return ($q -> num_rows() == 0);
		} else {
			return FALSE;
		}
	}

	private function prepareResult($resultArray = array()) {
		$data = array();
		if ($resultArray -> num_rows() > 0) {
			foreach ($resultArray->result_array() as $row) {
				$data[] = $row;
			}
		}
		return $data;
	}

}
?>