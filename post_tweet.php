<?
	include "sess.php";
	if (!loggedin()) {
		die("Please login to continue");
	}

	include "conn.php";
	$tweet=$_POST["tweet"];
	$poster=$nation;

	date_default_timezone_set('Asia/Kolkata');
	$time=date("Y-m-d G:i:s");

	$sql_insert="INSERT INTO tweet (tweeter,tweet,time) VALUES ('".$nation."','".$tweet."','".$time."')";
	$result=mysqli_query($conn,$sql_insert);
	if ($result) {
		echo "Insertion Successful";
	}
	else{
		echo "Insertion Failed..".mysqli_error($conn);
	}

	include 'disconn.php';

?>