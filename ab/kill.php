<?php
//Script to kill benchmarking on individual servers

//Get server #
$i = $_GET['s'];

$str_exec = "ssh -l bench server$i -i /home/apache/.ssh/id_rsa 'pkill -9 ab' && echo ' '; echo '<meta http-equiv=\'refresh\' content=\'10\'><br>\n<font color=\'#FF0000\'>Benchmark Killed</font>' > /var/www/html/ab/output/server$i.html";
if ( !is_null(shell_exec($str_exec)) ) echo "Server $i Benchmark Killed";
