<?php
$host = 'localhost';
$dbname = 'eventhub-db';
$user = 'root';
$password = '';
$port = 3306;

$db = new mysqli($host, $user, $password, $dbname, $port);

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
?>
