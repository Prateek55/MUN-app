<?php

	include 'conn.php';
	$sql="SELECT * FROM tweet ORDER BY time DESC";
	$result=mysqli_query($conn,$sql);

	while($extract=mysqli_fetch_array($result)){
		$id=$extract["id"];
	?>
		
			<div class='panel panel-default' style="box-shadow: 1px 1px 4px #888888;">
				<!--<div class="panel-heading" style="background-color:#2f7ec3">	
					
				</div>-->
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-2">
							<img class="img-rounded" style="float:left;width:70%" src="flags/<?php echo $extract["country"]; ?>.gif">
						</div>
						<div class="col-lg-10" style="position:relative;left:-3%">
							<div class="row">
									
								<div style="">
									<h4 style="margin-top: 10px;font-family: 'Lato', sans-serif;font-weight:700"><?php echo $extract["country"]; ?></h4>									
								</div>
									
							</div>
							
							<div class="row" style="font-family: 'Lato', sans-serif;margin-left:0.75%;font-size:15px">
								<?php echo $extract["content"]; ?>
								
							</div>
						</div>
					</div>
						
					
					
					
					<!--<span class='pull-right'></span>-->
					
				</div>
			</div>
		
	<?php
	}


	include 'disconn.php';
	


?>