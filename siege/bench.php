<?php
include('../config.inc.php');

//Ensure that benchmarking servers and are mapped in /etc/hosts as 'server#'

//Get post variables

if ( ctype_alnum($_POST['id']) === TRUE ) {
	$id = $_POST['id'];    //Cache path name
}
else die("Invalid ID");

$users = intval($_POST['users']);      //Users to simulate
$delay = intval($_POST['delay']);      //Max delay between user requests
$runtime = intval($_POST['runtime']);  //Run time for benchmark
$servers = intval($_POST['servers']);  //Number of servers to use
$verbose = intval($_POST['verbose']);  //Whether to use verbose output in siege

if ( $verbose == 1 ) {
	$verboseoption = "";
}
else {
	 $verboseoption = "-q ";
}

$countertime = $runtime * 60;

echo "<script>\n";
echo "var count=$countertime;\n";
echo "var counter=setInterval(timer, 1000); //second parameter is in milliseconds\n";
echo "function timer()\n";
echo "{\n";
echo "count=count-1;\n";
echo "if (count < 0)\n";
echo "{\n";
echo "clearInterval(counter);\n";
echo "return;\n";
echo "}\n";
echo 'document.getElementById("timer").innerHTML=count + " seconds";';
echo "\n}\n";
echo "</script>\n";
echo "<b>Starting load test with the following parameters:</b><br>\n";
echo $servers . " servers<br>\n";
echo $users . " user(s) to simulate per server<br>\n";
echo $delay . " max second(s) between user requests<br>\n";
echo $runtime . " minute(s) to run test<br><br>\n";
echo "Approximate Time Remaining: \n";
echo "<span id='timer'></span><br><br>\n";

//Loop through command to start ab on each server
for ($i = 1; $i <= $servers; $i++) {
	$str_exec = "> $cache_base_path/$id/server$i.html; echo \"<pre>Benchmarking...\n\" >> $cache_base_path/$id/server$i.html; ssh -o UserKnownHostsFile=/dev/null -o StrictHostKeyChecking=no -l bench -i /home/apache/.ssh/id_rsa server$i \"siege $verboseoption-c $users -i -t $runtime" . "M -d $delay -f /dev/stdin\" < $cache_base_path/$id/$url_list >> $cache_base_path/$id/server$i.html 2>&1 &";
//	$str_exec = "> $cache_base_path/$id/server$i.html; echo \"<meta http-equiv='refresh' content='10'>\n<pre>Benchmarking...\n\" >> $cache_base_path/$id/server$i.html; ssh -o UserKnownHostsFile=/dev/null -o StrictHostKeyChecking=no -l bench -i /home/apache/.ssh/id_rsa server$i \"siege -v -c $users -i -t $runtime" . "M -d $delay -f /dev/stdin\" < $cache_base_path/$id/$url_list >> $cache_base_path/$id/server$i.html 2>&1 &";
	shell_exec($str_exec);
	echo "<b>Server $i</b> (<a href='kill.php?s=$i&id=$id' target='_blank'>Kill</a>)<br>\n<iframe width='800' height='500' src='displaylog.php?type=2&id=$id&server=$i' name='server$i'></iframe><br><br>\n";
}
