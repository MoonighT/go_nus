<?php
class location_model extends CI_Model {
	var $tableName = 'location';
	var $notNullKeys = array('name', 'geometry');
	var $primaryKeys = array('name');

	function getAllLocation() {
		$query = "SELECT location_id,name, description,profile, AsText(geometry) as geometry FROM `" . $this -> tableName . "` WHERE 1";
		$q = $this -> db -> query($query);
		return $this -> prepareResult($q);
	}

	function insertLocation($location) {
		if ($this -> isValidateInput($location) && (!$this -> isExist($location))) {
			$default = 'NULL';
			$name = $location['name'];
			$description = array_key_exists('descrition', $location) ? "'" . $location['description'] . "'" : $default;
			$points = $location['geometry'];
			$geometry = $this -> prepareGeoLocation($points);

			$query = "INSERT INTO `" . $this -> tableName . "` (`location_id`, `name`, `description`, `geometry`) 
			VALUES (NULL, '" . $name . "', " . $description . ", " . $geometry . ")";

			$this -> db -> query($query);
			return TRUE;
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

	private function reverseGeoLocation($geoText) {
		//(POINT(1.292309 103.780096),POINT(1.291429 103.779001))
		$result = array();
		$geoText = substr($geoText, 18, strlen($geoText) - 1);
		$ptn1 = "/[,(]POINT/";
		$ptn2 = "/[( )]/";
		$text = preg_split($ptn1, $geoText, -1, PREG_SPLIT_NO_EMPTY);
		foreach ($text as $value) {
			$points = preg_split($ptn2, $value, -1, PREG_SPLIT_NO_EMPTY);
			$pair = array('x' => $points[0], 'y' => $points[1]);
			$result[] = $pair;
		}
		return $result;
	}

	private function prepareResult($resultArray = array()) {
		$data = array();
		if ($resultArray -> num_rows() > 0) {
			foreach ($resultArray->result_array() as $row) {
				$row['geometry'] = $this -> reverseGeoLocation($row['geometry']);
				$data[] = $row;
			}
		}
		return $data;
	}

	private function prepareGeoLocation($points) {
		$result = "GeomFromText('GEOMETRYCOLLECTION(";
		for ($i = 0; $i < count($points); $i++) {
			$point = $points[$i];
			$s = "POINT(" . $point[0] . " " . $point[1] . ")";
			if ($i != count($points) - 1) {
				$s = $s . ',';
			}
			$result = $result . $s;
		}
		$result = $result . ")',0  )";
		return $result;
	}

}
?>