<!-- Other Profile -->
		<div data-role="page" id="page8">
		     <div id='profile_header' data-theme="a" data-role="header">
        <h3 id='other_profile_title'>Dear Friend</h3>
    </div>
    <div data-role="content" class="middlecontent ceil-text">
    	<div class="photo-area">
    		<fieldset class="ui-grid-a">
			<div class="ui-block-a"><img id="other_profile" class="my_photo" width="100" height="100" src=""></div>
			<div class="ui-block-d"><!--<button id="change_photo" data-inline="true" data-theme="e">Change</button>-->
    		<div>
                <a id='follow_btn'data-theme='b' style="float:right" data-iconpos="right" data-role='button' data-inline="true">Follow</a>
                <a id='chat_btn' data-theme='b' style="float:right" data-iconpos="right" data-role='button' data-inline="true">Chat</a>
            </div>
            </div>	   
			</fieldset>
    		
    		
    	</div>
    	<div class="info-area">
    		<ul id="info" data-role="listview" data-inset="true">
    			<li data-icon="false"><a href='#' class="single-line" data-transition="slide" data-direction="reverse"  data-theme="" data-icon="arrow-r">
    				<div class="hidden" id="other_profile_email"></div>
                    <div class="single-line-left">Name</div>
    				<div class="single-line-right" id='other_profile_name'></div>
    			</a></li>
    			<li data-icon="false"><a href='#'>
    				<div>Last Location</div>
    				<div id="other_profile_last_location"></div>
    			</a></li><a href='#'>
    			<li data-icon="false">
    				<div>Status</div>
    				<div id="other_profile_status"></div>
    			</a></li>
    		</ul>
    		<br/>
    		<ul id='info' data-role="listview" data-inset="true" data-divider-theme="a" >
    			<li data-role="list-divider">Basic Info</li>
    			<li data-icon="false"><a class="single-line" href='#'>
    				<div class="single-line-left">Gender</div>
    				<div class="single-line-right" id="other_profile_gender"></div>
    			</a></li>
    			<li data-icon="false"><a href='#'>
                    <div>Faculty</div>
                    <div id="other_profile_faculty"> </div>
                </a></li>
                <li data-icon="false"> <a href='#'>
                    <div>Major</div>
                    <div id="other_profile_major"> </div>
                </a></li>   	        		
    			<li data-icon="false"><a href='#'> 
    				<div>Hobbies</div>
    				<div id="other_profile_hobbies"></div>
    			</a></li>
    			
    		</ul>

            

        </div>
    </div>
    <div data-role="footer">
	    <div data-role="navbar" data-iconpos="left" data-theme="a">
	        <ul>
	            <li>
	                <a href="#page1" data-transition="slide" data-direction="reverse"  data-theme="" data-icon="home">
	                    Nearby
	                </a>
	            </li>
	            <li>
	                <a href="#page5" data-transition="slide" data-direction="reverse"  data-theme="" data-icon="plus">
	                    Friends
	                </a>
	            </li>
	            <li>
	                <a href="#page6" data-direction="reverse"  data-theme="" data-icon="info">
	                    Profile
	                </a>
	            </li>
	            <li>
	                <a href="#page7" data-transition="slide" data-theme="" data-icon="gear">
	                    Logs
	                </a>
	            </li>
	        </ul>
	    </div>
	</div>
</div>

