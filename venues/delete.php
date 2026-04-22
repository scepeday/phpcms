<?php
include '../includes/header.php';

$id = (int)($_GET['id'] ?? 0);

if ($id <= 0) {
    header("Location: dashboard.php");
    exit;
}

// Optional: check if venue exists first
$stmt = $db->prepare("SELECT venue_id FROM venues WHERE venue_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $stmt->close();
    header("Location: dashboard.php");
    exit;
}
$stmt->close();

// Delete venue
$delete = $db->prepare("DELETE FROM venues WHERE venue_id = ?");
$delete->bind_param("i", $id);
$delete->execute();
$delete->close();

header("Location: dashboard.php");
exit;
?>