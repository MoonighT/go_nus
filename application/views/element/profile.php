
<div data-role="page" id="page6">
    <div id='profile_header' data-theme="a" data-role="header">
        
        <h3 id='profile_title'>Profile</h3>
        <a id="logout" data-role="button" class="ui-btn-right" style="width:70px"> Logout </a>

    </div>
    <div data-role="content" class="middlecontent ceil-text">
    	<div class="photo-area">
    		<img id="profile_pic" height="100" width="100" class="my_photo"  src="">
    		<!--<button id="change_photo" data-inline="true" data-theme="e">Change</button>-->
    	</div>
    	<div class="info-area">
    		<ul id="info"  data-role="listview" data-inset="true">
    			<li data-icon="false" ><a href='#page10' class="edit single-line"  data-transition="slide" data-theme="">
    				<div class="single-line-left">Name</div>
    				<div class="single-line-right" id='self_profile_name'></div>
    			</a></li>
    			<li data-icon="false"><a>
    				<div>Last Location</div>
    				<div id="profile_last_location"></div>
    			</a></li>
    			<li data-icon="false"><a href='#page10' class='edit'>
    				<div>Status</div>
    				<div id="profile_status"></div>
    			</a></li>
    		</ul>
    		<br/>
    		<ul id='info' data-role="listview" data-inset="true" data-divider-theme="a" >
    			<li data-role="list-divider">Basic Info</li>
    			<li data-icon="false"><a class="single-line" >
    				<div class="single-line-left">Gender</div>
    				<div class="single-line-right" id="profile_gender"></div>
    			</a></li>
    			<li data-icon="false"><a href='#page10' class='edit'>
    				<div>Faculty</div>
    				<div id="profile_faculty"></div>
    			</a></li>
                <li data-icon="false"><a href='#page10' class='edit'>
                    <div>Major</div>
                    <div id="profile_major"></div>
                </a></li>	        		
    			<li data-icon="false"><a href='#page10' class='edit'> 
    				<div>Hobbies</div>
    				<div id="profile_hobbies"></div>
    			</a></li>
    			
    		</ul>
        </div>
    </div>
    <div data-role="footer">
	    <div data-role="navbar" data-iconpos="left" data-theme="a">
	        <ul>
	            <li>
	                <a href="#page1" data-transition="slide" data-direction="reverse"  data-theme="" data-icon="home">
	                    <div class="linktohome">Nearby</div>
	                </a>
	            </li>
	            <li>
	                <a href="#page5" data-transition="slide" data-direction="reverse"  data-theme="" data-icon="plus">
	                      <div class="linktofriends">Friends</div> 
	                </a>
	            </li>
	            <li>
	                <a data-theme="b" data-icon="info">
	                    <div class="linktoprofile">Profile</div>
	                </a>
	            </li>
	            <li>
	                <a href="#page7" data-transition="slide" data-theme="" data-icon="gear">
	                     <div class="linktologs">Logs</div>
	                </a>
	            </li>
	        </ul>
	    </div>
	</div>
</div>

