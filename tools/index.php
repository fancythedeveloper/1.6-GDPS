<?php
function listdir($dir){
	$dirstring = "";
	$files = scandir($dir);
	foreach($files as $file) {
		if(pathinfo($file, PATHINFO_EXTENSION) == "php" AND $file != "index.php"){
			$dirstring .= "<li><a href='$dir/$file'>$file</a></li>";
		}
	}
	return "<ul>".$dirstring."</ul>";
}
echo'<h1>Upload related tools:</h1>';
echo listdir(".");
echo "<h1>The cron job (fixing CPs, autoban, etc.)</h1>";
echo "<li><a href='cron/cron.php'>cron.php</a></li>";
echo "<h1>Stats related tools</h1>";
echo listdir("stats") . "";
?>
