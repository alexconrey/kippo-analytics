<?php
include('widgets.php');

$setttings = array();
$settings['site_name'] = 'Kippo Analytics';

$settings['db_host'] = 'localhost';
$settings['db_user'] = 'kippo';
$settings['db_pass'] = '';
$settings['db_database'] = 'kippo';
global $settings;

$mysqli = new mysqli($settings['db_host'],$settings['db_user'],$settings['db_pass'],$settings['db_database']);	
global $mysqli;


function runQuery($sql, $error) {
	global $settings;
	$mysqli = new mysqli($settings['db_host'],$settings['db_user'],$settings['db_pass'],$settings['db_database']);	
	$spitback = '';
	if(!$result = $mysqli->query($sql)) {
		echo "Sorry, couldn't run that query";
		$error = $mysqli->connect_error();
		exit;
	}
	else {
	$spitback = $result;
	return $mysqli->query($sql);
	}
	
}


function hostFromID($id) {
	global $mysqli;
	$sql = "SELECT ip FROM sessions WHERE id = '".$id."'";
	if(!$result = $mysqli->query($sql)) {
		echo "Sorry, couldn't run that query";
		exit;
	}
	
	if($result->num_rows === 0) {
		echo "Couldn't find a match on that ID";
		exit;
	}
	$rtn = '';
	while($client = $result->fetch_assoc()) {
		$rtn = $client['ip'];
	}
	return $rtn;
}

function sensorFromID($id) {
	global $mysqli;
	$sql = "SELECT ip FROM sensors WHERE id = '".$id."'";
	//if(!$result = $mysqli->query($sql)) {
	if(!$result = runQuery($sql)) {
		echo "Sorry, couldn't run that query";
		exit;
	}
	if($result->num_rows === 0) {
		echo "Couldn't find a match on that sensor";
		exit;
	}
	$rtn = '';
	while($sensor = $result->fetch_assoc()) {
		$rtn = $sensor['ip'];
	}
	return $rtn;
}


function fetchSessions($limiter = NULL) {
	$sql = "SELECT * FROM sessions";
	if(!$result = runQuery($sql)) {
		echo "Couldn't run that query right now";
		exit;
	}
	if($result->num_rows === 0) {
		echo "No results found";
		exit;
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
		exit;
	}
	if($result->num_rows === 0) {
		echo "There's no sensors here";
		exit;
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

