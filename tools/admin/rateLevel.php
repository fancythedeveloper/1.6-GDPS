<?php
$pw = "Password in MD5 goes here";
include "../../incl/lib/connection.php";
if (isset($_POST['pw'])) {
    $entered = md5($_POST['pw']);
    if ($entered == $pw) {
        $levelID = $_POST['levelID'];
        if ($_POST['difficulty'] == "Unchanged") {
            echo "";
        } else if ($_POST['difficulty'] == "Demon") {
            $starDemon = 1;
        } else if ($_POST['difficulty'] == "Auto") {
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
        $query = $db->prepare("UPDATE `levels` SET `starStars` = '".$starStars."', `starDemon` = '".$starDemon."', `starAuto` = '".$starAuto."',`starFeatured` = '".$starFeatured."',`rateDate` = '".$rateDate."' WHERE `levels`.`levelID` = ".$levelID.";");
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
    echo "<option value='Unchanged'>Not Demon or Auto (Difficulty is based on votes)</option>";
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
