<?php
    session_start();
    require_once("database.php");
    $username = $_REQUEST["username"];
    $winstreak = $_SESSION["winstreak"];
    $sql = "SELECT * FROM uzytkownicy WHERE user = '$username'";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($result);
    if ($row == false) {
        $sql = "INSERT INTO uzytkownicy (user, winstreak) VALUES ('$username', $winstreak)";
        $result = mysqli_query($connection, $sql);
    }
    elseif ($row["winstreak"] < $winstreak) {
        $user = $row["user"];
        $sql = "UPDATE uzytkownicy SET winstreak = $winstreak WHERE user = '$user';";
        $result = mysqli_query($connection, $sql);
    }
?>