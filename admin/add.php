<?php
$page_title = "Add Admin";
include '../includes/header.php';

if (!isset($_SESSION['id'])) {
    header('Location: /admin/login.php');
    exit;
}

$errorMessage = '';
$successMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($email) || empty($password)) {
        $errorMessage = 'Email and password are required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage = 'Invalid email format';
    } else {

        // check if email already exists
        $checkQuery = "SELECT id FROM users WHERE email = ? LIMIT 1";
        $checkStmt = $db->prepare($checkQuery);
        $checkStmt->bind_param('s', $email);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();

        if ($checkResult->num_rows > 0) {
            $errorMessage = 'Email already exists';
        } else {

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $query = "INSERT INTO users (email, password) VALUES (?, ?)";
            $stmt = $db->prepare($query);
            $stmt->bind_param('ss', $email, $hashedPassword);

            if ($stmt->execute()) {
                // redirect back to dashboard after success
                header('Location: /admin/dashboard.php');
                exit;
            } else {
                $errorMessage = 'Error adding admin';
            }

            $stmt->close();
        }

        $checkStmt->close();
    }
}
?>

<?php include '../includes/navbar.php'; ?>

<div class="container mt-4" style="max-width: 700px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Add Admin</h1>
        <a href="/admin/dashboard.php" class="btn btn-secondary">Back</a>
    </div>

    <?php if (!empty($errorMessage)): ?>
        <div class="alert alert-danger">
            <?= $errorMessage ?>
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
                >
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-control"
                >
            </div>

            <button type="submit" class="btn btn-primary">
                Create Admin
            </button>

        </form>
    </div>
</div>

<?php include '../includes/footer.php'; ?>