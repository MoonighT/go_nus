<?php

session_start();
session_unset();
function get_location(){
	if(isset($_SESSION['location']))
		return $_SESSION['location'];

	$location = array(
	array('name'=>'pgp','geometry'=>array(array(1.292309, 103.780096),array(1.291429, 103.779001),array(1.289638, 103.780954),array(1.291397, 103.783593),array(1.291922, 103.783196),array(1.291054, 103.781115))),
	array('name'=>'soc','geometry'=>array(array(1.295526,103.773709),array(1.295397,103.773425),array(1.293976,103.773763),array(1.293112,103.774106),array(1.293418,103.774455),array(1.293869,103.774246),array(1.294448,103.774213),array(1.294587,103.774444))),
	);

	// get location


	$_SESSION['location'] = $location;
		return $_SESSION['location'];
}

$location_data = get_location();
echo json_encode($location_data);

        
        
        
        
        
        
        