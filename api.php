<?php
if (!$_GET) echo getSong();
else if ($_GET['control']) 
{
	$control = $_GET['control'];
	file_put_contents("debug.log", $_GET['control'], FILE_APPEND );
	if ($control == "s") {
		file_put_contents("ctl", $control);
	} else {
		file_put_contents("ctl", "$control\n");
	}
	if ($control == "n") file_put_contents("msg", "Skipped");
	if ($control == "s") unlink("curSong");
}


function getSong() {
	$return = "";
	if (!file_exists("curSong")) 
	{
		$stations = file_get_contents("usergetstations.txt");
		$list = explode("|", $stations);
		$return .= "<p>";
       		foreach($list as $station){
			$stationArray = explode("=", $station);
			$id = $stationArray[0];
			$name = $stationArray[1];
			$return .= "<a onclick=$.get(\"api.php\",{control:\"$id\"});>$name</a><br/>";
       		}
		$return .= "</p>";
		return $return;
	}

	if (file_exists("msg"))
	{
		$msg = file_get_contents("msg");
		unlink("msg");
		die("<h1 class=msg>$msg</h1>");
	
	}

	$songInfo = file_get_contents("curSong");
	$arraySong = explode("|", $songInfo);
	$title = $arraySong[0];
	$artist = $arraySong[1];
	$album = $arraySong[2];
	$coverart = $arraySong[3];
	if (!$coverart) $coverart = "imgs/pandora.png";
	$love = $arraySong[4];
	
	if ($love==1) $return .= "<img src=imgs/love.png class=love width=20 />";
	$return .= "
	<img src=$coverart class=albumart alt=\"Artwork for $album\" />
	<h1>$title</h1>
	<h2>$artist</h2>
	<h2 class=album>$album</h2>";
	return $return;
}
?>
