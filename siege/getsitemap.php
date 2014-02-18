<?php

//include('../config.inc.php');

//Generate random string
//$str_random = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);

//Combine base path with random string
//$cache_full_path = $cache_base_path . $str_random;

function curl_get_file_contents($URL){
        $c = curl_init();
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_URL, $URL);
        curl_setopt($c, CURLOPT_FAILONERROR, TRUE);
        $contents = curl_exec($c);
	echo curl_error($c);
        curl_close($c);

        if ($contents) return $contents;
        else return FALSE;
}

mkdir($cache_full_path, 0755);

$sitemapurl = $_POST['url'] . (substr($_POST['url'], -1) == '/' ? '' : '/') . 'sitemap.xml';

$xml = curl_get_file_contents($sitemapurl);

$xml = simplexml_load_string($xml);

foreach($xml->url as $url) {
	$urls .=  $url->loc . "\n";
}

$fp = fopen("$cache_full_path/$url_list", 'w') or die ("Cannot write to URL list file");
fwrite($fp,$urls);
fclose($fp);

echo "<b>URL's from sitemap.xml:</b><br>\n<iframe width='800' height='500' src='$cache_url_path/$str_random/$url_list' name='$str_random'></iframe><br><br>\n";

//echo "<form method='POST' action='bench.php'>\n";
//echo "<b>Run Benchmark:</b><br>\n";
//echo "# Users to Simulate Per Server: <input type=text size=5 name='users'></input><br>\n";
//echo "Max Delay Between User Requests (in seconds): <input type=text size=5 name='delay'></input><br>\n";
//echo "Run time for benchmark (in minutes): <input type=text size='5' name='runtime'></input><br>\n";
//echo "Number of Servers: <select name='servers'>\n";
//for ($j=1; $j<=$servers; $j++) {
//        echo "<option value=$j>$j</option>\n";
//}
//echo "</select><br><br>\n";
//echo "<input type=hidden name=id value='$str_random'>\n";
//echo "<input type=submit name=submit></input>";
?>
