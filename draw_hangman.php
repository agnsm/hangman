<?php
    session_start();
    $guess = $_SESSION["guess"];
    $attempts = $_SESSION["attempts"];
    $winstrake = $_SESSION["winstreak"];
    $index = 10 - $attempts;
    $win = true;
    for ($i = 0; $i < count($guess); $i++) {
        if($guess[$i] == "_") {
            $win = false;
        }
    }
    if($win) {
        $winstrake += 1;
        $_SESSION["winstreak"] = $winstrake;
        $_SESSION["result"] = "wygrana";
        echo '<img src="img/wisielec'.$index.'.png" alt="wisielec'.$attempts.'" class="hangman-picture">';
    }
    elseif ($attempts > 0) {
        echo '<img src="img/wisielec'.$index.'.png" alt="wisielec'.$attempts.'" class="hangman-picture">';
    }
    else {
        echo '<img src="img/wisielec10.png" alt="wisielec10" class="hangman-picture">';
        $_SESSION["winstreak"] = 0;
        $_SESSION["result"] = "przegrana";
    }
?>