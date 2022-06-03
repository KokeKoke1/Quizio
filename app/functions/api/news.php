<?php

require_once("connect-mysql.php");

$result = $mysql->query("SELECT * FROM `news`");

$mysqarray = [];
while($row = $result->fetch_assoc()) {
    $mysqarray[] = $row;
}

echo json_encode($mysqarray);

?>