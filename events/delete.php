<?php
include_once(__DIR__ . '/../includes/header.php');

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: dashboard.php");
    exit;
}

$id = (int) $_GET['id'];

// Optional: check if event exists first
$check = $db->prepare("SELECT id FROM events WHERE id = ?");
$check->bind_param("i", $id);
$check->execute();
$result = $check->get_result();

if ($result->num_rows === 0) {
    $check->close();
    header("Location: dashboard.php");
    exit;
}
$check->close();

// Delete event
$query = "DELETE FROM events WHERE id = ?";
$stmt = $db->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->close();

header("Location: dashboard.php");
exit;
?>