<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		label.filebutton {
		    width:120px;
		    height:40px;
		    overflow:hidden;
		    position:relative;
		    
		}

		label span input {
		    z-index: 999;
		    line-height: 0;
		    font-size: 50px;
		    position: absolute;
		    top: -2px;
		    left: -700px;
		    opacity: 0;
		    filter: alpha(opacity = 0);
		    -ms-filter: "alpha(opacity=0)";
		    cursor: pointer;
		    _cursor: hand;
		    margin: 0;
		    padding:0;
		}

	</style>
</head>
<body>
<label class="filebutton">
<img src="icon.png">
<span><input type="file" id="myfile" name="myfile"></span>
</label>
</body>
</html>