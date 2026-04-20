<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>

<style>
    .dashboard-container {
        margin-top: 40px;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 25px;
        max-width: 900px;
    }

    .dash-card {
        background: white;
        padding: 30px;
        border-radius: 10px;
        text-align: center;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        transition: 0.2s;
        cursor: pointer;
        border: 1px solid #e5e5e5;
    }

    .dash-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .dash-card h2 {
        margin: 0;
        font-size: 22px;
        color: #1e1e2f;
    }

    .dash-card p {
        margin-top: 10px;
        color: #555;
        font-size: 15px;
    }
</style>

<div class="container">
    <h1>Welcome to EventHub CMS</h1>
    <p>Select a module to manage:</p>

    <div class="dashboard-container">

        <a href="/events/dashboard.php" style="text-decoration:none; color:inherit;">
            <div class="dash-card">
                <h2>Events</h2>
                <p>Create, view, edit, and delete events</p>
            </div>
        </a>

        <a href="/venues/dashboard.php" style="text-decoration:none; color:inherit;">
            <div class="dash-card">
                <h2>Venues</h2>
                <p>Manage event locations and capacity</p>
            </div>
        </a>

        <a href="/vendors/dashboard.php" style="text-decoration:none; color:inherit;">
            <div class="dash-card">
                <h2>Vendors</h2>
                <p>Add and update service providers</p>
            </div>
        </a>

        <a href="/admins/dashboard.php" style="text-decoration:none; color:inherit;">
            <div class="dash-card">
                <h2>Admins</h2>
                <p>Manage admin accounts and permissions</p>
            </div>
        </a>

    </div>
</div>

<?php include '../includes/footer.php'; ?>
