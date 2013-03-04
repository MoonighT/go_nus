<?php
class last_location_model extends CI_Model {
	var $tableName = 'last_location';
	var $notNullKeys = array('email', 'location_id');
	var $primaryKeys = array('email', 'location_id');

	function getAllLastLocation() {
		$q = $this -> db -> get($this -> tableName);
		return $this -> prepareResult($q);
	}

	function updateLastLocation($data) {
		if ($this -> isValidateInput($data)) {
			if ($this -> isExist($data)) {
				$query = "UPDATE  `" . $this -> tableName . "` SET  `timestamp` =  CURRENT_TIMESTAMP 
				WHERE  `email` =  '" . $data['email'] . "' AND 'location_id' = `" . $data['location_id'] . "`";
				$this -> db -> query($query);
				return TRUE;
			} else {
				$query = "INSERT INTO `" . $this -> tableName . "` (`email`, `location_id`, `timestamp`) 
				VALUES ('" . $data['email'] . "', '" . $data['location_id'] . "', CURRENT_TIMESTAMP)";
				$this -> db -> query($query);
				return TRUE;
			}

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
				$data[] = $row;
			}
		}
		return $data;
	}

}
?>