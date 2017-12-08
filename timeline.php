<?php

	include 'conn.php';
	$sql="SELECT * FROM tweet ORDER BY time DESC";
	$result=mysqli_query($conn,$sql);
	while($extract=mysqli_fetch_array($result)){
		$id=$extract["id"];
	?>
		<div class="col-lg-12">
			<div class='panel panel-primary'>
				<div class="panel-heading">
					<?php echo $extract["country"];?>
					<button class="delete pull-right btn btn-default btn-sm" id="<?php echo $id ?>">Delete</button>
				</div>
				<div class="panel-body">
					
					<?php echo $extract["content"]; ?>
					<hr>
					
					<span class='pull-right'><?php echo $extract["time"]; ?></span>
					
				</div>
			</div>
		</div>
	<?php
	}


	include 'disconn.php';
	


?>