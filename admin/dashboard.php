<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>

<?php
$query = "SELECT id, email FROM users ORDER BY id DESC";
$stmt = $db->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
$admins = $result->fetch_all(MYSQLI_ASSOC);
?>

<style>
    .admin-layout {
        display: flex;
        min-height: 85vh;
        margin-top: 30px;
        gap: 25px;
    }

    .admin-sidebar {
        width: 230px;
        background: #fff;
        border: 1px solid #e5e5e5;
        border-radius: 12px;
        padding: 20px 15px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        height: fit-content;
    }

    .admin-sidebar h3 {
        font-size: 18px;
        margin-bottom: 20px;
        color: #1e1e2f;
    }

    .admin-sidebar a {
        display: block;
        text-decoration: none;
        color: #333;
        padding: 12px 14px;
        border-radius: 8px;
        margin-bottom: 10px;
        transition: 0.2s;
        font-weight: 500;
    }

    .admin-sidebar a:hover,
    .admin-sidebar a.active {
        background: #1e1e2f;
        color: white;
    }

    .admin-main {
        flex: 1;
        background: white;
        border: 1px solid #e5e5e5;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
    }

    .admin-topbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        flex-wrap: wrap;
        gap: 15px;
    }

    .admin-topbar h1 {
        margin: 0;
        font-size: 28px;
        color: #1e1e2f;
    }

    .admin-topbar p {
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

    .admin-table-wrapper {
        overflow-x: auto;
    }

    .admin-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 850px;
    }

    .admin-table th,
    .admin-table td {
        text-align: left;
        padding: 14px 12px;
        border-bottom: 1px solid #eee;
        font-size: 14px;
    }

    .admin-table th {
        background: #f8f9fb;
        color: #1e1e2f;
        font-weight: 600;
    }

    .admin-table tr:hover {
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

    .status-badge {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        background: #e8f7ee;
        color: #198754;
    }

    @media (max-width: 900px) {
        .admin-layout {
            flex-direction: column;
        }

        .admin-sidebar {
            width: 100%;
        }
    }
</style>

<div class="container">
    <div class="admin-layout">

        <aside class="admin-sidebar">
            <h3>Dashboard</h3>
            <a href="<?= app_url('events/dashboard.php') ?>">Events</a>
            <a href="<?= app_url('venues/dashboard.php') ?>">Venues</a>
            <a href="<?= app_url('vendors/dashboard.php') ?>">Vendors</a>
            <a href="<?= app_url('admin/dashboard.php') ?>" class="active">Admins</a>
        </aside>

        <main class="admin-main">
        <div class="admin-topbar">
            <div>
                <h1>Admin Dashboard</h1>
                <p>Manage admins, events, venues, and vendors from one place</p>
            </div>

            <div style="display:flex; gap:10px; flex-wrap:wrap;">
                <a href="<?= app_url('admin/dashboard.php') ?>" class="btn-main" style="background:#6c757d;">
                    Home
                </a>

                <a href="<?= app_url('admin/add.php') ?>" class="btn-main">
                    + Add Admin
                </a>

                <form action="<?= app_url('admin/logout.php') ?>" method="post" style="margin:0;">
                    <button class="btn-main" style="background:#dc3545;">
                        Logout
                    </button>
                </form>
            </div>
        </div>

            <div class="admin-table-wrapper">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($admins as $admin): ?>
                            <tr>
                                <td><?= $admin['id'] ?></td>
                                <td><?= $admin['email'] ?></td>
                                <td><span class="status-badge">Active</span></td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="<?= app_url('admin/edit.php') ?>?id=<?= $admin['id'] ?>" class="btn-sm btn-edit">Edit</a>
                                        <a href="<?= app_url('admin/delete.php') ?>?id=<?= $admin['id'] ?>" class="btn-sm btn-delete">Delete</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                        <?php if(empty($admins)): ?>
                            <tr>
                                <td colspan="4">No admins found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </main>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
