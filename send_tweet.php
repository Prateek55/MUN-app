<?php

	$publisher=$_POST["publisher"];
	$content=$_POST["content"];
	$id=md5(microtime());
	//echo $content."<br>";//.$publisher.$id;

	date_default_timezone_set('Asia/Kolkata');
	$time=date("Y-m-d G:i:s");

	include 'conn.php';
	$sql="INSERT INTO tweet (id,content,country,time) VALUES ('$id','$content','$publisher','$time')";
	$result=mysqli_query($conn,$sql);
	if (!$result) {
		echo mysqli_error($conn);
	}
	else{
		echo "Insertion Sucess";
	}
	

	include 'disconn.php';

?>