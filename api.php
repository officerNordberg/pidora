<?php
if (isset($_POST['control'])) 
{
	$control = $_POST['control'];
	if (is_numeric($control)) {
		file_put_contents("station", $control);
		$control = (file_exists("curSong")) ? "s$control\n" : "$control\n";
	}
	file_put_contents("ctl", "$control");
	if ($control == "n") file_put_contents("msg", "Skipped");
} 
?>
