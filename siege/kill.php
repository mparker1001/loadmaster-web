<?php
include('../config.inc.php');

//Script to kill benchmarking on individual servers

//Get server #
$i = $_GET['s'];
$id = $_GET['id'];
$file = $cache_base_path . "$id/server$i.html";

$str_exec = "ssh -o UserKnownHostsFile=/dev/null -o StrictHostKeyChecking=no -l bench server$i -i /home/apache/.ssh/id_rsa 'pkill -9 siege' && echo ' '";

if ( !is_null(shell_exec($str_exec)) ) {
	echo "Server $i Benchmark Killed";
	file_put_contents($file, "Benchmark killed");
}
