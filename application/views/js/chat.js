(function(){

	$("#contentBox").keyup(function(){
		if($('#contentBox').val().length>0 )
			$('#chatBtn').button('enable');
		else
			$('#chatBtn').button('disable');
	});
	
})();

var smallScreenLeftDiv = 0;
function hideAllForSmallScreen()
{
			$('#slideOutDiv').animate({
				height : $(window).height() - heightToSubtract/2
			}, 'slow');
			if(smallScreenLeftDiv == 0)
			{
			$('#slideOutDiv').animate({
				width : 250
			}, 'slow');
			//$('#hidePeopleBtn').html('<< Hide')
			$('#hidePeopleBtn').animate({
				'left' : '-=50px'
			}, 'slow');
			$('#showPeopleBtn').hide();
			$('#hidePeopleBtn').show();
			$('#hidePeopleBtn').css({
				'visibility' : 'visible'
			});
			$('#hidePeopleBtn').animate({
				'left' : '+=300px'
			}, 'slow');
			$('#slideOutDiv').animate({
				'left' : '+=500px'
			}, 'slow');
			$('#contentBox').css({
				'visibility' : 'collapse'
			});;
			/*$('#chatTable').css({
				'visibility' : 'collapse'
			});;*/
			$('#goToMap').css({
				'visibility' : 'collapse'
			});;
			$('#enterButton').css({
				'visibility' : 'collapse'
			});;
			$('#sendBtn').css({
				'visibility' : 'collapse'
			});;
			
			}
			
}
function showAllForSmallScreen()
{
			if(smallScreenLeftDiv == 1)
			{
			$('#slideOutDiv').animate({
				width : 300
			}, 'slow');
			//$('#hidePeopleBtn').prop('value', 'Hide People')
			$('#hidePeopleBtn').animate({
				'left' : '+=50px'
			}, 'slow');
			$('#showPeopleBtn').fadeIn(3000);
			$('#hidePeopleBtn').hide();
			$('#hidePeopleBtn').css({
				'visibility' : 'collapse'
			});
			$('#hidePeopleBtn').animate({
				'left' : '-=300px'
			}, 'slow');
			$('#slideOutDiv').animate({
				'left' : '-=500px'
			}, 'slow');
			$('#contentBox').css({
				'visibility' : 'visible'
			});;
			/*$('#chatTable').css({
				'visibility' : 'visible'
			});;*/
			$('#goToMap').css({
				'visibility' : 'visible'
			});;
			$('#enterButton').css({
				'visibility' : 'visible'
			});;
			$('#sendBtn').css({
				'visibility' : 'visible'
			});;
		
			}
}
function showDiv() {
	if (divShown == 0) {
		if(!(navigator.platform == 'Win32' || navigator.platform == 'MacIntel' || navigator.platform == 'iPad'))
		{
			// this means not computer or ipad - so screen too small
			hideAllForSmallScreen();
			smallScreenLeftDiv = 1;
		}
		else
		{
			$('#showPeopleBtn').hide();
			$('#hidePeopleBtn').show();
			$('#hidePeopleBtn').css({
				'visibility' : 'visible'
			});
			$('#hidePeopleBtn').animate({
				'left' : '+=300px'
			}, 'slow');
			$('#conversation').animate({
				'left' : '+=300px'
			}, 'slow');
			$('#slideOutDiv').animate({
				'left' : '+=500px'
			}, 'slow');
			$('#contentBox').animate({
				'left' : '+=300px',
				width: $(window).width()*.8 - 300
			},'slow');
			/*$('#msgRcv').animate({
				width :  $(window).width() - 300
			}, 'slow');
			
			$('#chatTable').animate({
				'left' : '+=300px',
				width :  $(window).width() - 300
			},'slow');*/
			$('#sendBtn').animate({
				width: $(window).width()*.2
			},'slow');
		}
	}
	divShown = 1;
	addPeopleToList(window.get_near_peope());
}

function hideDiv() {
	if (divShown == 1) {
		
		if(!(navigator.platform == 'Win32' || navigator.platform == 'MacIntel' || navigator.platform == 'iPad'))
		{
			// this means not computer or ipad - so screen too small
			showAllForSmallScreen();
			smallScreenLeftDiv = 0;
		}
		else
		{
			$('#slideOutDiv').animate({
				'left' : '-=500px'
			}, 'slow');
			$('#hidePeopleBtn').animate({
				'left' : '-=300px'
			}, 'slow', function() {
				$('#hidePeopleBtn').hide();
				$('#showPeopleBtn').show();
			});
			$('#conversation').animate({
				'left' : '-=300px'
			}, 'slow');
			$('#contentBox').animate({
				'left' : '-=300px',
				width: $(window).width()*.8
			},'slow');
			/*$('#msgRcv').animate({
				width :  $(window).width()
			}, 'slow');
			$('#chatTable').animate({
				'left' : '-=300px',
				width :  $(window).width()
			}, 'slow');*/
			$('#sendBtn').animate({
				width: $(window).width()*.2
			},'slow');
		}
	}
	divShown = 0;

}
function switchToChat() {

	if(chatScreen == 0)
	{
		chatScreen = 1;
		autoChangeDiv();
	}
	else if(chatScreen == 1)
	{
		chatScreen = 0;
		hideDiv();
	}
		
}

