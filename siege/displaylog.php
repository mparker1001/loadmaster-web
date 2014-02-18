<?php
include('../config.inc.php');

switch($_GET['type']) {
	case 1:
		$log_path = "$cache_url_path" . "/" . $_GET['id'] . "/$verbose_log";
		$eid = 1;
		break;
	case 2:
		$log_path = "$cache_url_path" . "/" . $_GET['id'] . "/server" . intval($_GET['server']) . ".html";
		$eid = intval($_GET['server']);
		break;
	default:
		die("Error");
}

if ( file_exists($cache_full_path) ) {
	include($cache_full_path);
}

echo "<script src='jquery-1.10.2.min.js'></script>\n";
echo "<script>\n";
echo "setInterval(function() {\n";
echo "$('#element$eid').load('$log_path');\n";
echo "}, 100);\n";
echo "</script>\n";
echo "<pre><div id='element$eid'></div></pre>\n";
?>
