(function() {
	function init_profile() {
		var member = getState('member');
		var user = member.user;
		var password = member.pw;
		var hashed = md5(user);

		$.ajax({
			type : 'GET',
			url : urlConfig.user + '/email/' + hashed,
			headers : {
				'Authorization' : 'Basic ' + window.btoa(user + ':' + password)
			},
			success : function(response) {
				var result = jQuery.parseJSON(response);
				var data = result[0];

				var last_loc = 'undefined';
				if(data.geometry)
					last_loc = get_location(data.geometry.x,data.geometry.y).name;
				$('#profile_last_location').html(last_loc);
				$('#profile_last_location').addClass(data.gender);
				$('#profile_pic').attr("src",data.profile);
				$('#self_profile_name').html(data.name);
				$('#self_profile_name').addClass(data.gender);
				$('#profile_gender').html(data.gender.capitalize());
				$('#profile_gender').addClass(data.gender);
				$('#profile_status').html(data.status);
				$('#profile_status').addClass(data.gender);
				$('#profile_faculty').html(data.faculty);
				$('#profile_faculty').addClass(data.gender);
				$('#profile_major').html(data.major);
				$('#profile_major').addClass(data.gender);
				$('#profile_hobbies').html(data.hobbies);
				$('#profile_hobbies').addClass(data.gender);

				window.set_profile(data);
			},
			error : function(response) {
				console.log('Cannot to login');
				//direct to login
			}
		});

		$('a.edit').click(function() {
			var type = $(this).children('div')[0].innerHTML;
			var value = $(this).children('div')[1].innerHTML;
			$('#edit_header').html(type);
			$("#edit_input").attr('value', value);
		});

	}

	
	$('.page').live('pageshow', function() {

		if(navigator.onLine){
			console.log('online');
			init_profile();
		}else{
			console.log('offline');
			var data = window.get_profile();
			if(data)
				init_profile_offline(data);
		}


		
	});
	
	function init_profile_offline(data) {

		var last_loc = 'undefined';
		if(data.geometry)
			last_loc = get_location(data.geometry.x,data.geometry.y).name;
		$('#profile_last_location').html(last_loc);
		$('#profile_last_location').addClass(data.gender);
		$('#profile_pic').attr("src",data.profile);
		$('#self_profile_name').html(data.name);
		$('#self_profile_name').addClass(data.gender);
		$('#profile_gender').html(data.gender.capitalize());
		$('#profile_gender').addClass(data.gender);
		$('#profile_status').html(data.status);
		$('#profile_status').addClass(data.gender);
		$('#profile_faculty').html(data.faculty);
		$('#profile_faculty').addClass(data.gender);
		$('#profile_major').html(data.major);
		$('#profile_major').addClass(data.gender);
		$('#profile_hobbies').html(data.hobbies);
		$('#profile_hobbies').addClass(data.gender);
	}
	init_profile();

})()