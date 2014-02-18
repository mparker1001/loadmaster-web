<?php
//Ensure that benchmarking servers and are mapped in /etc/hosts as 'server#'

//Get post variables
$url = $_POST['targeturl'];    //Target URL
$sconn = $_POST['sconn'];      //Simultaneous Connections
$tconn = $_POST['tconn'];      //Total Connections
$servers = $_POST['servers'];  //Number of benchmarking servers

echo "<b>Starting load test with the following parameters:</b><br>";
echo $servers . " servers<br>\n";
echo $sconn . " simultaneous connections per server<br>\n";
echo $tconn . " total connections per server<br>\n<br><br>";

//Loop through command to start ab on each server
for ($i = 1; $i <= $servers; $i++) {
	$str_exec = "> /var/www/html/ab/output/server$i.html; echo \"<meta http-equiv='refresh' content='10'>\n<pre>Benchmarking...\n\" >> /var/www/html/ab/output/server$i.html; ssh -o UserKnownHostsFile=/dev/null -o StrictHostKeyChecking=no -l bench server$i -i /home/apache/.ssh/id_rsa 'ab -w -n $tconn -c $sconn $url' >> /var/www/html/ab/output/server$i.html 2>&1 &";
	shell_exec($str_exec);
	echo "<b>Server $i</b> (<a href='kill.php?s=$i' target='_blank'>Kill</a>)<br>\n<iframe width='800' height='500' src='output/server$i.html' name='server$i'></iframe><br><br>\n";
}
