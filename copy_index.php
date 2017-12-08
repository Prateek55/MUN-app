<?php
include 'sess.php';
if (!loggedin()) {
	header("Location:login.php");
}
echo $_SESSION["username"];
?>

<!DOCTYPE html>
<html>
<head>
<title>IITG Model United Nation</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/index.css">
<link href="style/style.css" rel="stylesheet" type="text/css" />
<!--<script type="text/javascript" src="http://ajax.googleapis.com/
ajax/libs/jquery/1.4.0/jquery.min.js"></script>-->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript">
	function startUpload(){
	      /*document.getElementById('f1_upload_process').style.visibility = 'visible';
	      document.getElementById('f1_upload_form').style.visibility = 'hidden';*/
	      return true;
	}

	function stopUpload(success,filename,filetype){
	      var result = '';
	      if (success == 1){
	         result = '<span class="msg">The file was uploaded successfully!<\/span><br/><br/>';
	      }
	      else {
	         result = '<span class="emsg">There was an error during file upload!<\/span><br/><br/>';
	      }
	     // document.getElementById('f1_upload_process').style.visibility = 'hidden';
	      var form1=document.getElementById('f1_upload_form')
	      var form_content=form1.innerHTML;
	      form1.innerHTML= result + form_content;//'<label>File: <input name="myfile" type="file" size="30" /><\/label><label><input type="submit" name="submitBtn" class="sbtn" value="Upload" /><\/label>';
	      //document.getElementById('f1_upload_form').style.visibility = 'visible';
	      document.getElementById('content').innerHTML+="<img style='max-width:40%;max-height:35vh' src='files/"+filename+"."+filetype+"' /><br><br>";
	      elem = document.getElementById('content');//This is the element that you want to move the caret to the end of
		  setEndOfContenteditable(elem);      
	      return true;   
	}
  	function autoRefresh_div()
	{
	  $("#timeline").load("timeline.php");// a function which will load data from other file after x seconds
	}
	function setEndOfContenteditable(contentEditableElement)
	{
	    var range,selection;
	    if(document.createRange)//Firefox, Chrome, Opera, Safari, IE 9+
	    {
	        range = document.createRange();//Create a range (a range is a like the selection but invisible)
	        range.selectNodeContents(contentEditableElement);//Select the entire contents of the element with the range
	        range.collapse(false);//collapse the range to the end point. false means collapse to end rather than the start
	        selection = window.getSelection();//get the selection object (allows you to change selection)
	        selection.removeAllRanges();//remove any selections already made
	        selection.addRange(range);//make the range you have just created the visible selection
	    }
	    else if(document.selection)//IE 8 and lower
	    { 
	        range = document.body.createTextRange();//Create a range (a range is a like the selection but invisible)
	        range.moveToElementText(contentEditableElement);//Select the entire contents of the element with the range
	        range.collapse(false);//collapse the range to the end point. false means collapse to end rather than the start
	        range.select();//Select the range (make it the visible selection
	    }
	}
	
	$(document).ready(function()
	{
		var start=/@/ig; // @ Match
		var word=/@(\w+)/ig; //@abc Match
		var begin=false;
		
		$(document).on("keyup","#content",function() 
		{
			var content=$(this).text(); //Content Box Data
			var go= content.match(start); //Content Matching @
			var name= content.match(word); //Content Matching @abc
			var dataString = 'searchword='+ name;
			
			//If @ available
			if(go)
			{
				if (!begin) {
					$("#msgbox").slideDown('show');
					$("#display").slideUp('show');
					$("#msgbox").html("Type the name of someone or something...");
					//if @abc avalable
				};
				if(name)
				{
					begin=true;
					$.ajax({
						type: "POST",
						url: "boxsearch.php", // Database name search 
						data: dataString,
						cache: false,
						success: function(data)
						{
							$("#msgbox").hide();
							$("#display").html(data).show();
						}
					});
				}
			}
			else{
				$("#display").hide();
				$("#msgbox").hide();
			}
			return false;
		});
		function sendFile(file) {
		  $.ajax({
		    type: 'post',
		    url: 'upload_pic.php?picture=' + file.name,
		    data: file,
		    success: function (data) {
		      $('#reply').html(data);
		    },
		    xhrFields: {
		      // add listener to XMLHTTPRequest object directly for progress (jquery doesn't have this yet)
		      onprogress: function (progress) {
		        // calculate upload progress
		        var percentage = Math.floor((progress.total) * 100);
		        // log upload progress to console
		        console.log('progress', percentage);
		        if (percentage === 100) {
		          console.log('DONE!');
		        }
		      }
		    },
		    processData: false,
		    contentType: file.type
		  });
		}

		//Adding result name to content box.
		$(document).on("click",".addname",function() 
		{
			var username=$(this).attr('title');
			var old=$("#content").html();
			var content=old.replace(word," "); //replacing @abc to (" ") space
			$("#content").html(content);
			var E="<a class='red' contenteditable='false' href='#' >"+username+"</a>&nbsp";
			$("#content").append(E);
			$("#display").hide();
			$("#msgbox").hide();
			elem = document.getElementById('content');//This is the element that you want to move the caret to the end of
			setEndOfContenteditable(elem);
		});
	});

 
    setInterval('autoRefresh_div()', 2000);
  	function sendTweet(){

		var content=document.getElementById("content").innerHTML;
		var result=document.getElementById("reply");
		//test.innerHTML="Sending...";
		xmlhttp=new XMLHttpRequest();
		data=new FormData();

		xmlhttp.onreadystatechange=function(){
			if (xmlhttp.readyState==4 && xmlhttp.status==200) {
				var reply=xmlhttp.responseText;
				console.debug(reply);
				result.innerHTML=reply;
			};

		}
		
		data.append('content',content);
		xmlhttp.open('POST', "send_tweet.php", true);
		xmlhttp.send(this.data);
		
		document.getElementById("content").innerHTML="";
		//alert(content);
	}
	var hashTagList = [];

	/*function logHashList(){
	    hashTagList = [];
	    $('.highlight').each(function(){
	        hashTagList.push(this.innerHTML);
	    });
	    for(var i=0;i&lt;hashTagList.length;i++){
	        alert(hashTagList[i]);
	    }
	    if(hashTagList.length==0){
	        alert('You have not typed any hashtags');
	    }
	}*/
	$(function() {

	    var hashtags = false;

	    $(document).on('keydown', '#content', function (e) {        
	        arrow = {
	            hashtag: 51,
	            space: 32
	        };

	        var input_field = $(this);
	        switch (e.which) {
	            case arrow.hashtag:
	                e.preventDefault();
	                input_field.html(input_field.html() + "<span class='highlight'>#");
	                elem = document.getElementById('content');//This is the element that you want to move the caret to the end of
					setEndOfContenteditable(elem);
	                hashtags = true;
	                break;
	            case arrow.space:       
	                if(hashtags) {         
	                    e.preventDefault();
	                    input_field.html(input_field.html() + "</span>&nbsp;");    
	                    elem = document.getElementById('content');//This is the element that you want to move the caret to the end of
						setEndOfContenteditable(elem);
	                    hashtags = false;
	                }
	                break;
	        }

	    });

	});


	function placeCaretAtEnd(el) {
	    el.focus();
	    if (typeof window.getSelection != "undefined" && typeof document.createRange != "undefined") {
	        var range = document.createRange();
	        range.selectNodeContents(el);
	        range.collapse(false);
	        var sel = window.getSelection();
	        sel.removeAllRanges();
	        sel.addRange(range);
	    } else if (typeof document.body.createTextRange != "undefined") {
	        var textRange = document.body.createTextRange();
	        textRange.moveToElementText(el);
	        textRange.collapse(false);
	        textRange.select();
	    }
	}
