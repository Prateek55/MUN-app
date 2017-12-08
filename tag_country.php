<?php
include('conn.php');
if($_POST)
{
	$q=$_POST['searchword'];
	$q=str_replace("@","",$q);
	$q=str_replace(" ","%",$q);
	$sql_res=mysqli_query($conn,"SELECT * FROM user_data where country like '%$q%' order by uid LIMIT 5");
while($row=mysqli_fetch_array($sql_res))
{
	$fname=$row['fname'];
	
	//$img=$row['img'];
	$country=$row['country'];
?>
<div class="display_box" >
<!--<img src="user_img/<?php echo $img; ?>" class="image" />-->
<a href="#" class='addname' title='<?php echo $country; ?>'>
<?php echo $country; ?>&nbsp; </a>
</div>
<?php
}
}
?>