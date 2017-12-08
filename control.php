
<!DOCTYPE html>
<html>
<head>
	<title>IIT Guwahati Model United Nations</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/control.css">
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript">
	$(function() {

	    var hashtags = false;

	    $(document).on('keydown', '#content', function (e) {        
	        arrow = {
	            hashtag: 51,
	            space: 32,
	            enter: 13
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
	            case arrow.enter:       
	                if(hashtags) {         
	                    e.preventDefault();
	                    input_field.html(input_field.html() + "</span>&nbsp<br><br>");    
	                    elem = document.getElementById('content');//This is the element that you want to move the caret to the end of
						setEndOfContenteditable(elem);
	                    hashtags = false;
	                }
	                break;
	        }

	    });

	});
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

	function publish(){

		var content=document.getElementById("content").innerHTML;
		var result=document.getElementById("reply");
		var publisher=document.getElementById('publisher').value;
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
		data.append('publisher',publisher);
		data.append('content',content);
		xmlhttp.open('POST', "send_tweet.php", true);
		xmlhttp.send(this.data);
		
		document.getElementById("content").innerHTML="";
		//alert(content);
	}

	function addSpeaker(){

		
		var result=document.getElementById("reply");
		var speaker=document.getElementById('speaker').value;
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
		data.append('speaker',speaker);
		xmlhttp.open('POST', "add_speaker.php", true);
		xmlhttp.send(this.data);
		
		
		//alert(content);
	}
	function trimList(){

		
		var result=document.getElementById("reply");
		xmlhttp=new XMLHttpRequest();
		data=new FormData();

		xmlhttp.onreadystatechange=function(){
			if (xmlhttp.readyState==4 && xmlhttp.status==200) {
				var reply=xmlhttp.responseText;
				console.debug(reply);
				result.innerHTML=reply;
			};

		}
		xmlhttp.open('GET', "trim.php", true);
		xmlhttp.send(this.data);
		
		
		//alert(content);
	}


	$(document).ready(function()
	{
		var start=/@/ig; // @ Match
		var word=/@(\w+)/ig; //@abc Match
		var begin=false;
		
		$(document).on("click",".delete",function(){
			var id=$(this).attr('id');
			var result=document.getElementById("reply");
			var xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function(){
				if (xmlhttp.readyState==4 &&xmlhttp.status==200) {
					var reply=xmlhttp.responseText;
					result.innerHTML=reply;
				};

			}
			xmlhttp.open("POST","delete_tweet.php",true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send('id='+id);
			
		});
		$(document).on("click",".toggle-turn",function(){
			var id=$(this).attr('id');
			var result=document.getElementById("reply");
			var xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function(){
				if (xmlhttp.readyState==4 &&xmlhttp.status==200) {
					var reply=xmlhttp.responseText;
					result.innerHTML=reply;
				};

			}
			xmlhttp.open("POST","toggle.php",true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send('id='+id);
			
		});

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
					$("#msgbox").html("Mention the country..");
					//if @abc avalable
				};
				if(name)
				{
					begin=true;
					$.ajax({
						type: "POST",
						url: "tag_country.php", // Database name search 
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

		$(document).on("click",".smiley",function(){
			smile_num=$(this).attr('title');
			
			
			var input_field = $('#content');
			var smile="<img style='width:2%' src='smiley/Emoji Smiley-"+smile_num+".png'>";
			
			var val=input_field.html() +"<img style='width:7%' src='smiley/Emoji Smiley-"+smile_num+".png'>";
			input_field.html(input_field.html() +"<img style='width:4%' src='smiley/Emoji Smiley-"+smile_num+".png'>" );
			elem = document.getElementById('content');
			setEndOfContenteditable(elem);
		});


	});
	function test(){
		var publisher=document.getElementById('publisher').value;
		alert(publisher);
	}
	function autoRefresh_div()
	{
	  $("#timeline").load("timeline.php");
	  $("#gsl").load("gsl.php");
	}
	setInterval('autoRefresh_div()', 2000);
	</script>
</head>
<body>

<div class="row" style="margin-top:0px;background-color:#eeeeee;">
	<div class="col-xs-4"></div>
    <div class="col-xs-8"><a href="index.php" style="text-decoration:none"><h1 style="margin-left:20px;margin-top:5px;">IITG Model United Nations</h1></a></div>
 
</div>
<div class="container" style="margin-top:5vh">
	<div class="row">

		<div class="col-lg-5" id="gsl-wrapper">
			<div class="panel panel-primary">
				<div class="panel-heading">GSL Control</div>
				<div class="panel-body">
					<label>Country</label>
					<select id="speaker">
 						<option value="Select an option">Select an option</option>
 						<?php include 'country.php' ?>
					</select>
					<button class="btn btn-primary" onclick="addSpeaker()">Add Speaker</button>
				</div>
			</div>
			<div class="panel panel-primary">
				<div class="panel-heading">
					General Speakers List

				</div>
				<div class="panel-body">
					<ul id="gsl">
						<?php include 'gsl.php'; ?>
					</ul>
				</div>

			</div>
			<button class=" btn btn-primary" onclick="trimList();">Trim</button>
		</div>
		<div class="col-lg-7" id="tweet-wrapper">
			<div class="panel panel-primary">
				<div class="panel-heading">Tweeter Controls</div>
				<div class="panel-body">
					<label> Publisher</label>&nbsp&nbsp
					<select id="publisher">
 						<option value="Select an option">Secretariat</option>
 						<?php include 'country.php' ?>
					</select>
					<br><br>
					<div id="content" contenteditable>
						
					</div>
					<div id='display'>
					</div>
					<div id="msgbox">
					</div>
					<div id="reply"></div>
					<button class="btn btn-primary" onclick="publish();">Tweet</button>
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add Smiley</button>

					<!-- Modal -->
					<div id="myModal" class="modal fade" role="dialog">
					  <div class="modal-dialog">

					    <!-- Modal content-->
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal">&times;</button>
					        <h4 class="modal-title">Smileys</h4>
					      </div>
					      <div class="modal-body">
					      	<div class="col-lg-12">
					      		<?php include 'smiley.php'; ?>
					      	</div>
					        
					
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					      </div>
					    </div>

					  </div>
					</div>
					<!--Model Ends-->
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12"><h3>Tweets</h3></div>
				<div class="col-lg-12" >
					<div id="timeline" class="" style="padding:2vh">
						<?php include 'timeline.php'; ?>
					</div>

				</div>
			</div>

			
		</div>
	</div>
			
</div>

</body>
</html>