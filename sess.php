<?php
	session_start();
	$user="";
	$country="";
	function loggedin(){
		if (!empty($_SESSION["username"])) {
			$user=$_SESSION["username"];
			$country=$_SESSION["country"];
			return true;
		}
		else{
			$user="";
			$country="";
			return false;
		}
	}

?>