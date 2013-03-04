(function(){

	$('#edit_btn').click(function(event){
		$('#edit_msg').html('');
		
		var title = $('#edit_header').html().toString();
		var raw_value = $("#edit_input").attr('value').toString();
		//validate info
		//name
		title = $.trim(title.toLowerCase());
		raw_value = $.trim(raw_value);
		raw_value = raw_value.replace(/\<|\>|\"|\'|\%|\;|\(|\)|\&|\+|\-/g,""); 
		var edit_data;
		switch(title){
			case 'name':
			edit_data = {'name':raw_value};
			break;
			case 'status':
			edit_data = {'status':raw_value};
			break;
			case 'faculty':
			edit_data = {'faculty':raw_value};
			break;
			case 'major':
			edit_data = {'major':raw_value};
			break;
			case 'hobbies':
			edit_data = {'hobbies':raw_value};
			break;
		}

		if(title=='name' && raw_value==''){
			event.preventDefault();
			event.stopImmediatePropagation();

			$('#edit_msg').html('Name can not be empty');
		}
		else{
			$.ajax({
		        type : 'POST',
		        url : urlConfig.user,
		        headers : {
		            'Authorization' : 'Basic ' + window.btoa( getState('member').user +':' + getState('member').pw )
		        },
		        data : edit_data,
		        success : function(response){

		        	switch(title){
						case 'name':
						console.log(raw_value);
						$('#self_profile_name').html(raw_value);
						break;
						case 'status':
						$('#profile_status').html(raw_value);
						break;
						case 'faculty':
						$('#profile_faculty').html(raw_value);
						break;
						case 'major':
						$('#profile_major').html(raw_value);
						break;
						case 'hobbies':
						$('#profile_hobbies').html(raw_value);
						break;
					}

		        	console.log('success');
		        } ,
		        error : function(response) {

		            console.log('Cannot to login');
		            //direct to login
		        }
		    });

 

		}

	});
	
})()