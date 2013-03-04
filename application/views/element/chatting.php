<div data-role="page" id="page4" height="350px">
	<div data-theme="a" data-role="header">
		<a data-role="button" data-transition="fade" href="#" class="ui-btn-left" onClick="showDiv()" id="showPeopleBtn"> People </a>
		<a data-role="button" data-transition="fade" href="#" class="ui-btn-left" onClick="hideDiv()" id="hidePeopleBtn" style="visibility: hidden;"> << Hide </a>
		<a data-role="button" data-transition="flip" href="#page1" onClick="switchToChat();" class="ui-btn-right" id="goToMap">
			Map
		</a>
		<h3 id="location_title"> Somewhere Near SoC </h3>
	</div>
	
	<div data-role="content" class="middlecontent">
	
	
	<div id="conversation">
	</div>
	<div>
	<input type="text" id="contentBox" style="max-height: 9%;height: 9%;overflow: auto"/>
	<img src="../application/views/images/spinner.gif" id="waitImg"/>
	<div id="sendBtn">
		<input id="chatBtn" type="button" value="Go" disabled="true" />
	</div>
	
	</div>
	</div>
	<div data-role="footer">
		<div data-role="navbar" data-iconpos="left" data-theme="a">
			<ul>
				<li >
					<a href="#page1" data-theme="" onClick="switchToChat();"  data-icon="home">
						<div class="linktohome">Nearby</div>
					</a>
				</li>
				<li>
					<a href="#page5" data-theme="" onClick="switchToChat();"  data-icon="plus">
						<div class="linktofriends">Friends</div>
					</a>
				</li>
				<li>
					<a href="#page6" data-theme="" onClick="switchToChat();" data-icon="info">
						<div class="linktoprofile">Profile</div>
					</a>
				</li>
				<li>
					<a href="#page7" data-theme="" onClick="switchToChat();" data-icon="gear">
						<div class="linktologs">Logs</div>
					</a>
				</li>
			</ul>
		</div>
	</div>
</div>