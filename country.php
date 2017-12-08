<?php
	include 'conn.php';
	$sql="SELECT * FROM user_data";
	$result=mysqli_query($conn,$sql);
	while ($extract=mysqli_fetch_array($result)) {
		echo "<option>".$extract["country"]."</option>";
	}

?>