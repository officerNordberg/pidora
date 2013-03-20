<?php
if (isset($_GET['control'])) 
{
	$control = $_GET['control'];
	file_put_contents("ctl", $control);
	if ($control == "n") file_put_contents("msg", "Skipped");
} 

function getSong() {
	$return = "";

	if (file_exists("msg"))
{
	$msg = file_get_contents("msg");
	unlink("msg");
	return "<h1 class=msg>$msg</h1>";
}
//	if ($love==1) $return .= "<img src=imgs/love.png class=love width=20 />";
//	<h2 class=album>$album</h2>";
}
function getDetails($url = NULL)
{
	if (!$url)
	{
		$arraySong = explode("|", file_get_contents("curSong"));
		$url = $arraySong[5];
	}
	$data = file_get_contents($url);
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
	return "We're playing this track because it features $data, and $ending.";
}
?>
