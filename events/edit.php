<?php
$page_title = "Edit Event";
include_once(__DIR__ . '/../includes/header.php');
include_once(__DIR__ . '/../includes/navbar.php');

$errorMessage = '';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: dashboard.php");
    exit;
}

$id = (int) $_GET['id'];

$query = "SELECT * FROM events WHERE id = ?";
$stmt = $db->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$event = $result->fetch_assoc();
$stmt->close();

if (!$event) {
    header("Location: dashboard.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $event_name = trim($_POST['event_name'] ?? '');
    $event_type = trim($_POST['event_type'] ?? '');
    $event_date = trim($_POST['event_date'] ?? '');
    $event_time = trim($_POST['event_time'] ?? '');
    $description = trim($_POST['description'] ?? '');

    if (empty($event_name) || empty($event_type) || empty($event_date) || empty($event_time) || empty($description)) {
        $errorMessage = 'Please fill in all fields.';
    } else {
        $updateQuery = "UPDATE events
                        SET event_name = ?, event_type = ?, event_date = ?, event_time = ?, description = ?
                        WHERE id = ?";
        $updateStmt = $db->prepare($updateQuery);
        $updateStmt->bind_param("sssssi", $event_name, $event_type, $event_date, $event_time, $description, $id);

        if ($updateStmt->execute()) {
            $updateStmt->close();
            header("Location: dashboard.php");
            exit;
        } else {
            $errorMessage = 'Failed to update event.';
        }

        $updateStmt->close();
    }
}
?>

<div class="container mt-5">
    <h1 class="mb-4">Edit Event</h1>

    <?php if (!empty($errorMessage)): ?>
        <div class="alert alert-danger"><?= $errorMessage; ?></div>
    <?php endif; ?>

    <form method="post" action="">
        <div class="mb-3">
            <label class="form-label">Event Name</label>
            <input
                type="text"
                name="event_name"
                class="form-control"
                value="<?= $_POST['event_name'] ?? $event['event_name']; ?>"
            >
        </div>

        <div class="mb-3">
            <label class="form-label">Event Type</label>
            <input
                type="text"
                name="event_type"
                class="form-control"
                value="<?= $_POST['event_type'] ?? $event['event_type']; ?>"
            >
        </div>

        <div class="mb-3">
            <label class="form-label">Event Date</label>
            <input
                type="date"
                name="event_date"
                class="form-control"
                value="<?= $_POST['event_date'] ?? $event['event_date']; ?>"
            >
        </div>

        <div class="mb-3">
            <label class="form-label">Event Time</label>
            <input
                type="time"
                name="event_time"
                class="form-control"
                value="<?= $_POST['event_time'] ?? $event['event_time']; ?>"
            >
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4"><?= $_POST['description'] ?? $event['description']; ?></textarea>
        </div>

        <button type="submit" class="btn btn-success">Update Event</button>
        <a href="dashboard.php" class="btn btn-secondary">Back</a>
    </form>
</div>

<?php include_once(__DIR__ . '/../includes/footer.php'); ?>