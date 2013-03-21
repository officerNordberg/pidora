<?php
	# think Bill & Ted
	$station = file_get_contents("station");
	$station = array(
	"station" => $station);
	echo json_encode($station);
	die();
?>
