<?php

require_once("connect-mysql.php");
session_start();

if ($_GET["function"] == "login") {
    if (isset($_GET["password"]) && isset($_GET["email"])) {
        $password = $_GET["password"];
        $password = md5($password);
        $email = $_GET["email"];
        $result = $mysql->query("SELECT * FROM `accounts` WHERE `password` = '$password' AND `email` = '$email'");
        if (!mysqli_num_rows($result) == 0) {
            $x = "yes";
            echo json_encode($x);
            $_SESSION["email"] = $email;
            $row = $result->fetch_assoc();
            $_SESSION["login"] = $row["name"];
            $_SESSION["id"] = $row["ID"];
        } else {
            $x = "null";        
            echo json_encode($x);
        }
    } else {
        $x = "null";        
        echo json_encode($x);
    }
}

if ($_GET["function"] == "register") {
    if (isset($_GET["name"]) && isset($_GET["email"])) {
        $email = $_GET["email"];
        $name = $_GET["name"];
        $password = $_GET["password"];
        $password = md5($password);
        $mysql->query("INSERT INTO `accounts` (`ID`, `email`, `password`, `name`) VALUES (NULL, '$email', '$password', '$name');");
    }
}

if ($_GET["function"] == "addquiztodone") {
    $id = $_SESSION["id"];
    $id_quiz = $_GET["quiz"];
    $id_pkt = $_GET["pkt"];
    $mysql->query("INSERT INTO `done_question` (`ID`, `ID_USER`, `ID_QUIZ`, `PROCENT`) VALUES (NULL, '$id', '$id_quiz', '$id_pkt')");
}
if ($_GET["function"] == "getscore") {
    if ($_GET["id"] != "") {
        $id = $_GET["id"];
    } else {
        $id = $_SESSION["id"];
    }
    $resultQuestion = $mysql->query("SELECT * FROM `done_question` JOIN `quizes` ON `quizes`.`ID` = `ID_QUIZ` WHERE `ID_USER` = $id;");
    while ($row = $resultQuestion->fetch_assoc()) {
        $json[] = $row;
    }
    $json[]["PROCENT"] = 0;
    echo json_encode($json);
}
if ($_GET["function"] == "getscorewy") {
    if ($_GET["id"] != "") {
        $id = $_GET["id"];
    } else {
        $id = $_SESSION["id"];
    }
    $nr = -1;
    $resultQuestion = $mysql->query("SELECT * FROM `done_question` JOIN `quizes` ON `quizes`.`ID` = `ID_QUIZ` WHERE `ID_USER` = $id ORDER BY `done_question`.`ID` DESC LIMIT 0, 10");

    while ($row = $resultQuestion->fetch_assoc()) {
        $x[] = $row;
        $nr++;
    }
    for ($i=$nr;$i>=0;$i--) {
        $json[] = $x[$i];
    }
    $json[]["PROCENT"] = 0;
   echo json_encode($json);
}

if ($_GET["function"] == "searchuser") {
    $name = $_GET["name"];
    $json = null;
    $result = $mysql->query("SELECT id,name FROM `accounts` WHERE `name` LIKE '%$name%'");
    while ($row = $result->fetch_assoc()) {
        $json[] = $row;
    }
    echo json_encode($json);
}

?>