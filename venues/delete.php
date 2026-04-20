<?php
require_once('../config/db.php');
$conn = db();

$id = $_GET['id'];

// Prepare delete statement
$stmt = $conn->prepare("DELETE FROM venues WHERE venue_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: dashboard.php");
exit;
?>
