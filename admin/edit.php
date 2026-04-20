<?php
$page_title = "Edit Admin";
include '../includes/header.php';

if (!isset($_SESSION['id'])) {
    header('Location: /admin/login.php');
    exit;
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: /admin/dashboard.php');
    exit;
}

$id = (int) $_GET['id'];
$errorMessage = '';
$successMessage = '';

// get existing user
$query = "SELECT id, email FROM users WHERE id = ? LIMIT 1";
$stmt = $db->prepare($query);
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

if (!$user) {
    header('Location: /admin/dashboard.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($email)) {
        $errorMessage = 'Email cannot be empty';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage = 'Please enter a valid email address';
    } else {
        if (!empty($password)) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $updateQuery = "UPDATE users SET email = ?, password = ? WHERE id = ?";
            $updateStmt = $db->prepare($updateQuery);
            $updateStmt->bind_param('ssi', $email, $hashedPassword, $id);
        } else {
            $updateQuery = "UPDATE users SET email = ? WHERE id = ?";
            $updateStmt = $db->prepare($updateQuery);
            $updateStmt->bind_param('si', $email, $id);
        }

        if ($updateStmt->execute()) {
            $successMessage = 'Admin updated successfully';
            $user['email'] = $email;
        } else {
            $errorMessage = 'Error updating admin';
        }

        $updateStmt->close();
    }
}
?>

<?php include '../includes/navbar.php'; ?>

<div class="container mt-4" style="max-width: 700px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Edit Admin</h1>
        <a href="/admin/dashboard.php" class="btn btn-secondary">Back</a>
    </div>

    <?php if (!empty($errorMessage)): ?>
        <div class="alert alert-danger">
            <?= $errorMessage ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($successMessage)): ?>
        <div class="alert alert-success">
            <?= $successMessage ?>
        </div>
    <?php endif; ?>

    <div class="card p-4 shadow-sm">
        <form action="" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Admin Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    class="form-control"
                    value="<?= $user['email'] ?>"
                >
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">New Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-control"
                >
                <div class="form-text">Leave blank if you do not want to change the password.</div>
            </div>

            <button type="submit" class="btn btn-primary">Update Admin</button>
        </form>
    </div>
</div>

<?php include '../includes/footer.php'; ?>