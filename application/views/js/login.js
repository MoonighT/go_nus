(function() {
	if (getState('member')) {
		window.location.href = urlConfig.home;
	}
	$('a.toggle').click(function() {
		if (!$(this).hasClass('toggle_btn'))
			$('a.toggle').toggleClass("toggle_btn");
	});

	//join validate
	$('a#join_btn').click(function() {
		var error = false;
		$('#re_pass_error_msg').html(' ');
		$('#password_error_msg').html(' ');
		$('#email_error_msg').html(' ');
		if (!isEmail($('#email').val())) {
			$('#email').val('');
			$('#email_error_msg').html('Email not validate');
			error = true;
		}

		if ($('#password').val().length < 6) {
			$('#password').val('');
			$('#re-password').val('');
			$('#password_error_msg').html('password is too short');
			error = true;
		}

		if ($('#password').val() != $('#re-password').val()) {
			$('#password').val('');
			$('#re-password').val('');
			$('#re_pass_error_msg').html('password re-type is not same');
			error = true;
		}
		if (!error) {
			var user_info = {
				gender : $('a.toggle_btn > span >span').text().toLowerCase(),
				name : $('#name').val(),
				email : $('#email').val(),
				password : md5($('#password').val())
			};
			$.post(urlConfig.new_user, user_info, function(result) {
				if (result) {
					setState('member', $('#email').val(), md5($('#password').val()), 120);
					window.location.href = urlConfig.home;
				} else {
					$('#email_error_msg').html('Sorry, this email has been used');
				}
			}, 'json');

		}

	});

	$('a#login_btn').click(function() {
		var error = false;
		$('#error_msg').html(' ');
		if (!isEmail($('#login_email').val())) {
			$('#login_email').val('');
			$('#error_msg').html('Email not validate');
			error = true;
		}
		if (!error) {
			$.ajax({
				type : 'POST',
				url : 'user/login',
				headers : {
					'Authorization' : 'Basic ' + window.btoa($('#login_email').val() + ':' + md5($('#login_pass').val()))
				},
				success : function(response) {
					var result = jQuery.parseJSON(response);
					if (result.isSuccess) {
						setState('member', result.user, md5($('#login_pass').val()), 120);
						window.location.href = urlConfig.home;
					} else {
						//invalid password or email
						document.getElementById('login-msg').innerHTML = 'Invalid password or email, please try again';
					}
				},
				error:function(response){
					console.log(response);
				}
			});
		}
	});

})()