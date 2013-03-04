<?php
include_once ('dbapi.php');
$db = new dbAPI();

/*
 $testUser = array("email" => "testemail2.gmail", "name" => "testusername", "password" => "testpassword", "gender" => "male", "status" => null, "major" => null, "faculty" => null, "profile" => NULL);
 $result = $db -> insertUser($testUser);
 var_dump($result);
 $testLocation = array("name" => "testlocation", "description" => null, "profile" => null, "geometry" => array( array(1, 2), array(3, 4)));
 $result = $db -> insertLocation($testLocation);
 var_dump($result);
 $testLocationMsg = array("location_id" => 1, "email" => 'testemail.gmail', 'content' => "testcontent");
 $result = $db -> insertLocationMsg($testLocationMsg);
 var_dump($result);

 $testUserMsg = array('user_from' => 'testemail.gmail', 'user_to' => 'testemail2.gmail', 'content' => "testcontent");
 $result = $db -> insertUserMsg($testUserMsg);
 var_dump($result);
 *

 $testFollow = array('user' => 'testemail.gmail', 'user_followed' => 'testemail2.gmail');
 $result = $db -> insertFollow($testFollow);

 *
 */
$table = 'user';
$result = $db -> selectAll($table);
var_dump($result);
$table = 'user';
$key = 'name';
$value = 'testusername';
$result = $db -> isExist($table, $key, $value);
var_dump($result);
?>