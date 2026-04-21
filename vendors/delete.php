<?php
$page_title = "Delete Vendor";
include '../includes/header.php';

if (!isset($_SESSION['id'])) {
    header('Location: ' . app_url('admin/login.php'));
    exit;
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: ' . app_url('vendors/dashboard.php'));
    exit;
}

$id = (int) $_GET['id'];
$errorMessage = '';

$query = "SELECT id, name, service_type, email, phone FROM vendors WHERE id = ? LIMIT 1";
$stmt = $db->prepare($query);
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
$vendor = $result->fetch_assoc();
$stmt->close();

if (!$vendor) {
    header('Location: ' . app_url('vendors/dashboard.php'));
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $deleteQuery = "DELETE FROM vendors WHERE id = ?";
    $deleteStmt = $db->prepare($deleteQuery);
    $deleteStmt->bind_param('i', $id);

    if ($deleteStmt->execute()) {
        $deleteStmt->close();
        header('Location: ' . app_url('vendors/dashboard.php'));
        exit;
    }

    $errorMessage = 'Error deleting vendor';
    $deleteStmt->close();
}
?>

<?php include '../includes/navbar.php'; ?>

<div class="container mt-4" style="max-width: 700px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Delete Vendor</h1>
        <a href="<?= app_url('vendors/dashboard.php') ?>" class="btn btn-secondary">Back</a>
    </div>

    <?php if ($errorMessage !== ''): ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($errorMessage) ?>
        </div>
    <?php endif; ?>

    <div class="card p-4 shadow-sm">
        <p>Are you sure you want to delete this vendor?</p>

        <ul>
            <li><strong>ID:</strong> <?= $vendor['id'] ?></li>
            <li><strong>Name:</strong> <?= htmlspecialchars($vendor['name']) ?></li>
            <li><strong>Service:</strong> <?= htmlspecialchars($vendor['service_type']) ?></li>
            <li><strong>Email:</strong> <?= htmlspecialchars($vendor['email']) ?></li>
            <li><strong>Phone:</strong> <?= htmlspecialchars($vendor['phone']) ?></li>
        </ul>

        <form action="" method="post" class="d-flex gap-2">
            <button type="submit" class="btn btn-danger">Yes, Delete</button>
            <a href="<?= app_url('vendors/dashboard.php') ?>" class="btn btn-outline-secondary">Cancel</a>
        </form>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
