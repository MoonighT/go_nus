<?php
$urls = array('location' => 'location/info',
			  'nearby_user' => 'ajax/near_users.php', 
			  'user' => 'user/info',
			  'post_location' => 'user/location',
			  'follow'=>'follow/followed',
			  'new_user'=>'user/',
			  'home' => 'member',
			  'login' => 'rest',
			  'location_msg'=>'location/msg',
			  );
?>
<script type="text/javascript">
urlConfig = {
<?php
	echo 'location' . ':  "' . WEBSITE_URL . $urls['location'] . '",';
	echo 'post_location' . ':  "' . WEBSITE_URL . $urls['post_location'] . '",';
	echo 'nearby_user' . ':  "' . VIEW_URL . $urls['nearby_user'] . '",';
	echo 'user' . ':  "' . WEBSITE_URL . $urls['user'] . '",';
	echo 'follow' . ':  "' . WEBSITE_URL . $urls['follow'] . '",';
	echo 'new_user' . ':  "' . WEBSITE_URL . $urls['new_user'] . '",';
	echo 'home' . ':  "' . WEBSITE_URL . $urls['home'] . '",';
	echo 'login' . ':  "' . WEBSITE_URL . $urls['login'] . '",';
	echo 'location_msg' . ':  "' . WEBSITE_URL . $urls['location_msg'] . '",';
?>};
</script>