<?php
$page_title = "Delete Admin";
include '../includes/header.php';

if (!isset($_SESSION['id'])) {
    header('Location: ' . app_url('admin/login.php'));
    exit;
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: ' . app_url('admin/dashboard.php'));
    exit;
}

$id = (int) $_GET['id'];
$errorMessage = '';

// get user first
$query = "SELECT id, email FROM users WHERE id = ? LIMIT 1";
$stmt = $db->prepare($query);
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

if (!$user) {
    header('Location: ' . app_url('admin/dashboard.php'));
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $deleteQuery = "DELETE FROM users WHERE id = ?";
    $deleteStmt = $db->prepare($deleteQuery);
    $deleteStmt->bind_param('i', $id);

    if ($deleteStmt->execute()) {
        $deleteStmt->close();
        header('Location: ' . app_url('admin/dashboard.php'));
        exit;
    } else {
        $errorMessage = 'Error deleting admin';
    }

    $deleteStmt->close();
}
?>

<?php include '../includes/navbar.php'; ?>

<div class="container mt-4" style="max-width: 700px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Delete Admin</h1>
        <a href="<?= app_url('admin/dashboard.php') ?>" class="btn btn-secondary">Back</a>
    </div>

    <?php if (!empty($errorMessage)): ?>
        <div class="alert alert-danger">
            <?= $errorMessage ?>
        </div>
    <?php endif; ?>

    <div class="card p-4 shadow-sm">
        <p>Are you sure you want to delete this admin?</p>

        <ul>
            <li><strong>ID:</strong> <?= $user['id'] ?></li>
            <li><strong>Email:</strong> <?= $user['email'] ?></li>
        </ul>

        <form action="" method="post" class="d-flex gap-2">
            <button type="submit" class="btn btn-danger">Yes, Delete</button>
            <a href="<?= app_url('admin/dashboard.php') ?>" class="btn btn-outline-secondary">Cancel</a>
        </form>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
