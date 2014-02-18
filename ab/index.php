<form method=POST action=bench.php>
	Target URL (include trailing slash): <input name='targeturl' type='text' size='50'><br>
	Simultaneous Connections: <input name='sconn' type='text' size='5'><br>
	Total Connections: <input name='tconn' type='text' size='5'><br>
<?php
	include('../config.inc.php');
	echo "Number of Servers: <select name='servers'>\n";
for ($j=1; $j<=$servers; $j++) {
        echo "<option value=$j>$j</option>\n";
}
echo "</select><br>\n";
?>
	<input name="submit" type="submit" value="Submit">	
</form>
