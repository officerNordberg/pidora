<?php
	$stationListText = file_get_contents("stations");
	$stations = explode("|", $stationListText);
	$json = array();
       	foreach($stations as $stationText){
    		$station = explode("=", $stationText);
    		array_push($json, $station[1]);
       	}
	echo json_encode($json, JSON_FORCE_OBJECT);
	die();
?>
