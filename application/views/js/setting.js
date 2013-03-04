
(function() {

	$('#logout').click(function() {
		deleteState('member');
		window.location = window.location.origin + '/index.php/rest';
	});

	function logout() {
		deleteState('member');
		window.location = window.location.origin + '/index.php/rest';
	}
	
	function getCurrentLocationName(){
		var places=getPlace();
		var current_id=get_loc_id();
		for(var i=0;i<places.length;i++){
			if(places[i].id==current_id){
				return places[i].name;
			}
		}
		return false;
	}

	$('.page').live('pageshow', function() {
		console.log('show page');
		$('#logs_title').html('Logs of '+getCurrentLocationName());
		if(navigator.onLine){
			console.log('online');
			var msgHitory = getUserMsgHistory();
		}else{
			console.log('offline');
			var loc_msg_data = get_loc_msg();
			if(loc_msg_data)
				buildLocationMsgList(loc_msg_data);
		}


		
	});

	var listId = 'history-content';
	

	
	function convertTimeStamp(str){
		var a = str.split(/[^0-9]/)
                    //var mydate = Date.parse(value.last_location_timestamp);
        var date=new Date (a[0],a[1]-1,a[2],a[3],a[4],a[5] );
		//var date=new Date(timestamp);
		return date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate()+' '+date.getHours()+':'+date.getMinutes()+':'+date.getSeconds();
	}
	function buildLocationMsgList(data) {
		$('#history-list').empty();
		console.log(data);
		$.each(data, function(index, value) {
			var timestamp=value.timestamp;
			var location_name=value.location_name;
			var user_name = value.username;
			var content=value.content;
			var time=convertTimeStamp(timestamp);
		    var loc_info;
			if(value.email==getState('member').user){
			loc_info='\
		     <ul  data-role="listview" data-theme="d" data-divider-theme="d" class="ui-listview">\
				<li data-role="list-divider" role="heading" class="ui-li ui-li-divider ui-bar-d ui-li-has-count">\
					'+time+'<span class="ui-li-count ui-btn-up-c ui-btn-corner-all"></span>\
				</li>\
				<li  data-corners="false" data-shadow="false" data-iconshadow="true" data-wrapperels="div"  data-theme="d" class="ui-btn  ui-li ui-btn-up-d">\
					<div class="ui-btn-inner ui-li">\
						<div class="ui-btn-text">\
							<a href="#" class="ui-link-inherit">\
							<p class="ui-li-aside ui-li-desc">\
							</p> <h3 style="color:#A00000"class="ui-li-heading">'+user_name+'</h3>\
							<p class="ui-li-desc">\
							</p>\
							<p class="ui-li-desc">\
								'+ content +'\
							</p> </a>\
						</div><span class="ui-icon ui-icon-arrow-r ui-icon-shadow">&nbsp;</span>\
					</div>\
				</li>\
			</ul>';
			}else{
		    loc_info='\
		     <ul data-role="listview" data-theme="d" data-divider-theme="d" class="ui-listview">\
				<li data-role="list-divider" role="heading" class="ui-li ui-li-divider ui-bar-d ui-li-has-count">\
					'+time+'<span class="ui-li-count ui-btn-up-c ui-btn-corner-all"></span>\
				</li>\
				<li data-corners="false" data-shadow="false" data-iconshadow="true" data-wrapperels="div"  data-theme="d" class="ui-btn  ui-li ui-btn-up-d">\
					<div class="ui-btn-inner ui-li">\
						<div class="ui-btn-text">\
							<a href="#" class="ui-link-inherit">\
							<p class="ui-li-aside ui-li-desc">\
							</p> <h3 class="ui-li-heading">'+user_name+'</h3>\
							<p class="ui-li-desc">\
							</p>\
							<p class="ui-li-desc">\
								'+ content +'\
							</p> </a>\
						</div><span class="ui-icon ui-icon-arrow-r ui-icon-shadow">&nbsp;</span>\
					</div>\
				</li>\
			</ul>';
			}
			$('#history-list').append(loc_info);
		});
	} 

	function getUserMsgHistory() {
		var state = getState('member');

		if (!state) {
			logout();
		}
		var loc_id = window.get_loc_id();
		var email = state.user;
		var pw = state.pw;

		$.ajax({
			type : 'GET',
			url : urlConfig.location_msg+'/location_id/'+loc_id,
			headers : {
				'Authorization' : 'Basic ' + window.btoa(email + ':' + pw)
			},
			success : function(response) {
				//console.log(response);
				var result = jQuery.parseJSON(response);
				var data = result;
				set_loc_msg(data);
				buildLocationMsgList(data);

			},
			error : function(response) {
				console.log(response);
			}
		});
	}

})()