</script>
<style type="text/css">
	.highlight{
		color: red;
		text-decoration: underline;
	}
	#content
	{
	}
	#msgbox
	{
		border:solid 1px #dedede;padding:5px;
		display:none;background-color:#f2f2f2
	}
	#display
	{
		display:none;
		border-left:solid 1px #dedede;
		border-right:solid 1px #dedede;
		border-bottom:solid 1px #dedede;
		overflow:hidden;
	}
	.display_box
	{
		padding:4px; border-top:solid 1px #dedede; font-size:12px; height:30px;
	}
	.display_box:hover
	{
		background:#3b5998;
		color:#FFFFFF;
	}
	.image
	{
		width:25px; float:left; margin-right:6px
	}
</style>

</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-lg-4">
				<?php include 'gsl.php' ;?>
			</div>
			<div class="col-lg-8">
				<div class="content_wrapper"><div id="content" contenteditable></div></div>
				
				<form action="upload.php" method="post" enctype="multipart/form-data" target="upload_target" onsubmit="startUpload();" >
	     			
	                 <p id="f1_upload_form" style="vertical-align:middle" >
	                 	<button style="vertical-align:middle"type="button" name="tweet" onclick="sendTweet()">Tweet</button>
	                     <label style="">
                     		<img style="width:40px"src="icon.png">  
	                        <span><input id="pic" accept="image/*" name="myfile" type="file" size="30" onchange="this.form.submit()" /></span>
	                     </label>
	                 </p>
	                 
	                 <iframe id="upload_target" name="upload_target" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe>
	             </form>
				<!--<label class="filebutton">
					<img style="width:5%"src="icon.png">
					<span><input type="file" id="pic" accept="image/*" name="myfile"></span>
				</label>-->
				<div id='display'>
				</div>
				<div id="msgbox">
				</div>
				<div id="reply"></div>
				
				

				
				<div id="timeline">
				
				<?php include 'timeline.php'; ?>
				</div>
			</div>
		</div>
	</div>

</body>
</html>