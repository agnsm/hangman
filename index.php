<?php
    session_start();
    $_SESSION["winstreak"] = 0;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>WISIELEC</title>
        <link rel="stylesheet" href="style.css">
        <link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@200;400;700&family=Montserrat:wght@400;800&display=swap" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1><img src="img/hangman.svg" alt="hangman icon"">wisielec</h1>
            </div>
            <div class="left-panel">
                <div class="heading-category">KATEGORIE</div>
                <div class="categories">
                    <button type="button" class="btnCategory" value="geografia">geografia</button>
                    <button type="button" class="btnCategory" value="zwierzeta">zwierzęta</button>
                    <button type="button" class="btnCategory" value="kino">kino</button>
                </div>
                <div class="answer"></div>
            </div>
            <div class="main-panel">
                <div class="word">← WYBIERZ KATEGORIĘ</div>
                <div class="letters">
                    <div>
                        <button type="button" class="btnLetter" value="a" disabled>A</button>
                        <button type="button" class="btnLetter" value="ą" disabled>Ą</button>
                        <button type="button" class="btnLetter" value="b" disabled>B</button>
                        <button type="button" class="btnLetter" value="c" disabled>C</button>
                        <button type="button" class="btnLetter" value="ć" disabled>Ć</button>
                        <button type="button" class="btnLetter" value="d" disabled>D</button>
                        <button type="button" class="btnLetter" value="e" disabled>E</button>
                        <button type="button" class="btnLetter" value="ę" disabled>Ę</button>
                        <button type="button" class="btnLetter" value="f" disabled>F</button>
                        <button type="button" class="btnLetter" value="g" disabled>G</button>
                        <button type="button" class="btnLetter" value="h" disabled>H</button>
                        <button type="button" class="btnLetter" value="i" disabled>I</button>
                        <button type="button" class="btnLetter" value="j" disabled>J</button>
                        <button type="button" class="btnLetter" value="k" disabled>K</button>
                        <button type="button" class="btnLetter" value="l" disabled>L</button>
                        <button type="button" class="btnLetter" value="ł" disabled>Ł</button>
                        <button type="button" class="btnLetter" value="m" disabled>M</button>
                        <button type="button" class="btnLetter" value="n" disabled>N</button>
                        <button type="button" class="btnLetter" value="ń" disabled>Ń</button>
                        <button type="button" class="btnLetter" value="o" disabled>O</button>
                        <button type="button" class="btnLetter" value="ó" disabled>Ó</button>
                        <button type="button" class="btnLetter" value="p" disabled>P</button>
                        <button type="button" class="btnLetter" value="r" disabled>R</button>
                        <button type="button" class="btnLetter" value="s" disabled>S</button>
                        <button type="button" class="btnLetter" value="ś" disabled>Ś</button>
                        <button type="button" class="btnLetter" value="t" disabled>T</button>
                        <button type="button" class="btnLetter" value="u" disabled>U</button>
                        <button type="button" class="btnLetter" value="w" disabled>W</button>
                        <button type="button" class="btnLetter" value="y" disabled>Y</button>
                        <button type="button" class="btnLetter" value="z" disabled>Z</button>
                        <button type="button" class="btnLetter" value="ź" disabled>Ź</button>
                        <button type="button" class="btnLetter" value="ż" disabled>Ż</button>
                    </div>
                </div>
                <div class="hangman"></div>
            </div>
            <div class="right-panel">
                <div class="heading-win-streak">WIN STREAK:</div>
                <div class="win-streak">0</div>
                <div class="save">
                    <input type="text" class="username" maxlength="20" placeholder="nazwa użytkownika" onfocus="this.placeholder=''" onblur="this.placeholder='nazwa uzytkownika'">
                    <button type="button" class="btnSave">zapisz wynik</button>
                </div>
                <div class="heading-ranking">TOP 25 GRACZY</div>
                <div class="ranking">
                    <?php include("get_ranking.php"); ?>
                </div>
            </div>
            <div class="info"></div>
            <!--<div>Icons made by <a href="https://www.flaticon.com/authors/freepik" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div>-->
        </div>
        <script>
            $(document).ready(function(){
                $(".btnCategory").click(function() {
                    const button = $(this);
                    const category = button.val();
                    $.ajax({
                        url : "new_game.php",
                        method : "post",
                        data : { category: category },
                        success : function(data) {
                            $(".btnCategory").each(function() {
                                $(this).css("font-weight", "initial");
                                $(this).prop("disabled", true);
                            });
                            button.css("font-weight", 700);
                            $(".btnLetter").each(function() {
                                $(this).prop("disabled", false);
                                $(this).css("background-color", "white");
                            });
                            $(".answer").text("");
                            $(".word").text(data);
                            $(".hangman").html('<img src="img/wisielec0.png" alt="wisielec0" class="hangman-picture">');
                        }
                    });
                });
                $(".btnLetter").click(function() {
                    const button = $(this);
                    const letter = button.val();
                    button.prop("disabled", true);
                    $.ajax({
                        url : "check.php",
                        method : "post",
                        data : { letter: letter },
                        success : function(data) {
                            if (data == "") {
                                button.css("background-color", "#cc5739");
                            }
                            else {
                                $(".word").text(data);
                                button.css("background-color", "#599c2d");
                            }
                            
                            $.ajax({
                                url : "draw_hangman.php",
                                method : "post",
                                success : function(data) {
                                    $(".hangman").html(data);

                                    $.ajax({
                                        url : "result.php",
                                        method : "post",
                                        success : function(data) {
                                            if (data == "wygrana" || data == "przegrana") {
                                                $(".btnLetter").each(function() {
                                                    $(this).prop("disabled", true);
                                                    $(".btnCategory").each(function() {
                                                        $(this).prop("disabled", false);
                                                    });
                                                });
                                                $(".hangman").append(data);
                                            }
                                        }
                                    });

                                    $.ajax({
                                        url : "win_streak.php",
                                        method : "post",
                                        success : function(data) {
                                            $(".win-streak").text(data);
                                        }
                                    });

                                    $.ajax({
                                        url : "show_answer.php",
                                        method : "post",
                                        success : function(data) {
                                            $(".answer").html(data);
                                        }
                                    });
                                }
                            });
                        }
                    });  
                });
                $(".btnSave").click(function() {
                    const username = $(".username").val();
                    $.ajax({
                        url : "save_score.php",
                        method : "post",
                        data : { username: username },
                        success : function(data) {
                            $.ajax({
                                url : "get_ranking.php",
                                method : "post",
                                success : function(data) {
                                    $(".ranking").html(data);
                                }
                            });
                        }
                    });
                });
            });
        </script>
    </body>
</html>