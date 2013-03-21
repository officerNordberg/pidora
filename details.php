<?php
	$songInfo = file_get_contents("curSong");
	$arraySong = explode("|", $songInfo);
	$detailsUrl = $arraySong[5];
	$data = file_get_contents($detailsUrl);
	#preg_match("#features of this track(.*?)\<p\>These are just a#is", $data, $matches); // uncomment this if explanations act funny
	preg_match("#features of this track(.*?)\</div\>#is", $data, $matches);
	$strip = array("Features of This Track</h2>", "<div style=\"display: none;\">", "</div>", "<p>These are just a");
	if (!$matches[0]) return "We were unable to get the song's explanation. Sorry about that.";
	$data = explode("<br>", str_replace($strip, "", $matches[0]));
	unset($data[count($data)-1]);
	if (trim($data[count($data)-1]) == "many other comedic similarities")
	{
		$ending = "many other comedic similarities";
		unset($data[count($data)-1]);
	}
	else $ending = "many other similarites as identified by the Music Genome Project";
	$data = implode(", ", array_map('trim', $data));
	echo "We're playing this track because it features $data, and $ending.";
	die();
?>
