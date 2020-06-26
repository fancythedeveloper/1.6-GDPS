<?php

ini_set("precision", 2);
chdir(dirname(__FILE__));
include "../lib/connection.php";
require_once "../lib/GJPCheck.php";
require_once "../lib/exploitPatch.php";
$ep = new exploitPatch();
require_once "../lib/mainLib.php";
$gs = new mainLib();
$secret = $ep->remove($_POST["secret"]);
$stars = $ep->remove($_POST["rating"]);
$levelID = $ep->remove($_POST["levelID"]);
$timestamp = time();

// Add the vote
$query = $db->prepare("INSERT INTO `actions` (`ID`, `type`, `value`, `timestamp`, `value2`, `value3`, `value4`, `value5`, `value6`, `account`) VALUES (NULL, '20', '$levelID', '$timestamp', '$stars', '0', '0', '0', '0', '0')");
$query->execute();

// get the count of votes on this level
$query2 = $db->prepare("SELECT COUNT(*) FROM `actions` WHERE `type` = '20' AND `value` = '$levelID'");
$query2->execute();
$count = $query2->fetchColumn();

// get average of total votes
$query3 = $db->prepare("SELECT * FROM `actions` WHERE `type` = '20' AND `value` = '$levelID'");
$query3->execute();
$result = $query3->fetchAll();

$total = 0.0;

foreach ($result as &$vote) {
    $total += $vote["value2"];
}

$averageVote = $total / $count;

// update the recommended star value
$query4 = $db->prepare("UPDATE `levels` SET `starVote` = '$averageVote' WHERE `levels`.`levelID` = $levelID");
$query4->execute();

echo $averageVote;

?>
