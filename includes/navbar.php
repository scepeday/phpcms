<style>
    .sidebar {
        width: 230px;
        height: 100vh;
        background: #1e1e2f;
        color: white;
        position: fixed;
        top: 0;
        left: 0;
        padding-top: 20px;
    }

    .sidebar h2 {
        text-align: center;
        margin-bottom: 30px;
        font-size: 22px;
        letter-spacing: 1px;
    }

    .sidebar a {
        display: block;
        padding: 12px 20px;
        color: #dcdcdc;
        text-decoration: none;
        font-size: 16px;
        transition: 0.2s;
    }

    .sidebar a:hover {
        background: #34344a;
        color: #fff;
    }

    .content {
        margin-left: 250px;
        padding: 20px;
    }
</style>

<div class="sidebar">
    <h2>EventHub CMS</h2>

    <a href="<?= app_url('events/dashboard.php') ?>">Events</a>
    <a href="<?= app_url('venues/dashboard.php') ?>">Venues</a>
    <a href="<?= app_url('vendors/dashboard.php') ?>">Vendors</a>
    <a href="<?= app_url('admin/dashboard.php') ?>">Admins</a>
</div>

<div class="content">
