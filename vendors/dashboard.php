<?php
$page_title = "Vendor Dashboard";
include '../includes/header.php';

if (!isset($_SESSION['id'])) {
    header('Location: ' . app_url('admin/login.php'));
    exit;
}

$query = "SELECT id, name, service_type, email, phone FROM vendors ORDER BY id DESC";
$stmt = $db->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
$vendors = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<?php include '../includes/navbar.php'; ?>

<style>
    .module-layout {
        display: flex;
        min-height: 85vh;
        margin-top: 30px;
        gap: 25px;
    }

    .module-sidebar {
        width: 230px;
        background: #fff;
        border: 1px solid #e5e5e5;
        border-radius: 12px;
        padding: 20px 15px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        height: fit-content;
    }

    .module-sidebar h3 {
        font-size: 18px;
        margin-bottom: 20px;
        color: #1e1e2f;
    }

    .module-sidebar a {
        display: block;
        text-decoration: none;
        color: #333;
        padding: 12px 14px;
        border-radius: 8px;
        margin-bottom: 10px;
        transition: 0.2s;
        font-weight: 500;
    }

    .module-sidebar a:hover,
    .module-sidebar a.active {
        background: #1e1e2f;
        color: white;
    }

    .module-main {
        flex: 1;
        background: white;
        border: 1px solid #e5e5e5;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
    }

    .module-topbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        flex-wrap: wrap;
        gap: 15px;
    }

    .module-topbar h1 {
        margin: 0;
        font-size: 28px;
        color: #1e1e2f;
    }

    .module-topbar p {
        margin: 5px 0 0;
        color: #666;
        font-size: 14px;
    }

    .btn-main {
        background: #1e1e2f;
        color: white;
        padding: 10px 18px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        border: none;
        cursor: pointer;
        transition: 0.2s;
    }

    .btn-main:hover {
        background: #343456;
    }

    .module-table-wrapper {
        overflow-x: auto;
    }

    .module-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 850px;
    }

    .module-table th,
    .module-table td {
        text-align: left;
        padding: 14px 12px;
        border-bottom: 1px solid #eee;
        font-size: 14px;
    }

    .module-table th {
        background: #f8f9fb;
        color: #1e1e2f;
        font-weight: 600;
    }

    .module-table tr:hover {
        background: #fafafa;
    }

    .action-buttons {
        display: flex;
        gap: 8px;
    }

    .btn-sm {
        padding: 7px 12px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 500;
        border: none;
        cursor: pointer;
    }

    .btn-edit {
        background: #e9f2ff;
        color: #0d6efd;
    }

    .btn-delete {
        background: #ffe9e9;
        color: #dc3545;
    }

    .service-badge {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        background: #e8f7ee;
        color: #198754;
    }

    @media (max-width: 900px) {
        .module-layout {
            flex-direction: column;
        }

        .module-sidebar {
            width: 100%;
        }
    }
</style>

<div class="container">
    <div class="module-layout">
        <aside class="module-sidebar">
            <h3>Dashboard</h3>
            <a href="<?= app_url('events/dashboard.php') ?>">Events</a>
            <a href="<?= app_url('venues/dashboard.php') ?>">Venues</a>
            <a href="<?= app_url('vendors/dashboard.php') ?>" class="active">Vendors</a>
            <a href="<?= app_url('admin/dashboard.php') ?>">Admins</a>
        </aside>

        <main class="module-main">
            <div class="module-topbar">
                <div>
                    <h1>Vendor Dashboard</h1>
                    <p>Manage service providers for catering, photography, decor, and more</p>
                </div>

                <div style="display:flex; gap:10px; flex-wrap:wrap;">
                    <a href="<?= app_url('vendors/dashboard.php') ?>" class="btn-main" style="background:#6c757d;">
                        Home
                    </a>

                    <a href="<?= app_url('vendors/add.php') ?>" class="btn-main">
                        + Add Vendor
                    </a>
                </div>
            </div>

            <div class="module-table-wrapper">
                <table class="module-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Service</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($vendors as $vendor): ?>
                            <tr>
                                <td><?= $vendor['id'] ?></td>
                                <td><?= htmlspecialchars($vendor['name']) ?></td>
                                <td><span class="service-badge"><?= htmlspecialchars($vendor['service_type']) ?></span></td>
                                <td><?= htmlspecialchars($vendor['email']) ?></td>
                                <td><?= htmlspecialchars($vendor['phone']) ?></td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="<?= app_url('vendors/edit.php') ?>?id=<?= $vendor['id'] ?>" class="btn-sm btn-edit">Edit</a>
                                        <a href="<?= app_url('vendors/delete.php') ?>?id=<?= $vendor['id'] ?>" class="btn-sm btn-delete">Delete</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                        <?php if (empty($vendors)): ?>
                            <tr>
                                <td colspan="6">No vendors found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
