<?php

ini_set("precision", 3);
chdir(dirname(__FILE__));
include "../lib/connection.php";
require_once "../lib/GJPCheck.php";
require_once "../lib/exploitPatch.php";
$ep = new exploitPatch();
require_once "../lib/mainLib.php";
$gs = new mainLib();
$secret = $ep->remove($_POST["secret"]);
$rating = $ep->remove($_POST["rating"]);
$levelID = $ep->remove($_POST["levelID"]);
$timestamp = time();

// Check difficulty
switch ($rating) {
    case 0: // Auto
    case 1: // Easy
        $diff = 10;
        break;
    case 2: // Normal
        $diff = 20;
        break;
    case 3: // Hard
        $diff = 30;
        break;
    case 4: // Harder
        $diff = 40;
        break;
    case 5: // Insane
    case 6: // Demon
        $diff = 50;
        break;
    default:
        die("You need to supply a value!");
}

// Add the vote
$query = $db->prepare("INSERT INTO `actions` (`ID`, `type`, `value`, `timestamp`, `value2`, `value3`, `value4`, `value5`, `value6`, `account`) VALUES (NULL, '21', '$levelID', '$timestamp', '$diff', '0', '0', '0', '0', '0')");
$query->execute();

// get the count of votes on this level
$query2 = $db->prepare("SELECT COUNT(*) FROM `actions` WHERE `type` = '21' AND `value` = '$levelID'");
$query2->execute();
$count = $query2->fetchColumn();

// get average of total votes
$query3 = $db->prepare("SELECT * FROM `actions` WHERE `type` = '21' AND `value` = '$levelID'");
$query3->execute();
$result = $query3->fetchAll();

$query5 = $db->prepare("SELECT * FROM `levels` WHERE `levelID` = '$levelID'");
$query5->execute();
$result2 = $query5->fetchAll();

$total = 0.0;

foreach ($result as &$vote) {
    $total += $vote["value2"];
}

$averageVote = round($total / $count, -1);

// update the recommended star value
if ($result2['diffOverride'] == 0 && $count >= 10) {
    $query4 = $db->prepare("UPDATE `levels` SET `starDifficulty` = '$averageVote' WHERE `levels`.`levelID` = $levelID");
    $query4->execute();
}

echo $averageVote;

?>
