<?php

class Main {

    function getNameUser($id, $mysql) {

        $result = $mysql->query("SELECT name FROM `accounts` WHERE `id` = '$id'");
        $row = $result->fetch_assoc();
        if (!isset($row["name"])) {
            $name = "";
        } else {
            $name = $row["name"];
        }
        return $name;
    }

    function createHead() {
        echo<<< _END
        <!DOCTYPE html>
        <html>
            <head>
                <title>Strona glowna</title>
                <link rel="stylesheet" href="app/style.css">
                <link rel="preconnect" href="https://fonts.googleapis.com">
                <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
                <link href="app/fontawesome-free-5.15.4-web/css/fontawesome.css" rel="stylesheet">
                <link href="app/fontawesome-free-5.15.4-web/css/brands.css" rel="stylesheet">
                <link href="app/fontawesome-free-5.15.4-web/css/solid.css" rel="stylesheet">
                <link rel="icon" href="https://ocdn.eu/zapytaj-transforms/1/E8Mk9ktTURBXy9jMDI5NGQzMS03YjM0LTQ3YjItYzQ0OC1jYjY3YzgyMTZjMTMucG5nkpUCAM0BLMLDlQLNASwAwsOBAQI">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
            </head>

        _END;
    }

    function createNav() {
        echo<<< _END
        <body>
            <nav>
                <div class="items md-4">
                    <a href="?" class="logo">Quiz</a>
                </div>
                <div class="items md-1 row">
                    <a href="?" class="nav-items">Strona główna</a>
                    <a href="?news" class="nav-items">Aktualności</a>
                    <a href="?quiz" class="nav-items">Quizy</a>
                    <a href="?kontakt" class="nav-items">Kontakt</a>
                </div>
                <div class="items md-4">
        _END;
        if (isset($_SESSION["login"])) {
            echo '<button class="btnprofile">'.$_SESSION["login"].'</button>';
            echo '<div class="profilemenu"><a href="?profile">Profil</a><a href="?logout">Wyloguj sie</a></div>';
        } else {
            echo '<button class="btnLog">Zaloguj sie</button>';
        }
        echo<<< _END
                </div>
            </nav>
         _END;

    }
    function createFooter() {
        ?>

        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="items md-3">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                    </div>
                    <div class="items md-3">
                        <h4>Przydatne linki: </h4>
                        <li><a href="?regulamin">Regulamin</a></li>
                        <li><a href="">Strona glowna</a></li>
                        <li><a href="?news">Aktualnosci</a></li>
                        <li><a href="?kontakt">Kontakt</a></li>
                        <li><a href="?login">Zaloguj sie</a></li>
                    </div>
                    <div class="items md-3">
                        asd
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-down">
            Wszelkie prawa autorskie zastrzeżone. &copy <a href="#">Regulamin</a>
        </div>
        <script src="app/js/main.js"></script>
    </body>
    <!-- 
        Jezeli to widzisz to ta literacja jest esster eggiem xD 
        Na stronie znajdziesz moje wypociny :)
        Kamil ^_^ 
    -->
</html>
        <?php
    }
    function createNavigation($a) {

    echo '<div class="navigation">';
    echo '<div class="container">';
    echo '<a href="?">Strona glowna</a> / ';
    echo $a;
    echo '</div>';
    echo '</div>';
    echo '<script>document.title = "'.$a.'";</script>';   

    }
    function createFormLogin() {
        echo<<< _END
        <div class="L-container">
            <div class="L-switchMethod">
                <button class="switchLogin switchSelected">Logowanie</button>
                <button class="switchRegister">Rejestracja</button>
            </div>
            <div class="login">
                <div class="title">Zaloguj sie!</div>
                <div class="error"></div>
                <label for="Lemail">Email<input name="Lemail"></label>
                <label for="Lpassword">Haslo<input type="password" name="Lpassword">
                    <button class="btnshowPass"><i class="fas fa-eye-slash"></i></button>
                </label>
                <button class="loginbtn">Zaloguj</button>
                <a href="#">Nie pamietasz hasła?</a>
            </div>
            <div class="register hidden">
                <div class="title">Zarejestruj sie!</div>
                <div class="error"></div>
                <label for="Remail">Email<input name="registerEmail"></label>
                <label for="Rpassword">Haslo<input type="password" name="password"></label>
                <label for="Rpassword">Powtórz Haslo<input type="password" name="password"></label>
                <button>Register</button>
            </div>
        </div>
        <script src="app/js/login.js"></script>
    _END;
    }



    function createProfile($p, $mysql) {
        if ($p == "") {
            $id = $_SESSION["id"];
        } else { 
            $id = $p;
        }
        $nr = 0;
        $sum = 0;
        $resultQuestion = $mysql->query("SELECT * FROM `done_question` WHERE `ID_USER` = '$id'");
        while ($row = $resultQuestion->fetch_assoc()) {
            $sum = $row["PROCENT"] + $sum;
            $nr++;
        }
        if ($sum != 0 && $nr != 0)
            $procent = round($sum / $nr, 1);
        else 
            $procent = 0;
        echo '<div class="container min-height">
                <div class="row">
                    <div class="items-container profile">
                        <div class="row">
                            <div class="items">
                                <div class="title">Twoje punkty</div><div class="circle">'.$sum.'</div>
                            </div>      
                            <div class="items">
                                <div class="title">Wykonane quizy</div><div class="circle">'.$nr.'</div>
                            </div> 
                            <div class="items">
                                <div class="title">Zdawalnosc</div><div class="circle">'.$procent.'</div>
                            </div> 
                        </div>
                        <div class="title">Wykres wykonanych quizow:</div>
                        <canvas id="chart"></canvas>
                    </div>
                </div>
                <div class="title-search">Twoje odznaki</div>
                <div class="row">
        ';
        for ($i=1;$i<=$sum/500;$i++) {
            echo "<img style='width: 200px;' src='app/images/medalion.png'>";
        }

        echo '
                </div>
                <div class="title-search">Quizy uzytkownika</div>
                <div class="listQuizesGroup">
                    <button><i class="fas fa-arrow-left"></i></button>
                    <div class="listQuizes"></div>
                    <button><i class="fas fa-arrow-right"></i></button>
                </div>
                <div class="search-group">
                    <div class="title-search">Wyszukaj użytkowników</div>
                    <div class="search">
                        <input type="search" class="searchbtn">
                        <button><i class="fas fa-search"></i></button>
                    </div>
                    <div class="option-search">
                    </div>
                </div>
            </div>';
        echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.js" integrity="sha512-b3xr4frvDIeyC3gqR1/iOi6T+m3pLlQyXNuvn5FiRrrKiMUJK3du2QqZbCywH6JxS5EOfW0DY0M6WwdXFbCBLQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>';
        echo '<script src="app/js/wykres.js"></script>';
        echo '<script src="app/js/search.js"></script>';
    }
    function createQuiz() {
        echo<<< _END
            <div class="modal">
                <div class="pop"></div>
            </div>
            <div class="container min-height">
                <div class="row">
                    <div class="items md-1 quizer"></div>
                    <div class="items md-4">
                        <div class="clock">
                            Czas do końca: 
                            <div></div>
                            <button class="btncheck" >Zakoncz quiz.</button>
                            <img src="https://img.freepik.com/darmowe-wektory/quiz-w-komiksowym-stylu-pop-art_175838-505.jpg?size=626&ext=jpg">
                        </div>
                    </div>
                </div>
            </div>
            <script src="app/js/quiz-done.js"></script>
        _END;      
    }
    function createQuizTable() {
        echo<<< _END
            <div class="container min-height">
                <div class="addquiz"></div>
                <div class="row">
                    <div class="items md-4">
                        Sortowanie quizów:
                        <div class="sort">
                            <div><label><input type="radio" value="date" name="sort" checked>Data dodania</label></div>
                            <div><label><input type="radio" value="alphabet" name="sort">Alfabetycznie</label></div>
                        </div>
                    </div>
                    <div class="items md-1">
                        <div class="items-quiz"><div class="title" style="font-size: 1.6rem;">Dostepne quizy: </div>
                            <div class="quizcreate"></div>
                        </div>
                        <div class="pages">
                            <button id="previous_page"><i class="fas fa-arrow-left"></i></button>
                            <span id="number_page">1</span>
                            <button id="next_page"><i class="fas fa-arrow-right"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <script src="app/js/quiz.js"></script>
        _END;
    }

    function createCreateQuiz() {
        echo '<div class="container min-height">
                <div class="questionTable">
                    <input type="text" id="titleQuest" placeholder="Wpisz nazwe quizu">(wymagane)
                </div>
                <div class="createquiz"></div>
                <div class="cetnerBtnGroup">
                    <button class="btnaddQuestion">Dodaj pytanie</button>
                    <button class="btnCreateQuiz">Stworz quiz</button>
                </div>
            </div>
            <script src="app/js/createquiz.js"></script>
        ';
    }


    function createNotFindSite() {
        echo<<< _END
            <div class="container min-height">
                <div class="row">
                        <div class="items">
                            <img src="https://polskiearaby.com/wp-content/uploads/2020/12/Error-404.png">
                        </div>
                        <div class="items" style="max-width: 350px; padding: 20px;"><h1>Error 404</h1>
                            <h3>Nie odnalezlismy strony której szukasz. Prawdopodobnie nie posiadamy tej strony lub została usunięta. Jeżeli ona powinna być napisz do nas!<h3> 
                        </div>
                </div>
            </div>
        _END;           
    }
}
?>