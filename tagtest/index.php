<!DOCTYPE html>
<html>
<head>
	<title></title>
	<!--<script type="../js/jquery-1.9.0.js"></script>-->
	<script type="text/javascript" src="http://ajax.googleapis.com/
ajax/libs/jquery/1.9.0/jquery.min.js"></script>
	<script type="bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<script>
		(function( cursorManager ) {

		    //From: http://www.w3.org/TR/html-markup/syntax.html#syntax-elements
		    var voidNodeTags = ['AREA', 'BASE', 'BR', 'COL', 'EMBED', 'HR', 'IMG', 'INPUT', 'KEYGEN', 'LINK', 'MENUITEM', 'META', 'PARAM', 'SOURCE', 'TRACK', 'WBR', 'BASEFONT', 'BGSOUND', 'FRAME', 'ISINDEX'];

		    //From: http://stackoverflow.com/questions/237104/array-containsobj-in-javascript
		    Array.prototype.contains = function(obj) {
		        var i = this.length;
		        while (i--) {
		            if (this[i] === obj) {
		                return true;
		            }
		        }
		        return false;
		    }

		    //Basic idea from: http://stackoverflow.com/questions/19790442/test-if-an-element-can-contain-text
		    function canContainText(node) {
		        if(node.nodeType == 1) { //is an element node
		            return !voidNodeTags.contains(node.nodeName);
		        } else { //is not an element node
		            return false;
		        }
		    };

		    function getLastChildElement(el){
		        var lc = el.lastChild;
		        while(lc && lc.nodeType != 1) {
		            if(lc.previousSibling)
		                lc = lc.previousSibling;
		            else
		                break;
		        }
		        return lc;
		    }



		    //Based on Nico Burns's answer
		    cursorManager.setEndOfContenteditable = function(contentEditableElement)
		    {

		        while(getLastChildElement(contentEditableElement) &&
		              canContainText(getLastChildElement(contentEditableElement))) {
		            contentEditableElement = getLastChildElement(contentEditableElement);
		        }

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

		}( window.cursorManager = window.cursorManager || {}));
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
			$("#content").live("keyup",function() 
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
				return false;
			});

			//Adding result name to content box.
			$(".addname").live("click",function() 
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

	</script>
	
	<style type="text/css">
		#container
		{
			margin:50px; padding:10px; width:460px
		}
		#content
		{
			width:458px; height:50px;
			border:solid 2px #333;
			font-family:Arial, Helvetica, sans-serif;
			font-size:14px;
			margin-bottom:6px;
			text-align:left;
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
	<div id="container">
		<div id="content" contenteditable="true">
		</div>
		<div id='display'>
		</div>
		<div id="msgbox">
		</div>
	</div>
</body>
</html>