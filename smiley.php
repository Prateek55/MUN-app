<?php

	for($i=0;$i<6;$i++){
		for($j=1;$j<=11;$j++){
			$val=11*$i+$j;
?>
	<img class="smiley" data-dismiss="modal"  title="<?php echo $val; ?>" style="width:7%" src="<?php echo 'smiley/Emoji Smiley-'.$val.'.png'  ?>">

<?php
		}
		echo "<br>";
	}

?>