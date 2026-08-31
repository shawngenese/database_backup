<?php

$host = "localhost";
$username = "root";
$password = "myfedorasqlpasswordxd";
$dbname = "genese_db";

$connection = new mysqli($host, $username, $password, $dbname);

if ($connection->connect_error) {
    echo "Connection Error: " . $connection->connect_error;
}