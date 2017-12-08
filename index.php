<!DOCTYPE html>
<html>
<head>
	<title>IIT Guwahati Model United Nations</title>
	<link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/control.css">
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

	<script type="text/javascript">
		function autoRefresh_div()
		{
		  $("#timeline").load("show_timeline.php");
		  $("#gsl").load("show_gsl.php");
		}
	//setInterval('autoRefresh_div()', 2000);
	</script>
</head>
<body style="background-color:white">
	<div style="position:fixed;top:0px;height:3vh;background-color:#0077BE
	;width:100vw;right:0px;z-index:100"></div>
	<div id="header" style="box-shadow: 1px 1px 4px #888888;background-color:white;position:fixed;top:3vh;height:17vh;width:100vw;right:0px;z-index:100">
		<div class="row" style="">
			<div style="background-color:white;padding-left:21vw;">
					<span style="position:absolute;top:1vh;left:20vw"><h3 style=";line-height:1.3;font-family: 'Lato', sans-serif;font-weight:900" >IIT Guwahati <br>Model United Nations</h3></span>
					<div id="logo"style="position:absolute;top:1vh;left:10vw" class="	">
						<img style="margin-top:1.3vh"  src="images/logo.png">
					</div>
			</div>		
		</div>

	</div>
	<div style="position:relative;top:23vh;width:98vw" class="">
		<div  class="row" style="margin-left:0.5vw">
			<div class="col-lg-3" style="position:fixed;top:24vh" >
				<div class="panel" style="border-right:1px solid #eee; padding-right:4%">

					<div class="">
						<span style="position:relative;left:10%;"><h3 style="font-family: 'Lato', sans-serif;font-weight:700">General Speakers List</h3></span>	
						<hr><br>
						<div id="gsl" style="height:72vh;overflow:hidden">
							<div style="overflow:auto">
								<?php include 'show_gsl.php '; ?>
							</div>
							
						</div>

						
					</div>
				</div>
			</div>
			<div id="" style="position:relative;margin-left:25vw"class="col-lg-6">
				<div id="timeline" style="width:90%">
					<?php
						include 'show_timeline.php';

					?>
				</div>
				
			</div>
			<div class="col-lg-2" style="">

				<div class="panel" style="position:fixed;top:24vh;left:78%;border-left:1px solid #eee; padding-left:4%">
					<span style="position:relative;left:20%;"><h3 style="font-family: 'Lato', sans-serif;font-weight:700">Trending</h3></span>	
					<div style="height:72vh;">
						
					</div>

					
				</div>
				<!--<div class="panel" style="box-shadow: 1px 1px 4px #888888;background-color:white;height:10vh">
					<div class="panel-body">
						
					</div>
				</div>-->
			</div>
		</div>	
	</div>
	
</body>
</html>