<!-- Friends -->

<style type="text/css">
	table {
		width: 100%;
	}
	td.left {
		width: 25%;
	}
	td.right {
		height: 100%;
	}
	td div#name {
		height: 33%;
		margin-bottom: 5px
	}

	td div#other {
		color: grey;
		height: 33%;
		margin-bottom: 5px;
	}

</style>

<div data-role="page" id="page5">
	<div data-theme="a" data-role="header">
		<h3> Friends </h3>
	</div>
	<div data-role="content" class="middlecontent">
		<ul id="friend-list" data-role="listview"  data-filter="true" data-inset="true" data-filter-placeholder="Search people..." > 
		</ul>

	</div>
	<div data-role="footer">
		<div data-role="navbar" data-iconpos="left" data-theme="a">
			<ul>
				<li>
					<a id='friends_nearby' href="#page1" data-transition="slide" data-direction="reverse"  data-theme="" data-icon="home"> <div class="linktohome">Nearby</div> </a>
				</li>
				<li>
					<a data-theme="b" data-icon="plus">   <div class="linktofriends">Friends</div> </a>
				</li>
				<li>
					<a href="#page6" data-transition="slide" data-theme="" data-icon="info"> 	<div class="linktoprofile">Profile</div> </a>
				</li>
				<li>
					<a href="#page7" data-transition="slide" data-theme="" data-icon="gear"> <div class="linktologs">Logs</div> </a>
				</li>
			</ul>
		</div>
	</div>
</div>