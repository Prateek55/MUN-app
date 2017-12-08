<?php

include 'sess.php';
if (loggedin()) {
	header("Location:index.php");
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</head>
<body>
<div class="row" style="margin-left:20px;margin-right:20px;margin-top:0px;background-color:#eeeeee;">
    <div class="col-xs-4"><a href="index.php" style="text-decoration:none"><h1 style="margin-left:20px;margin-top:5px;">UploadEx</h1></a></div>
     <!-- Trigger the modal with a button -->
	<div class="col-xs-4"></div>
	<div class="col-xs-4">
	  	

	</div>
	 
</div>

<div style="padding-top:10vh"class="container">
	<div class="row">
		<div class="col-lg-6" >
			 <div class="panel panel-primary">
		      <div class="panel-heading">Login</div>
		      <div class="panel-body">
		      	<form role="form" method="post">
					<div class="form-group">
					  <label for="usr">Name</label>
					  <input type="text" name="login_username" class="form-control" id="login_username">
					</div>
					<div class="form-group">
					  <label for="pwd">Password</label>
					  <input type="password" name="login_password" class="form-control" id="login_password">
					</div>
					<button type="submit" name="login" class="btn btn-default">Login</button>
					<div name="login_error" id="login_error"><br>
						<?php
							if(isset($_POST["login"])){
								require 'conn.php';

								if(!empty($_POST['login_username']) && !empty($_POST['login_password'])) {
									$username=$_POST['login_username'];
									$password=$_POST['login_password'];

									$sql1="SELECT * FROM login WHERE username='".$username."' AND password='".$password."'";
									$result1=mysqli_query($conn,$sql1);
									$numrows=mysqli_num_rows($result1);
									if($numrows!=0)
									{
										while($row=mysqli_fetch_assoc($result1))
										{
											$dbusername=$row['username'];
											$dbpassword=$row['password'];
											$dbcountry=$row['country'];
											
										}

										if($username == $dbusername && $password == $dbpassword)
										{
											session_start();
											$_SESSION['username']=$dbusername;
											$_SESSION['country']=$dbcountry;
										
											
											//$_SESSION['sess_id'] = $member['id'];
									
											
									
									/* Redirect browser */
											header("Location: index.php");
										}
									} else {
									
									echo "<b>Invalid username or password!</b>";
									}

								} else {
									echo "<b>All fields are required!</b>";
								}
								require 'disconn.php';
							}

						?>
					</div>
				</form>
		      </div>
		    </div>
				
		</div>
		

	</div>

</div>
</body>
</html>  

