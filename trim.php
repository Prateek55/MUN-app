<?php
	include 'conn.php';
	$result1=mysqli_query($conn,"SELECT * FROM gsl");
	while($ex=mysqli_fetch_array($result1)){
		$last=$ex["num"];
	}
	//echo $last;
	$sql = "DELETE FROM gsl WHERE num='".$last."'";

	if (mysqli_query($conn, $sql)) {
	    echo "Record deleted successfully";
	} else {
	    echo "Error deleting record: " . mysqli_error($conn);
	}

	include 'disconn.php';
?>