function autoChangeDiv() {
		
		$('#contentBox').watermark('Type here and hit return to send!');
		if(heightToSubtract == 0)
		{
			heightToSubtract = 82;
			chatScreen = 1;
			divShown = 0;
		}
		if(chatScreen == 0)
		{
			return;
		}
		pageWidth = $(window).width();
		if (pageWidth > 900 && $(window).height() > 600) {
			if(navigator.platform == 'Win32' || navigator.platform == 'MacIntel')
				if(smallScreenLeftDiv == 1)
				showDiv();
		} else {
			if(smallScreenLeftDiv == 0)
			hideDiv();
		}
		$('#contentBox').animate({
			width: $(window).width()*.8 - (divShown * 300)
		},'slow');
		$('#slideOutDiv').animate({
				height : $(window).height() - heightToSubtract/2
			}, 'slow');
		$('#contentBox').animate({
			'bottom' : heightToSubtract/2,
		}, 'slow');
		$('#sendBtn').animate({
			'bottom' : heightToSubtract/2,
			
		}, 'slow');
		$('#waitImg').animate({
			'bottom' : heightToSubtract/2,
			'right': $(window).width()*.22,
		}, 'slow');
	
	  
		$('#conversation').animate({
				height : $(window).height() - (heightToSubtract * 2)
			}, 'slow');
	  $('#sendBtn').animate({
				width: $(window).width()*.2
			},'slow');
	
	
	
}
function makeNameBold(str)
{
	var n=str.split(" ");
	var i;
	for(i = 0; n[i].indexOf(":") == -1; i++)
		n[i] = "<b>" + n[i] + "</b>";
	n[i] = "<b>" + n[i] + "</b>";
	var str1 = "";
	for(i = 0; i < n.length; i++)
	{
		str1 += (n[i] + " ");
	}
	return str1;
}
function removeName(str)
{
	var n=str.split(" ");
	var i;
	for(i = 0; n[i].indexOf(":") == -1; i++)
		n[i] = "";
	n[i] = "";
	var str1 = "";
	for(i = 0; i < n.length; i++)
	{
		str1 += (n[i] + " ");
	}
	return str1;
}
function gotMessage(msg)
{
	  
	msg = msg.replace(/\<|\>|\"|\'|\%|\;|\(|\)|\&|\+|\-/g,""); 
	if($(window).width()*.3 < 250) // for smaller screens
	{
		$('.sendMsg').css('max-width',$(window).width()*.3);
		$('.recvMsg').css('max-width',$(window).width()*.3);
	}  
	 
	if(msg == $('#self_profile_name').html() + ': ' + $('#contentBox').val())
		appendSend("<b>You: </b>" + removeName(msg));
	else
		appendRecv(makeNameBold(msg));
	endSending();
}
function getTime()
{

	var d = new Date();
	//var day = d.getdate(); // day of month
	//var year = d.getFullYear(); // year - 4 digits
	//var hours = d.getHours(); // hour 0 - 23
	//var min = d.getMinutes(); // minutes 0 - 59
	//var sec = d.getSeconds(); // sec 0 - 59
	
	//var fulltime = "";
	//fulltime += (hours + minutes + ',' + day + '/' + month);
	//var fulltime = d;
	var temp = ""
	temp += d;
	var fulltime=temp.split(" ");
	var day = fulltime[0];// day is 1st
	var time = fulltime[4];// time is 4th
	return day + ", " + time;
}
function appendRecv(msg)
{
		//$('#msgRcv').append('<div class="recvMsg">'+msg+'</div><br>');
		msg = ("<div class='timeStyle'><i>Recd At: </i>" + getTime() + "</div><br>") + msg;
		$('#conversation').append('<div class="recvMsg">'+msg+'</div>');
		//$('#conversation').append('<br><br><br><br>');
		for(var i = 0; i < msg.length/60; i++)
			$('#conversation').append('<br>');
		
		$("#conversation").scrollTop($("#conversation").prop("scrollHeight"));
		
}
function appendSend(msg)
{
	
	$('#contentBox').val('');
	msg = ("<div class='timeStyle'><i>Sent At: </i>" + getTime() + "</div>") + msg;
	//$('#msgRcv').append('<div class="sendMsg">'+msg+'</div><br><br><br>');
	$('#conversation').append('<div class="sendMsg">'+msg+'</div>');
	$('#conversation').append('<br><br><br><br>');
	for(var i = 0; i < msg.length/60; i++)
		$('#conversation').append('<br>');
	endSending();
	$("#conversation").scrollTop($("#conversation").prop("scrollHeight"));
}

function startSending()
{
	$('#enterButton').button('disable');
	$('#contentBox').attr('disabled',true);
	$('#waitImg').css('visibility', 'visible');
}
function endSending()
{
		$('#enterButton').button('enable');
		$("#contentBox").removeAttr('disabled');
		$('#waitImg').css('visibility', 'collapse');
}

