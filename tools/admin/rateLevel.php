<?php
$pw = "Enter MD5 hash of password here";
include "../../incl/lib/connection.php";
if (isset($_POST['pw'])) {
    $entered = md5($_POST['pw']);
    if ($entered == $pw) {
        $levelID = $_POST['levelID'];
        if ($_POST['difficulty'] == "NA") {
            $starDifficulty = 0;
        } else if ($_POST['difficulty'] == "Easy") {
            $starDifficulty = 10;
        } else if ($_POST['difficulty'] == "Normal") {
            $starDifficulty = 20;
        } else if ($_POST['difficulty'] == "Hard") {
            $starDifficulty = 30;
        } else if ($_POST['difficulty'] == "Harder") {
            $starDifficulty = 40;
        } else if ($_POST['difficulty'] == "Insane") {
            $starDifficulty = 50;
        } else if ($_POST['difficulty'] == "Demon") {
            $starDifficulty = 50;
            $starDemon = 1;
        } else if ($_POST['difficulty'] == "Auto") {
            $starDifficulty = 50;
            $starAuto = 1;
        }
        if (!isset($starDemon)) {
            $starDemon = 0;
        }
        if (!isset($starAuto)) {
            $starAuto = 0;
        }
        $starStars = $_POST['stars'];
        if ($_POST['featured'] == 'Yes') {
            $starFeatured = 1;
        } else {
            $starFeatured = 0;
        }
        $rateDate = time();
        $query = $db->prepare("UPDATE `levels` SET `starDifficulty` = '".$starDifficulty."', `starStars` = '".$starStars."', `starDemon` = '".$starDemon."', `starAuto` = '".$starAuto."',`starFeatured` = '".$starFeatured."',`rateDate` = '".$rateDate."' WHERE `levels`.`levelID` = ".$levelID.";");
        $query->execute();
        echo "Level Rated.";
    } else {
        echo "Incorrect Password.";
    }
} else {
    echo "<form action='rateLevel.php' method='POST'>";
    echo "Admin Password: <input type='password' name='pw' /><br>";
    echo "Level ID: <input name='levelID' /><br>";
    echo "<label for='difficulty'>Difficulty: </label>";
    echo "<select name='difficulty'>";
    echo "<option value='NA'>NA</option>";
    echo "<option value='Easy'>Easy</option>";
    echo "<option value='Normal'>Normal</option>";
    echo "<option value='Hard'>Hard</option>";
    echo "<option value='Harder'>Harder</option>";
    echo "<option value='Insane'>Insane</option>";
    echo "<option value='Demon'>Demon</option>";
    echo "<option value='Auto'>Auto</option>";
    echo "</select><br>";
    echo "Stars: <input name='stars' /><br>";
    echo "<label for='featured'>Feature? </label>";
    echo "<select name='featured'>";
    echo "<option value='No'>No</option>";
    echo "<option value='Yes'>Yes</option>";
    echo "</select><br>";
    echo "<input type='submit' value='Rate Level!'>";
    echo "</form>";
}
?>
