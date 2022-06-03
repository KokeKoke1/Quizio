<?php

$config = array(

    "host" => "localhost",
    
    "username" => "root",

    "password" => "",
    
    "database" => "klasa4",
        
);

$mysql = new mysqli($config["host"], $config["username"], $config["password"], $config["database"]);

?>