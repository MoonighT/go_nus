<?php
$this -> load -> view('element/js_url.php');
global $js_includes;
if (!$js_includes)
	$js_includes = array();

$js_includes = array_merge(array('js/jquery-1.8.0.min.js', 'js/base.js', 'js/google_analytics.js', 'js/jquery.placeholder.min.js', 'js/jquery.mobile-1.1.1.js', 'js/jquery.autosize.js', 'js/jquery.watermark.min.js', 'js/login.js', ), $js_includes);
?>
<?php
foreach ($js_includes as $js)
	echo '<script src="' . VIEW_URL . $js . '"></script>' . "\n";

//echo '<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?v=3&sensor=true"></script>'
?>
