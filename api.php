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
		die("<h1 class=msg>$msg</h1>");
	
	}

//	if ($love==1) $return .= "<img src=imgs/love.png class=love width=20 />";
//	<h2 class=album>$album</h2>";
}
?>
