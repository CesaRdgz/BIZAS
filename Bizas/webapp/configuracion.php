<?php
define("DB_SERVER", "db");
define("DB_USERNAME", "quevedo");
define("DB_PASSWORD", "quevedo");
define("DB_NAME", "quevedodb");


$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);


if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}