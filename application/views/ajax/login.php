<?php
$this -> load -> view('util.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<?php
		$this -> load -> view('element/include_css.php');
		?>


		<title>Login</title>
	</head>
	<body>
		<!-- Home -->
		<div data-role="page" id="new_uesr">
    		<div data-theme="a" data-role="header">
		        <h3>login</h3>
		    </div>
		    <div data-role="content">
		        <div data-role="navbar">
		            <ul>
		                <li>
		                    <a href="#new_uesr" data-theme="a" class="ui-btn-active ui-state-persist">New User</a>
		                </li>
		                <li>
		                    <a href="#login" data-theme="a" >Login</a>
		                </li>
		            </ul>
		        </div>
		        <div class='new_user'>
		            <div>
		            	<label>Name</label>
					    <input type='text' id='name'></input>
		            </div>
		            <div data-role="controlgroup"   data-type="horizontal">
						<a class='toggle toggle_btn' data-role="button">Male</a>
						<a class='toggle' data-role="button">Female</a>
					</div>
		            <div>
		            	<label>Email</label>
		            	<div id="email_error_msg" class="error_msg" ></div>
		            	<input type='email' id='email'></input>
		            </div>
		            <div>
		            	<label>Password</label>
		            	<div id="password_error_msg" class="error_msg"></div>
		            	<input type='password' id='password'></input>
		            </div>
		            <div>
		            	<label>Re-type</label>
		            	<div id="re_pass_error_msg" class="error_msg"></div>
		            	<input type='password' id='re-password'></input>
		            </div>
					
		        	<div>
		        		<a data-role='button' id="join_btn">Join</a>
		        	</div>
		        </div>


		    </div>
		</div>

		<div data-role="page" id="login">
    		<div data-theme="a" data-role="header">
		        <h3>login</h3>
		    </div>
		    <div data-role="content">
		        <div data-role="navbar">
		            <ul>
		                <li>
		                    <a href="#new_uesr" data-theme="a" >New User</a>
		                </li>
		                <li>
		                    <a href="#login" data-theme="a" class="ui-btn-active ui-state-persist">Login</a>
		                </li>
		            </ul>
		        </div>
		        <div class='login'>
		        	<div id="error_msg" class="error_msg"></div>
		            <div>
		            	<label>Email</label>
		            	<input type='text' id="login_email"></input>
		            </div>
		            <div>
		            	<label>Password</label>
		            	<input type='text' id="login_pass"></input>
		            </div>
			        
			        <div>
			        	<a data-role='button' id="login_btn" >Login</a>
			        </div>
		        </div>
				
		    </div>
		</div>
		
		<?php
		$this -> load -> view('element/include_js.php');
		?>
	</body>
</html>
