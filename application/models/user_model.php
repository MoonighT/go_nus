<?php
class user_model extends CI_Model {
	function __construct() {
		parent::__construct();
		$this -> load -> model('profile_model');
	}

	var $tableName = 'user';
	var $notNullKeys = array('name', 'password', 'email', 'gender');
	var $primaryKeys = array('email');

	//supposed not to use
	function getAllUser() {
		$q = $this -> db -> get($this -> tableName);
		return $this -> prepareResult($q);
	}

	function getUserWithEmail($email = 'test@mail.com') {
		$q = $this -> db -> get_where($this -> tableName, array('email' => $email));
		return $this -> prepareResult($q);
	}

	function getUserWithCondition($data = array()) {
		$point = array();
		foreach ($data as $key => $value) {
			if ($key == 'email') {
				$query = "SELECT email,name,gender,status,major,faculty,profile, AsText(last_location) as geometry,last_location_timestamp , hobbies FROM `" . $this -> tableName . "` WHERE md5(email)='" . $value . "'";
				$q = $this -> db -> query($query);
				return $this -> prepareResult($q);
			} else if ($key == 'major') {
				$this -> db -> where('major like', '%' . $value . '%');
			} else if ($key == 'status') {
				$this -> db -> where('status LIKE', '%' . $value . '%');
			} else if ($key == 'hobbies') {
				$this -> db -> where('hobbies LIKE', '%' . $value . '%');
			} else if ($key == 'faculty') {
				$this -> db -> where('faculty LIKE', '%' . $value . '%');
			} else if ($key == 'name') {
				$this -> db -> where('name LIKE', '%' . $value . '%');
			} else if ($key == 'gender') {
				$this -> db -> where('gender', $value);
			}
		}
		$this -> db -> select('email,name,gender,status,major,faculty,profile, AsText(last_location) as geometry,last_location_timestamp,hobbies');
		$q = $this -> db -> get($this -> tableName);
		//echo $this -> db -> last_query();
		return $this -> prepareResult($q);
	}

	function updateUserLastLocation($email, $point) {
		if (isset($point['x']) && isset($point['y'])) {
			$query = "UPDATE  `" . $this -> tableName . "` SET  `last_location` = " . $this -> prepareGeoPoint($point) . " ,`last_location_timestamp` =  CURRENT_TIMESTAMP WHERE `email` =  '" . $email . "'";
			$q = $this -> db -> query($query);
			//echo $this -> db -> last_query();
			return $this -> getUserWithEmail($email);
		} else {
			return false;
		}
	}

	function getUserLastLocation($email) {
		$this -> db -> select('AsText(last_location) as geometry,last_location_timestamp');
		$this -> db -> where('email', $email);
		$q = $this -> db -> get($this -> tableName);
		return $this -> prepareResult($q);
	}

	function updateUser($email, $data) {

		if (isset($data['email']))
			unset($data['email']);
		if (isset($data['password']))
			unset($data['password']);
		if (isset($data['last_location']))
			unset($data['last_location']);
		$this -> db -> where('email', $email);
		$this -> db -> update($this -> tableName, $data);
		return $this -> db -> getUserWithEmail($email);
	}

	function insertUser($user = array()) {
		if ($this -> isValidateInput($user) && (!$this -> isExist($user))) {
			$default_profile = $this -> profile_model -> getDefaultProfile($user['gender']);
			$default = 'NULL';
			$status = array_key_exists('status', $user) ? "'" . $user['status'] . "'" : $default;
			$faculty = array_key_exists('faculty', $user) ? "'" . $user['faculty'] . "'" : $default;
			$major = array_key_exists('major', $user) ? "'" . $user['major'] . "'" : $default;
			$profile = array_key_exists('profile', $user) ? $user['profile'] : $default_profile;
			$hobbies = array_key_exists('hobbies', $user) ? $user['hobbies'] : $default;
			$query = "INSERT INTO `" . $this -> tableName . "` ( `email` ,`name` ,`password` ,`gender` ,`status` , `major` ,`faculty`,`hobbies` ,`profile`)
			VALUES ('" . $user['email'] . "',  '" . $user['name'] . "', '" . $user['password'] . "' ,  '" . $user['gender'] . "',  " . $status . ",  " . $major . ",  " . $faculty . ",  " . $hobbies . ", '" . $profile . "')";
			$this -> db -> query($query);
			//add admin as friend by default
			$user_followed = 'admin';
			$query = "INSERT INTO `" . "follow" . "` (`user`, `user_followed`, `timestamp`) 
			VALUES ('" . $user['email'] . "', '" . $user_followed . "',  CURRENT_TIMESTAMP)";
			$this -> db -> query($query);
			return true;
		} else {
			return false;
		}
	}

	function isExist($input) {
		foreach ($this->primaryKeys as $key) {
			$this -> db -> where($key, $input[$key]);
		}
		$query = $this -> db -> get($this -> tableName);
		if ($query -> num_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	//sensitive
	function getPassword($email = 'testuser') {
		$this -> db -> select('password');
		$this -> db -> where('email', $email);
		$q = $this -> db -> get($this -> tableName);
		$result = $q -> result_array();
		return $result[0]['password'];
	}

	function authenticate($email, $pw) {
		$this -> db -> where('email', $email);
		$this -> db -> where('password', $pw);
		$query = $this -> db -> get($this -> tableName);
		if ($query -> num_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function isValidateInput($input) {
		$result = true;
		foreach ($this->notNullKeys as $key) {
			$result = $result && (array_key_exists($key, $input));
			if ($result == true) {
				$result = $result && (!(is_null($input[$key]) || $input[$key] == ''));
			} else {
				break;
			}
		}
		return $result;
	}

	private function prepareResult($resultArray = array()) {
		$data = array();
		if ($resultArray -> num_rows() > 0) {
			foreach ($resultArray->result_array() as $row) {
				unset($row['password']);
				//NEVER RETURN PASSWORD
				if (isset($row['geometry'])) {
					$row['geometry'] = $this -> reverseGeoPoint($row['geometry']);
				}
				$data[] = $row;
			}
		}
		return $data;
	}

	private function prepareGeoPoint($point) {
		return "GEOMFROMTEXT('POINT(" . $point['x'] . " " . $point['y'] . ")',0)";
	}

	private function reverseGeoPoint($string) {
		$ptn = "/POINT/";
		$a1 = preg_split($ptn, $string, -1, PREG_SPLIT_NO_EMPTY);
		$string = $a1[0];
		$ptn = "/[( )]/";
		$a2 = preg_split($ptn, $string, -1, PREG_SPLIT_NO_EMPTY);
		$result = array('x' => $a2[0], 'y' => $a2[1]);
		return $result;
	}

}
?>