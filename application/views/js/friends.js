(function() {

	window.getFollowed = function (){
		var friends_info = '';
		$.ajax({
			type : 'GET',
			url : urlConfig.follow,
			headers : {
				'Authorization' : 'Basic ' + window.btoa( getState('member').user + ':' + getState('member').pw )
			},
			success : function(data) {
				var data = jQuery.parseJSON(data);
				$.each(data, function(index, value) {
					var email = value.user_followed;
					var hashed = md5(email);
					//console.log(email);
					$.ajax({
						type : "GET",
						url : urlConfig.user + '/email/' + hashed,
						headers : {
							'Authorization' : 'Basic ' + window.btoa(getState('member').user + ':' + getState('member').pw )
						},
						success : function(data) {
							var data = jQuery.parseJSON(data);
							data = data[0];
							friends_info = '\
							<li><a class="friend-list-element" href="#page8"  data-transition="slide" style="padding:5px">\
								<div class="hidden" id=friends_email>'+data.email+'</div>\
								<table>\
									<tr>\
										<td class="left" >\
											<span ><img src='+data.profile+' height="70" width="70" /></span>\
										</td>\
										<td class="right" >\
											<div id="name" class='+data.gender+'>' + data.name + '\
											</div>\
											<div id="other">' + data.name + ' '+ data.last_location_timestamp + '\
											</div>\
											<div id="other">' + data.status + '\
											</div>\
										</td>\
									</tr>\
								</table>\
							</a></li>';
							$('#friend-list').append(friends_info);
							$('.friend-list-element').last().click(function(){
							 	var friend_email = $(this).children('div')[0].innerHTML;
							 	//setCookie('friend',friend_email,1);
							 	var hashed = md5(friend_email);
							 	$.ajax({
							        type : 'GET',
							        url : urlConfig.user+'/email/'+hashed,
							        headers : {
							            'Authorization' : 'Basic ' + window.btoa( getState('member').user + ':' + getState('member').pw  )
							        },
							        success : function(response) {
							            var result = jQuery.parseJSON(response);
							            var data = result[0];
							            var last_loc = get_location(data.geometry.x,data.geometry.y).name;
										$('#other_profile_last_location').html(last_loc);
										$('#other_profile_last_location').addClass(data.gender);
							            $('#other_profile').attr('src',data.profile);
							            $('#other_profile_email').text(data.email);
										$('#other_profile_name').html(data.name);
										$('#other_profile_name').addClass(data.gender);
										$('#other_profile_gender').html(data.gender.capitalize());
										$('#other_profile_gender').addClass(data.gender);
										$('#other_profile_status').html(data.status);
										$('#other_profile_status').addClass(data.gender);
										$('#profile_major').html(data.major);
										$('#profile_major').addClass(data.gender);
										$('#profile_hobbies').html(data.hobbies);
										$('#profile_hobbies').addClass(data.gender);
							        },
							        error : function(response) {
							            console.log('Cannot to login');
							            //direct to login
							        }
		   						 });
								
							    $.ajax({
									type : 'GET',
									url : urlConfig.follow,
									headers : {
										'Authorization' : 'Basic ' + window.btoa(getState('member').user + ':' + getState('member').pw )
									},
									success : function(data) {
										var data = jQuery.parseJSON(data);
										$('#follow_btn').children('span').children('span').text('Follow');
										$.each(data, function(index, value) {
										 	if(friend_email==value.user_followed){
											    	$('#follow_btn').children('span').children('span').text('Unfollow');
										 	}
										});
									},
									error : function(response) {
										console.log('Cannot to get followed');
										//direct to login
									}
								});

							});
						},
						error : function(response){
							console.log('Error to get friends');
						}
					});
				});
			},
			error : function(response) {
				console.log('Cannot to login');
				//direct to login
			}
		});
	}
	getFollowed();
})()