<?php
   // Edit upload location here
   $destination_path = "files/";

   $result = 0;
   $filehash=md5(microtime());
   $filename=$_FILES["myfile"]["name"];
   $filetype = pathinfo($filename,PATHINFO_EXTENSION);

   $target_path = $destination_path.$filehash.'.'.$filetype;

   if(@move_uploaded_file($_FILES['myfile']['tmp_name'], $target_path)) {
      $result = 1;
   }
   
   sleep(1);
?>

<script language="javascript" type="text/javascript">window.top.window.stopUpload(<?php echo $result.',"'.$filehash.'","'.$filetype.'"'; ?>);</script>   
