<?php
$page_title = "Events";
include_once(__DIR__ . '/../includes/header.php');
include_once(__DIR__ . '/../includes/navbar.php');

$query = "SELECT * FROM events ORDER BY event_date ASC";
$result = $db->query($query);
?>

<div class="container mt-5">
    <h1 class="mb-4">Events</h1>

    <a href="add.php" class="btn btn-primary mb-3">Add Event</a>

    <?php if ($result && $result->num_rows > 0): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($event = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $event['event_name'] ?></td>
                        <td><?= $event['event_type'] ?></td>
                        <td><?= $event['event_date'] ?></td>
                        <td><?= $event['event_time'] ?></td>
                        <td>
                        <a href="edit.php?id=<?= $event['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="delete.php?id=<?= $event['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this event?');">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No events found.</p>
    <?php endif; ?>
</div>

<?php include_once(__DIR__ . '/../includes/footer.php'); ?>