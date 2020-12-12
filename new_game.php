<?php
    session_start();
    require_once("database.php");
    $category = $_REQUEST["category"];
    $sql = "SELECT count(*) AS num FROM $category;";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($result);
    $id = rand(1, $row['num']);
    $sql = "SELECT * FROM $category WHERE id = $id;";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($result);
    $word_db = $row['word'];
    for ($i = 0; $i < mb_strlen($word_db); $i++)
    {
        $tmp = mb_substr($word_db, $i, 1, "utf-8");
        $word[] = $tmp;
    }
    for ($i = 0; $i < count($word); $i++)
    {
        if ($word[$i] == " ") {
            $guess[] = " ";
        }
        else {
            $guess[] = "_";
        }
    }
    echo implode($guess);
    $_SESSION["word"] = $word;
    $_SESSION["guess"] = $guess;
    $_SESSION["attempts"] = 10;
    $_SESSION["result"] = "nieznany";
?>