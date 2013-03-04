<?php
function prepareGeoData($data) {
	$result = array();
	foreach ($data as $name => $s) {
		$name = trim($name, ' ');
		$r = explode('|', $s);
		$points = array();
		foreach ($r as $p) {
			$p = trim($p, ' ');
			$pair_s = explode(",", $p);
			$points[] = array(trim(floatval($pair_s[0])), trim(floatval($pair_s[1])));
		}
		$result[] = array('name' => $name, 'geometry' => $points);
	}
	return $result;
}
?>