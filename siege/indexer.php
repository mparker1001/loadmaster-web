<?php

//include('../config.inc.php');

//Generate random string
//$str_random = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);

//Combine base path with random string
//$cache_full_path = $cache_base_path . $str_random;

//Get URL
$url = $_POST['url'];

echo "<b>Starting site index on the following URL:</b><br>";
echo $url . "<br><br>\n";

$str_exec = "mkdir -p $cache_full_path; $index_bin $url $cache_full_path/$url_list $cache_full_path/$verbose_log $cache_full_path $delay >/dev/null 2>/dev/null &";
shell_exec($str_exec);

echo "<b>Progress:</b> (scroll down in box below to update status)<br>\n<iframe width='800' height='500' src='displaylog.php?type=1&id=$str_random' name='$str_random'></iframe><br><br>\n";
echo "<font color='red'>*</font> Do not submit the benchmark request below until you receive a FINISHED message at the bottom of the progress log above<br><br>\n";

//echo "<form method='POST' action='bench.php'>\n";
//echo "<b>Run Benchmark:</b><br>\n";
//echo "# Users to Simulate Per Server: <input type=text size=5 name='users'></input><br>\n";
//echo "Max Delay Between User Requests (in seconds): <input type=text size=5 name='delay'></input><br>\n";
//echo "Run time for benchmark (in minutes): <input type=text size='5' name='runtime'></input><br>\n";
//echo "Number of Servers: <select name='servers'>\n";
//for ($j=1; $j<=$servers; $j++) {
//	echo "<option value=$j>$j</option>\n";
//}
//echo "</select><br><br>\n";
//echo "<input type=hidden name=id value='$str_random'>\n";
//echo "<input type=submit name=submit></input>";
?>
