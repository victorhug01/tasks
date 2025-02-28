<?php


define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_DATABASE", "shoppinglist");

$mysqli = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

if ($mysqli->connect_errno) {
    echo "Falha na conexão: (" . $mysqli->connect_errno . ") " . $mysqli->connect_errno;
}

?>