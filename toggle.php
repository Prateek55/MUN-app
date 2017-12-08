<?php
	include 'conn.php';
	$id=$_POST["id"];
	$turn=0;
	$turn_state=mysqli_query($conn,"SELECT * FROM gsl WHERE num='".$id."'");
	while ($ex=mysqli_fetch_array($turn_state)) {
		$turn=$ex["turn"];
	}
	$turn=($turn+1)%2;
	$sql = "UPDATE gsl SET turn='".$turn."' WHERE num='".$id."'";

	if (mysqli_query($conn, $sql)) {
	    echo "Record updated successfully";
	} else {
	    echo "Error updating record: " . mysqli_error($conn);
	}
	//echo $id;

?>