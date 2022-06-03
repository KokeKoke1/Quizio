<?php

$pkt = 0;
$x = 0;
require_once("api/connect-mysql.php");

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $result = $mysql->query("SELECT `question` FROM `questions` WHERE `ID_QUIZ` = $id");

    $mysqarray = [];
    while($row = $result->fetch_assoc()) {
        $row = json_decode($row["question"]);
        array_push($mysqarray, $row->{'coretant'});
        $x++;
    }
}
$obj = json_decode($_GET["lista"]);

for ($i=0; $i<sizeof($obj->{'lista'}); $i++) {
    if ($obj->{'lista'}[$i] != null) {
        if ( intval(substr($obj->{'lista'}[$i], 0, 1)) == $mysqarray[$i] ) {
            $pkt++;
        }
    }
}
$array = array (
    "pkt" => $pkt,
    "max" => $x
);
echo json_encode($array);
?>