<?php

require_once("app/functions/main.php");
require_once("app/functions/api/connect-mysql.php");

session_start();

$main = new Main();

$main->createHead();
$main->createNav();

if (empty($_GET)) {
    require_once("app/functions/index.php");
}
else if (isset($_GET["news"])) {
    $main->createNavigation("Aktualnosci");
    require_once("app/functions/news.php");
}
else if (isset($_GET["profile"])) {
    if (isset($_GET["p"])) {
        $name = $main->getNameUser($_GET["p"], $mysql);
        $p = $_GET["p"];
        if ($name != null) {
            $main->createNavigation("Profil: ".$name);
            $main->createProfile($p, $mysql);
        } else {
            $main->createNavigation("Error");
            $main->createNotFindSite();
        }
    } else {
        if (isset($_SESSION["login"])) {
            $main->createNavigation("Profil: ".$_SESSION["login"]);
            $main->createProfile("", $mysql);
        } else {
            $main->createNavigation("Profil: Koke");
            $main->createProfile($_GET["p"], $mysql);            
        }
    }
}
else if (isset($_GET["login"])) {
    if (!isset($_SESSION["login"])) {
        $main->createNavigation("Logowanie i rejestracja");
        $main->createFormLogin();
    } else {
        header("Location: ?profile");
    }
}
else if (isset($_GET["quiz"])) {
    if (isset($_GET["id"])) {
        $title = $_GET["title"];
        $main->createNavigation("<a href='?quiz'>Quiz</a> / $title");
        $main->createQuiz();
    } else {
        $main->createNavigation("Quiz");
        $main->createQuizTable();
    }
}
else if (isset($_GET["kontakt"])) {
    $main->createNavigation("Kontakt");
}
else if (isset($_GET["create-quiz"])) {
    $main->createNavigation("Stworz quiz");
    $main->createCreateQuiz();
}
else if (isset($_GET["logout"])) {
    session_destroy();
    header("Location: ?");
}
else {
    $main->createNotFindSite();
}
$main->createFooter();

?>