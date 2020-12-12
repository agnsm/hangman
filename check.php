<?php
    session_start();
    $letter = $_REQUEST["letter"];
    $word = $_SESSION["word"];
    $guess = $_SESSION["guess"];
    $attempts = $_SESSION["attempts"];
    $update = false;
    for ($i = 0; $i < count($word); $i++) {
        if ($word[$i] == $letter) {
            $guess[$i] = $word[$i];
            $update = true;
        }
    }
    if ($update) {
        echo mb_strtoupper(implode($guess));
        $_SESSION["guess"] = $guess;
    }
    else {
        $attempts -= 1;
        $_SESSION["attempts"] = $attempts;
    }
?>