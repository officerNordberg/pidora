<?php
		$stationListText = file_get_contents("stations");
		$stations = explode("|", $stationListText);
		$json = array();
       	foreach($stations as $stationText){
    			$station = explode("=", $stationText);
    			//$stationArray = array($station[0],$station[1]);
    			array_push($json, $station[1]);
       	}
		echo json_encode($json, JSON_FORCE_OBJECT);
		die();
?>
