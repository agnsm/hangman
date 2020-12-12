<?php
    session_start();
    $word = $_SESSION["word"];
    $result = $_SESSION["result"];
    if ($result == "przegrana") {
        echo "poprawna odpowiedź: <br>".mb_strtoupper(implode($word));
    }
?>