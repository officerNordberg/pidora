<?php
if (isset($_GET['control'])) 
{
	$control = $_GET['control'];
	file_put_contents("ctl", "$control\n");
	if ($control == "n") file_put_contents("msg", "Skipped");
} 

//if (file_exists("msg"))
//{
//	$msg = file_get_contents("msg");
//	unlink("msg");
//	return "<h1 class=msg>$msg</h1>";
//}
//	if ($love==1) $return .= "<img src=imgs/love.png class=love width=20 />";
?>
