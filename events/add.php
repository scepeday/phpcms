<?php
$page_title = "Add Event";
include_once(__DIR__ . '/../includes/header.php');
require_once(__DIR__ . '/../config/db.php');

$errorMessage = '';
$successMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $event_name = trim($_POST['event_name'] ?? '');
    $event_type = trim($_POST['event_type'] ?? '');
    $event_date = trim($_POST['event_date'] ?? '');
    $event_time = trim($_POST['event_time'] ?? '');
    $description = trim($_POST['description'] ?? '');

    if (empty($event_name) || empty($event_type) || empty($event_date) || empty($event_time) || empty($description)) {
        $errorMessage = 'Please fill in all fields.';
    } else {
        $query = "INSERT INTO events (event_name, event_type, event_date, event_time, description)
                  VALUES (?, ?, ?, ?, ?)";
        $stmt = $db->prepare($query);
        $stmt->bind_param("sssss", $event_name, $event_type, $event_date, $event_time, $description);

        if ($stmt->execute()) {
            header("Location: list.php?success=1");
            exit;
        } else {
            $errorMessage = 'Failed to add event.';
        }

        $stmt->close();
    }
}
?>

<div class="container mt-5">
    <h1 class="mb-4">Add Event</h1>

    <?php if (!empty($errorMessage)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($errorMessage); ?></div>
    <?php endif; ?>

    <form method="post" action="">
        <div class="mb-3">
            <label class="form-label">Event Name</label>
            <input type="text" name="event_name" class="form-control" value="<?= htmlspecialchars($_POST['event_name'] ?? ''); ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Event Type</label>
            <input type="text" name="event_type" class="form-control" value="<?= htmlspecialchars($_POST['event_type'] ?? ''); ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Event Date</label>
            <input type="date" name="event_date" class="form-control" value="<?= htmlspecialchars($_POST['event_date'] ?? ''); ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Event Time</label>
            <input type="time" name="event_time" class="form-control" value="<?= htmlspecialchars($_POST['event_time'] ?? ''); ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4"><?= htmlspecialchars($_POST['description'] ?? ''); ?></textarea>
        </div>

        <button type="submit" class="btn btn-success">Add Event</button>
        <a href="dashboard.php" class="btn btn-secondary">Back</a>
    </form>
</div>

<?php include_once(__DIR__ . '/../includes/footer.php'); ?>