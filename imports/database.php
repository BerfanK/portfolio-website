<?php

$hostname = "moya.black.host";
$username = "protecor_nykloon";
$password = "gDU@\$F]f]1+D";
$database = "protecor_portfolio";

// Create connection
$conn = new mysqli($hostname, $username, $password, $database);
$conn->set_charset("utf8");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>