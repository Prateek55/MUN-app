<?php
	include "sess.php";
	if (!loggedin()) {
		die("Sorry you have been logged out. Please login to continue");
	}

	include "conn.php";
	$sql="SELECT * FROM tweet ORDER BY DESC";
	$result=mysqli_query($conn,$sql);
	if (mysqli_num_rows($result)) {
		echo "No tweets to show";
	}
	else{
		while ($extract=mysqli_fetch_array($result)) {
			/*echo $extract["tweeter"];
			echo "<br>";
			echo $extract["tweet"]."<br><br>";*/
			?>
			<div class='panel panel-default'>
				<div class="panel-body">
					<b><?php echo $extract["tweeter"] ;?></b><br>
					<?php echo $extract["tweet"]; ?>
					<span class='pull-right'><?php echo $extract["time"]; ?></span>
					<hr>
				</div>
			</div>
<?php

		}
	}

	include "disconn.php";



?>
