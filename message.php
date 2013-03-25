<?php
$message = "";
if (file_exists("msg")) {
	$message = file_get_contents("msg");
	unlink("msg");
}
$bottle = array(
"message" => $message);
echo json_encode($bottle);
die();
?>
