<?php
	$speaker=$_POST['speaker'];
	include 'conn.php';
	$result=mysqli_query($conn,"INSERT INTO gsl (country) VALUES ('".$speaker."')");
	if (!$result) {
		echo mysqli_error($conn);
	}else{
		echo "Speaker Added";
	}

	include 'disconn.php';
	//echo $speaker;


?>