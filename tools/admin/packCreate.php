<style>
    table, th, tr, td {
        border: 1px solid black;
    }
</style>

<?php
$pw = "Enter MD5 hash of password here";
include "../../incl/lib/connection.php";
if (isset($_POST['pw'])) {
    $entered = md5($_POST['pw']);
    if ($entered == $pw) {
        $name = $_POST['packName'];
        $levels = $_POST['levels'];
        $stars = $_POST['stars'];
        $coins = $_POST['coins'];
        $difficulty = $_POST['difficulty'];
        $rgbcolors = $_POST['color'];
        $query = $db->prepare("INSERT INTO `mappacks` (`ID`, `name`, `levels`,`stars`,`coins`,`difficulty`,`rgbcolors`,`colors2`) VALUES (NULL, '$name','$levels','$stars','$coins','$difficulty','$rgbcolors','none');");
        $query->execute();
        echo "Map Pack added.";
    } else {
        echo "Incorrect Password.";
    }
} else {
    echo "<form action='packCreate.php' method='POST'>";
    echo "Admin Password: <input type='password' name='pw' /><br>";
    echo "Pack Name: <input name='packName' /><br>";
    echo "Levels: <input name='levels' placeholder='Separate IDs with Commas' /><br>";
    echo "Stars: <input name='stars' /><br>";
    echo "Coins: <input name='coins' /><br>";
    echo "<label for='difficulty'>Difficulty: </label>";
    echo "<select name='difficulty'>";
    echo "<option value='0'>Auto</option>";
    echo "<option value='1'>Easy</option>";
    echo "<option value='2'>Normal</option>";
    echo "<option value='3'>Hard</option>";
    echo "<option value='4'>Harder</option>";
    echo "<option value='5'>Insane</option>";
    echo "<option value='6'>Demon</option>";
    echo "</select><br>";
    echo "Color: <input name='color' placeholder='Enter as R,G,B' /><br>";
    echo "<input type='submit' value='Create Map Pack!'>";
    echo "</form>";
}
?>
<h4>Star, Coin, and difficulty guide</h4>
<p>Base star value is determined by the average star value of all levels, rounded to the nearest whole number. Coin difficulties are as follows:</p>
<table>
    <tr>
        <th>Stars</th>
        <th>Coins</th>
    </tr>
    <tr>
        <td>1-4</td>
        <td>1</td>
    </tr>
    <tr>
        <td>5-8</td>
        <td>2</td>
    </tr>
    <tr>
        <td>9-10</td>
        <td>3</td>
    </tr>
</table>
<p>Stars and coins are multiplied by a certain amount if there are more than 3 levels. Star values are as follows:</p>
<table>
    <tr>
        <th>Base Star Value</th>
        <th>Base Coin Value</th>
        <th>Difficulty</th>
        <th>Stars for 4 levels</th>
        <th>Coins for 4 levels</th>
        <th>Stars for 5 levels</th>
        <th>Coins for 5 levels</th>
        <th>Stars for 6 levels</th>
        <th>Coins for 6 levels</th>
    </tr>
    <tr>
        <td>1</td>
        <td>1</td>
        <td>Auto</td>
        <td>1</td>
        <td>1</td>
        <td>2</td>
        <td>2</td>
        <td>2</td>
        <td>2</td>
    </tr>
    <tr>
        <td>2</td>
        <td>1</td>
        <td>Easy</td>
        <td>3</td>
        <td>1</td>
        <td>3</td>
        <td>2</td>
        <td>4</td>
        <td>2</td>
    </tr>
    <tr>
        <td>3</td>
        <td>1</td>
        <td>Normal</td>
        <td>4</td>
        <td>1</td>
        <td>5</td>
        <td>2</td>
        <td>6</td>
        <td>2</td>
    </tr>
    <tr>
        <td>4</td>
        <td>1</td>
        <td>Hard</td>
        <td>5</td>
        <td>1</td>
        <td>7</td>
        <td>2</td>
        <td>8</td>
        <td>3</td>
    </tr>
    <tr>
        <td>5</td>
        <td>2</td>
        <td>Hard</td>
        <td>7</td>
        <td>3</td>
        <td>8</td>
        <td>3</td>
        <td>10</td>
        <td>4</td>
    </tr>
    <tr>
        <td>6</td>
        <td>2</td>
        <td>Harder</td>
        <td>8</td>
        <td>3</td>
        <td>10</td>
        <td>3</td>
        <td>12</td>
        <td>4</td>
    </tr>
    <tr>
        <td>7</td>
        <td>2</td>
        <td>Harder</td>
        <td>9</td>
        <td>3</td>
        <td>12</td>
        <td>3</td>
        <td>14</td>
        <td>4</td>
    </tr>
    <tr>
        <td>8</td>
        <td>2</td>
        <td>Insane</td>
        <td>11</td>
        <td>3</td>
        <td>13</td>
        <td>3</td>
        <td>16</td>
        <td>4</td>
    </tr>
    <tr>
        <td>9</td>
        <td>3</td>
        <td>Insane</td>
        <td>12</td>
        <td>4</td>
        <td>15</td>
        <td>5</td>
        <td>18</td>
        <td>6</td>
    </tr>
    <tr>
        <td>10</td>
        <td>3</td>
        <td>Demon</td>
        <td>13</td>
        <td>4</td>
        <td>17</td>
        <td>5</td>
        <td>20</td>
        <td>6</td>
    </tr>
</table>