<?php
	$songInfo = file_get_contents("curSong");
	$arraySong = explode("|", $songInfo);
	$song = array(
	title => $arraySong[0],
	artist => $arraySong[1],
	album => $arraySong[2],
	coverart => $arraySong[3],
	love => $arraySong[4],
	details => $arraySong[5]);
	echo json_encode($song);
	die();
?>
