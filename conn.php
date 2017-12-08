<?php
	$ssid="root";
	$db_pass="";
	$server="localhost";
	$db="unga";

	$conn=mysqli_connect($server,$ssid,$db_pass,$db);
	if (!$conn) {
		die("Connection Failed");
	}
	

?>