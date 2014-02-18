<?php

include('../config.inc.php');

switch ($_POST['type']) {
	case 1:
		$page_content = 'indexer.php';
		break;
	case 2:
		$page_content = 'getsitemap.php';
		break;
	case 3:
		$page_content = 'uploadlist.php';
		break;
	default:
		die("Error");
}

//Generate random string
$str_random = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);

//Combine base path with random string
$cache_full_path = $cache_base_path . $str_random;

echo "<h2>Step 2 - Build Index</h2>\n";
include($page_content);

echo "<h2>Step 3 - Select Benchmark Parameters</h2>\n";
echo "<form method='POST' action='bench.php'>\n";
echo "# Users to Simulate Per Server: <input type=text size=5 name='users'></input><br>\n";
echo "Max Delay Between User Requests (in seconds): <input type=text size=5 name='delay'></input><br>\n";
echo "Run time for benchmark (in minutes): <input type=text size='5' name='runtime'></input><br>\n";
echo "Number of Servers: <select name='servers'>\n";
for ($j=1; $j<=$servers; $j++) {
        echo "<option value=$j>$j</option>\n";
}
echo "</select><br>\n";
echo "Verbose Output: <select name='verbose'>\n";
echo "<option value='0'>No</option>\n";
echo "<option value='1'>Yes</option>\n";
echo "</select><br><font color='Red'>* Warning, do not use verbose output with more than 10 servers or your browser may crash</font><br><br>\n";
echo "<input type=hidden name=id value='$str_random'>\n";
echo "<input type=submit name=submit></input>";
?>
