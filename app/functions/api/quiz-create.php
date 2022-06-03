<?php

    session_start();
    $id_user = $_SESSION["id"];
    require_once("connect-mysql.php");

    $input = json_decode(file_get_contents('php://input'), true);
    $data = json_decode($input["data"]);

    $name = $data->{"title"};

    // for ($i=0;$i<sizeof($data->{"question"});$i++) {
    //     $question = json_encode($data->{"question"}[$i]);
    //     echo $data->{"question"}[$i]->{"question"};
    //     echo $question."<br>";
    // }


    $result = $mysql->query("SELECT COUNT(*) FROM `quizes`");
    $row = $result->fetch_assoc();
    $id = $row["COUNT(*)"]+1;
    $result = $mysql->query("INSERT INTO `quizes` (`ID`, `ID_AUTHOR`, `title`) VALUES ($id, '$id_user', '$name');");


    for ($i=0;$i<sizeof($data->{"question"});$i++) {
        $question = json_encode($data->{"question"}[$i]);
        $mysql->query("INSERT INTO `questions` (`ID`, `ID_QUIZ`, `question`) VALUES (NULL, '$id', '$question');");
    }

?>