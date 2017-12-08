<?php
	include 'conn.php';
	$sql="SELECT * FROM gsl";

	$result=mysqli_query($conn,$sql);
	while($extract=mysqli_fetch_array($result))
	{
		$num=$extract["num"];
		$done=$extract["turn"];

?>
	<div class="">
		
			<img class="img-rounded" style="width:10%;float:left;margin-right:5%" src="flags/<?php echo $extract["country"];  ?>.gif">
			<div style="float:left" class="">
				<p style="font-size:18px;<?php if ($done) {
					echo 'text-decoration:line-through;color:#2f7ec3' ; 
				} ?>"><?php echo $extract["country"]; ?></p>
			</div>
				
		
	</div>

	
	<br>
	<hr>
<?php
	}

	include 'disconn.php';

?>