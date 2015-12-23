<?php
include('widgets.php');
include('settings.php');
global $settings;

$mysqli = new mysqli($settings['db_host'],$settings['db_user'],$settings['db_pass'],$settings['db_database']);	
global $mysqli;


function hostFromID($host_id) {
	global $mysqli;
	$sql = "SELECT ip FROM sessions WHERE id = '".$host_id."'";
	if(!$result = $mysqli->query($sql)) {
		echo "Sorry, couldn't run that query";
		
	}
	
	if($result->num_rows === 0) {
		echo "Couldn't find a match on that ID";
		
	}
	$rtn = '';
	while($client = $result->fetch_assoc()) {
		$rtn = $client['ip'];
	}
	return $rtn;
}

function sensorFromID($sensor_id) {
	global $mysqli;
	$sql = "SELECT ip FROM sensors WHERE id = '".$sensor_id."'";
	//if(!$result = $mysqli->query($sql)) {
	if(!$result = $mysqli->query($sql)) {
		echo "Sorry, couldn't run that query";
		
	}
	if($result->num_rows === 0) {
		echo "Couldn't find a match on that sensor";
		
	}
	$rtn = '';
	while($sensor = $result->fetch_assoc()) {
		$rtn = $sensor['ip'];
	}
	return $rtn;
}


function fetchSessions($limiter = NULL) {
	$sql = "SELECT * FROM sessions";
	if(!$result = $mysqli->query($sql)) {
		echo "Couldn't run that query right now";
		
	}
	if($result->num_rows === 0) {
		echo "No results found";
		
	}
	
	return $result->fetch_assoc();
}

function fetchSensors() {
	//The point of this is to call this once or twice to preload an array with the sensor hostname/ip values so that 1000 or so sessions doesn't call a nested SQL call just as many times
	global $mysqli;
	$loaded = array();
	$sql = "SELECT * FROM sensors";
	if(!$result = $mysqli->query($sql)) {
		echo "Sorry, couldn't run that query";
		
	}
	if($result->num_rows === 0) {
		echo "There's no sensors here";
		
	}
	
	while($sensor = $result->fetch_assoc()) {
		$loaded[$sensor['id']]['id'] = $sensor['id'];
		$loaded[$sensor['id']]['ip'] = $sensor['ip'];
		$loaded[$sensor['id']]['hostname'] = gethostbyaddr($sensor['ip']);
	}

	return $loaded;
}

$sensors = fetchSensors();
global $sensors;




function throwError($error) {
	return "<div class='alert alert-danger' role='alert'>".$error."</div>";
}
?>

