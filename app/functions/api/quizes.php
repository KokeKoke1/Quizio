<?php

require_once("connect-mysql.php");
session_start();

if (isset($_GET["author"])) {
    $id = $_GET["author"];
    if ($id == "null") {
        $id = $_SESSION["id"];
    }
    $result = $mysql->query("SELECT * FROM `quizes` WHERE `ID_AUTHOR` = $id");
    $mysqarray = [];
    while($row = $result->fetch_assoc()) {
        $mysqarray[] = $row;
    }
    echo json_encode($mysqarray);
} else if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $result = $mysql->query("SELECT `question` FROM `questions` WHERE `ID_QUIZ` = $id");
    $mysqarray = [];
    while($row = $result->fetch_assoc()) {
        $mysqarray[] = $row;
    }
    echo json_encode($mysqarray);
} else {
    $limit = ($_GET["page"]-1)*15; //SELECT `quizes`.*,`accounts`.`name` FROM `quizes` INNER JOIN `accounts` ON `quizes`.`ID_AUTHOR` = `accounts`.`ID`

    if ($_GET["sort"] == 0) { $result = $mysql->query("SELECT `quizes`.*,`accounts`.`name` FROM `quizes` INNER JOIN `accounts` ON `quizes`.`ID_AUTHOR` = `accounts`.`ID` GROUP BY ID DESC LIMIT $limit, 15"); }
    else { $result = $mysql->query("SELECT `quizes`.*,`accounts`.`name` FROM `quizes` INNER JOIN `accounts` ON `quizes`.`ID_AUTHOR` = `accounts`.`ID` GROUP BY title ASC LIMIT $limit, 15"); }
    $mysqarray = [];
    while($row = $result->fetch_assoc()) {
        $mysqarray[] = $row;
    }
    $result = $mysql->query("SELECT COUNT(*) FROM `quizes`");
    $row = $result->fetch_assoc();
    $mysqarray[] = $row["COUNT(*)"];
    echo json_encode($mysqarray);
}


?>


