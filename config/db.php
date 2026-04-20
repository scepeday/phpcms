<?php
$host = 'localhost';
$dbname = 'eventhub-db';
$user = 'root';
$password = 'root';
$port = 8888;

$db = new mysqli($host, $user, $password, $dbname, $port);

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
?>