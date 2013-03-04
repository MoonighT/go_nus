<!DOCTYPE html>
<html>
	<head>
		<script src="http://code.jquery.com/jquery-1.8.1.min.js"></script>
		<script>
			function test(button) {
				console.log('Action:' + button.id);
				var type = document.getElementById("type").value;
				console.log('Type:' + type);
				switch(button.id) {
					case 'put':
						$.ajax({
							type : 'PUT',
							url : 'user/',
							//dataType: 'json',
							contentType : 'application/x-www-form-urlencoded',
							data : {
								name : 'jjp',
								password : 'test',
								email : 'testmailadsasd@gmail.com',
								gender : 'male',
								status : 'teststatus',
								major : 'testmajor',
								faculty : 'testfaculty'
							},
							success : function(response) {
								// Succeeded! Do something...
								document.getElementById("result").innerHTML = response;
								console.log(response);
							}
						});
						break;
					case 'get':
						$.ajax({
							type : 'GET',
							url : 'user/' + type,
							//dataType: 'json',
							contentType : 'application/x-www-form-urlencoded',
							success : function(response) {
								// Succeeded! Do something...
								console.log(response);
								document.getElementById("result").innerHTML = response;
							}
						});
						break;
					case 'post':
						$.ajax({
							type : 'POST',
							url : 'user/location/',
							//dataType: 'json',
							contentType : 'application/x-www-form-urlencoded',
							data : {
								x : 10,
								y : 10,
							},
							success : function(response) {
								// Succeeded! Do something...
								console.log(response);
								document.getElementById("result").innerHTML = response;
							}
						});
						break;
					case 'delete':
						$.ajax({
							type : 'DELETE',
							url : '../user/',
							//dataType: 'json',
							contentType : 'application/x-www-form-urlencoded',

							success : function(response) {
								// Succeeded! Do something...
								document.getElementById("result").innerHTML = response;
							}
						});
						break;
				}
			}
		</script>
	</head>

	<body>
		<?php echo VIEW_URL
		?>
		<div>
			<button onclick="test(this)"class="btn"id="put">
				Put
			</button>
			<button onclick="test(this)"class="btn"id="get">
				Get
			</button>
			<button onclick="test(this)"class="btn"id="post">
				Post
			</button>
			<button onclick="test(this)"class="btn"id="delete">
				Delete
			</button>
			<input id="type"  type="text">
		</div>
		<div>
			Result goes here:
			<div id="result"></div>
		</div>
	</body>
</html>