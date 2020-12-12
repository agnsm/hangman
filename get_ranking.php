<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    require_once("database.php");
    $winstreak = $_SESSION["winstreak"];
    $sql = "SELECT * FROM uzytkownicy ORDER BY winstreak DESC, id DESC LIMIT 25;";
    $result = mysqli_query($connection, $sql);
    echo '<div class="div-table"><table>';
    echo '<tr>';
    echo '<th style="width: 65%">nazwa użytkownika</th>';
    echo '<th>win streak</th>';
    echo '</tr>';
    while($row = mysqli_fetch_array($result)) {
        $username = $row['user'];
        $score = $row['winstreak'];
        echo '<tr>';
        echo '<td>'.$username.'</td>';
        echo '<td>'.$score.'</td>';
        echo '</tr>';
    }
    echo '</table></div>';
?>