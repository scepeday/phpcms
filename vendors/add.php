<?php
$page_title = "Add Vendor";
include '../includes/header.php';

if (!isset($_SESSION['id'])) {
    header('Location: ' . app_url('admin/login.php'));
    exit;
}

$errorMessage = '';

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
        $query = "INSERT INTO vendors (name, service_type, email, phone) VALUES (?, ?, ?, ?)";
        $stmt = $db->prepare($query);
        $stmt->bind_param('ssss', $name, $serviceType, $email, $phone);

        if ($stmt->execute()) {
            $stmt->close();
            header('Location: ' . app_url('vendors/dashboard.php'));
            exit;
        }

        $errorMessage = 'Error adding vendor';
        $stmt->close();
    }
}
?>

<?php include '../includes/navbar.php'; ?>

<div class="container mt-4" style="max-width: 700px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Add Vendor</h1>
        <a href="<?= app_url('vendors/dashboard.php') ?>" class="btn btn-secondary">Back</a>
    </div>

    <?php if ($errorMessage !== ''): ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($errorMessage) ?>
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
                    value="<?= htmlspecialchars($_POST['name'] ?? '') ?>"
                >
            </div>

            <div class="mb-3">
                <label for="service_type" class="form-label">Service Type</label>
                <input
                    type="text"
                    id="service_type"
                    name="service_type"
                    class="form-control"
                    placeholder="Catering, Photography, Decor..."
                    value="<?= htmlspecialchars($_POST['service_type'] ?? '') ?>"
                >
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    class="form-control"
                    value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                >
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input
                    type="text"
                    id="phone"
                    name="phone"
                    class="form-control"
                    value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>"
                >
            </div>

            <button type="submit" class="btn btn-primary">Create Vendor</button>
        </form>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
