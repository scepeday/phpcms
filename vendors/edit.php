<?php
$page_title = "Edit Vendor";
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
$successMessage = '';

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
    $name = trim($_POST['name'] ?? '');
    $serviceType = trim($_POST['service_type'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');

    if ($name === '' || $serviceType === '' || $email === '' || $phone === '') {
        $errorMessage = 'All vendor fields are required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage = 'Please enter a valid email address';
    } else {
        $updateQuery = "UPDATE vendors SET name = ?, service_type = ?, email = ?, phone = ? WHERE id = ?";
        $updateStmt = $db->prepare($updateQuery);
        $updateStmt->bind_param('ssssi', $name, $serviceType, $email, $phone, $id);

        if ($updateStmt->execute()) {
            $successMessage = 'Vendor updated successfully';
            $vendor['name'] = $name;
            $vendor['service_type'] = $serviceType;
            $vendor['email'] = $email;
            $vendor['phone'] = $phone;
        } else {
            $errorMessage = 'Error updating vendor';
        }

        $updateStmt->close();
    }
}
?>

<?php include '../includes/navbar.php'; ?>

<div class="container mt-4" style="max-width: 700px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Edit Vendor</h1>
        <a href="<?= app_url('vendors/dashboard.php') ?>" class="btn btn-secondary">Back</a>
    </div>

    <?php if ($errorMessage !== ''): ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($errorMessage) ?>
        </div>
    <?php endif; ?>

    <?php if ($successMessage !== ''): ?>
        <div class="alert alert-success">
            <?= htmlspecialchars($successMessage) ?>
        </div>
    <?php endif; ?>

    <div class="card p-4 shadow-sm">
        <form action="" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Vendor Name</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    class="form-control"
                    value="<?= htmlspecialchars($vendor['name']) ?>"
                >
            </div>

            <div class="mb-3">
                <label for="service_type" class="form-label">Service Type</label>
                <input
                    type="text"
                    id="service_type"
                    name="service_type"
                    class="form-control"
                    value="<?= htmlspecialchars($vendor['service_type']) ?>"
                >
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    class="form-control"
                    value="<?= htmlspecialchars($vendor['email']) ?>"
                >
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input
                    type="text"
                    id="phone"
                    name="phone"
                    class="form-control"
                    value="<?= htmlspecialchars($vendor['phone']) ?>"
                >
            </div>

            <button type="submit" class="btn btn-primary">Update Vendor</button>
        </form>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
