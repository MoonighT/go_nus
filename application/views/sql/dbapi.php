<?php
include_once ('mysql.php');

class dbapi {
	var $db;

	var $hostname = "localhost";
	// MySQL Hostname
	var $username = "root";
	// MySQL Username
	var $password = "bitnami";
	// MySQL Password
	var $database = 'cs3216';

	function dbAPI() {
		$this -> db = new MySQL($this -> hostname, $this -> username, $this -> password, $this -> database);
	}

	//=================================================================================================
	/*
	 * INSERT INTO  `cs3216`.`user` (
	 `email` ,
	 `name` ,
	 `password` ,
	 `gender` ,
	 `status` ,
	 `major` ,
	 `faculty` ,
	 `profile`
	 )
	 VALUES (
	 'testemail@gmail.com',  'jjp', MD5(  'jjp' ) ,  'female',  'test',  'cs',  'soc', NULL
	 );
	 */

	//insert user
	// from ['email'->'testemail','name'->'asda','password'->'testpsw',....]
	public function insertUser($user) {
		try {
			$default = 'NULL';
			$status = ($user['status'] == NULL) ? $default : "'" . $user['status'] . "'";
			$faculty = ($user['faculty'] == NULL) ? $default : "'" . $user['faculty'] . "'";
			$major = ($user['major'] == NULL) ? $default : "'" . $user['major'] . "'";
			$profile = ($user['profile'] == NULL) ? $default : $user['profile'];

			$query = "INSERT INTO `" . $this -> database . "`.`user` ( `email` ,`name` ,`password` ,`gender` ,`status` , `major` ,`faculty` ,`profile`)
			VALUES ('" . $user['email'] . "',  '" . $user['name'] . "', MD5(  '" . $user['password'] . "' ) ,  '" . $user['gender'] . "',  " . $status . ",  " . $major . ",  " . $faculty . ", " . $profile . ")";
			return $this -> executeAndGetResult($query);
		} catch(Exception $e) {
			return $this -> getErrorResult($e);
		}
	}

	//var $result=array("isSuccess"=>false,"data"=>'','error'=>'');
	//insert list of geolocation
	// from ['name'->'asda','description'->'test','geometry'->[[1,2][3,4]]]
	public function insertLocation($location) {
		//INSERT INTO `cs3216`.`location` (`location_id`, `name`, `description`, `geometry`) VALUES (NULL, '2', '2', GeomFromText('GEOMETRYCOLLECTION(POINT(1 1),POINT(1 3))',0  ));

		try {
			$default = 'NULL';
			$name = $location['name'];
			$description = ($location['description'] == null) ? $default : "'" . $location['description'] . "'";

			$points = $location['geometry'];
			$geometry = $this -> prepareGeoLocation($points);

			$query = "INSERT INTO `" . $this -> database . "`.`location` (`location_id`, `name`, `description`, `geometry`) 
			VALUES (NULL, '" . $name . "', " . $description . ", " . $geometry . ")";
			return $this -> executeAndGetResult($query);
		} catch(Exception $e) {
			return $this -> getErrorResult($e);
		}

	}

	//From [[1,2],[2,3]]->GeomFromText('GEOMETRYCOLLECTION(POINT(1 1),POINT(1 3))',0  )
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

	public function insertLocationMsg($locationMsg) {
		//INSERT INTO `cs3216`.`location_msg` (`location_id`, `email`, `content`, `timestamp`) VALUES ('6', 'testemail.gmail', '哈哈哈', CURRENT_TIMESTAMP);
		try {
			$query = "INSERT INTO `" . $this -> database . "`.`location_msg` (`location_id`, `email`, `content`, `timestamp`) 
			VALUES ('" . $locationMsg['location_id'] . "', '" . $locationMsg['email'] . "', '" . $locationMsg['content'] . "', CURRENT_TIMESTAMP);";
			return $this -> executeAndGetResult($query);
		} catch(Exception $e) {
			return $this -> getErrorResult($e);
		}
	}

	public function insertUserMsg($userMsg) {
		//INSERT INTO `cs3216`.`user_msg` (`user_from`, `user_to`, `content`, `timestamp`) VALUES ('testemail.gmail', 'testemail2.gmail', 'test', CURRENT_TIMESTAMP);
		try {
			$query = "INSERT INTO `" . $this -> database . "`.`user_msg` (`user_from`, `user_to`, `content`, `timestamp`) 
			VALUES ('" . $userMsg['user_from'] . "', '" . $userMsg['user_to'] . "', '" . $userMsg['content'] . "', CURRENT_TIMESTAMP)";
			return $this -> executeAndGetResult($query);
		} catch(Exception $e) {
			return $this -> getErrorResult($e);
		}
	}

	public function insertFollow($users) {
		//INSERT INTO `cs3216`.`follow` (`user`, `user_followed`, `timestamp`) VALUES ('testemail2.gmail', 'testemail.gmail', CURRENT_TIMESTAMP);
		try {
			$query = "INSERT INTO `" . $this -> database . "`.`follow` (`user`, `user_followed`, `timestamp`) 
			VALUES ('" . $users['user'] . "', '" . $users['user_followed'] . "',  CURRENT_TIMESTAMP)";
			return $this -> executeAndGetResult($query);
		} catch(Exception $e) {
			return $this -> getErrorResult($e);
		}
	}

	//============================================================================================
	public function isExist($table, $key, $value) {
		try {
			$query = "SELECT * FROM `" . $table . "` WHERE '" . $key . "'= '" . $value . "'";
			return $this -> executeAndGetResult($query);
		} catch(Exception $e) {
			return $this -> getErrorResult($e);
		}
	}

	//=================================================================================
	public function selectAll($table) {
		try {
			$query = "SELECT * FROM `" . $table . "` WHERE 1";
			return $this -> executeAndGetResult($query);
		} catch(Exception $e) {
			return $this -> getErrorResult($e);
		}
	}

	private function getErrorResult($e) {
		$result = array("isSuccess" => false, "data" => '', 'affected' => 0, 'error' => '', 'query' => '');
		$result['error'] = $e -> getMessage();

		return $result;
	}

	private function executeAndGetResult($query) {
		$result = array("isSuccess" => false, "data" => '', 'affected' => 0, 'error' => '', 'query' => '');
		$isSuccess = $this -> db -> ExecuteSQL($query);
		$result['isSuccess'] = $isSuccess;
		$result['data'] = $this -> db -> ArrayResults();
		$result['affected'] = $this -> db -> iAffected;
		$result['error'] = $this -> db -> sLastError;
		$result['query'] = $this -> db -> sLastQuery;

		return $result;
	}

}
?>