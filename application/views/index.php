<?php
$this -> load -> view('util.php');
?>
<!DOCTYPE html>
<html >
	<head>
		<meta charset="utf8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<link rel="apple-touch-icon" href="<?php echo VIEW_URL?>images/touch-icon-iphone.png" />
		<link rel="apple-touch-icon" sizes="72x72" href="<?php echo VIEW_URL?>images/touch-icon-ipad.png" />
		<link rel="apple-touch-icon" sizes="114x114" href="<?php echo VIEW_URL?>images/touch-icon-iphone4.png" />
			<link rel="apple-touch-startup-image" href="<?php echo VIEW_URL?>images/splash.png" >
		<?php
		$this -> load -> view('element/include_css.php');
		?>
		<script>
			var heightToSubtract;
			var pageWidth;
			var divShown;
			var chatScreen;
			window.onload = function() {
				divShown = 0;
				chatScreen = 0;
				heightToSubtract = $('#topbar').height() * 2;
				autoChangeDiv();
				pageWidth = $(window).width();
				
				// setup chat connection as soon as user open home page so that he dont have to wait later
				$('.middlecontent').animate({
					height : (window.innerHeight && navigator.platform == 'iPhone' ? window.innerHeight : $(window).height()) - heightToSubtract
				}, 1500);

				$('#map_container').animate({
					height : (window.innerHeight && navigator.platform == 'iPhone' ? window.innerHeight : $(window).height()) - heightToSubtract
				}, 1500).trigger('fixed');
				
			};
			window.addEventListener('orientationchange', handleOrientation, false);
			var supportsOrientationChange = "onorientationchange" in window, orientationEvent = supportsOrientationChange ? "orientationchange" : "resize";

			window.addEventListener(orientationEvent, function() {// for android
				
				
				$('.middlecontent').animate({
					height : $(window).height() - heightToSubtract
				}, 1500);
				$('#map_container').animate({
					height : $(window).height() - heightToSubtract
				}, 1500);autoChangeDiv();
			}, false);

			function handleOrientation() {// for ios
				
				$('.middlecontent').animate({
					height : (window.innerHeight && navigator.platform == 'iPhone' ? window.innerHeight : $(window).height()) - heightToSubtract
				}, 1500);
				$('#map_container').animate({
					height : (window.innerHeight && navigator.platform == 'iPhone' ? window.innerHeight : $(window).height()) - heightToSubtract
				}, 1500);
				autoChangeDiv();
			}

		 </script>

		<title>Hi NUS!</title>

		<!-- Google Analytics -->
		<script type="text/javascript">
			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', 'UA-35048646-1']);
			_gaq.push(['_trackPageview']);

			(function() {
				var ga = document.createElement('script');
				ga.type = 'text/javascript';
				ga.async = true;
				ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
				var s = document.getElementsByTagName('script')[0];
				s.parentNode.insertBefore(ga, s);
			})();

		</script>
	</head>
	<body>
		<!-- Home -->
		<div data-role="page" id="page1" class="page-map">

			<div data-theme="a" data-role="header" id="topbar">
				<button  data-mini="true" class="ui-btn-left" id="show_me" style="width:50px" >
					Find me
				</button>
				<h3 id="location_title"> Header </h3>
				<a data-role="button" data-theme='c' data-transition="flip" href="#page4" onClick="switchToChat();" class="ui-btn-right"> Chat </a>
			</div>
			<div data-role="content" class="middlecontent">
				<div id="map_container" data-role="content" style="height:600px">
					<span id="status">Loading...</span>
				</div>
			</div>
			<div data-role="footer">
				<div data-role="navbar" data-iconpos="left" data-theme="a">
					<ul>
						<li>
							<a data-icon="home" data-theme="b"> 	<div class="linktohome">Nearby</div>  </a>
						</li>
						<li>
							<a data-transition="slide" href="#page5" data-theme="" data-icon="plus"> 	<div class="linktofriends">Friends</div> </a>
						</li>
						<li>
							<a data-transition="slide" href="#page6" data-theme="" data-icon="info"> <div class="linktoprofile">Profile</div> </a>
						</li>
						<li>
							<a data-transition="slide" href="#page7" data-theme="" data-icon="gear"> 	<div class="linktologs">Logs</div> </a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div pub-key="pub-0d10a610-c98a-49d8-afd4-8a5f2d5974ab" sub-key="sub-22a06fee-fc1d-11e1-b851-adb3f4169f17" ssl="off" origin="pubsub.pubnub.com" id="pubnub"></div>
		<?php
		$this -> load -> view('element/include_php.php');
		$this -> load -> view('element/include_js.php');
		?>
		<script>
			$(window).resize(function() {
				autoChangeDiv();
					if($(window).width() < 400)
						shrinkFooter();
					else
						expandFooter();
				  
			});
			// $(window).bind('keypress', function(e) {
			// 	if (e.keyCode == 13) {

			// 		if ($('#contentBox').val().length > 0)
			// 			var curElement = document.activeElement;
			// 		if (curElement.nodeName == "INPUT")
			// 			$('#enterButton').trigger('click');
			// 	}
			// });
			$('#contentBox').focus(function() {
				hideDiv();
			});
		</script>
		
	</body>
</html>
