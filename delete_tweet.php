<?php
	$id=$_POST['id'];
	require 'conn.php';

	$sql = "DELETE FROM tweet WHERE id='".$id."'";
	if (mysqli_query($conn, $sql)) {
	    echo "Record deleted successfully";
	} else {
	    echo "Error deleting record: " . mysqli_error($conn);
}

	include 'disconn.php';
	echo $id;
?>