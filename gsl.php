<?php
	include 'conn.php';
	$sql="SELECT * FROM gsl";

	$result=mysqli_query($conn,$sql);
	while($extract=mysqli_fetch_array($result))
	{
		$num=$extract["num"];
		$done=$extract["turn"];

?>
	<li>
		<label style="<?php if ($done) {
			echo 'text-decoration:line-through' ; 
		} ?>"><?php echo $extract["country"]; ?></label>
		<button id='<?php echo $num; ?>'class="toggle-turn pull-right btn">Toggle</button>
	</li><hr>
<?php
	}

	include 'disconn.php';

?>