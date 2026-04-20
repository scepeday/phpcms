<?php 
include '../includes/header.php';
include '../includes/navbar.php';
require_once('../config/db.php');

$conn = db();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $conn->prepare("INSERT INTO venues (venue_name, address, city, capacity, contact_person, contact_email)
                            VALUES (?, ?, ?, ?, ?, ?)");

    $stmt->execute([
        $_POST['venue_name'],
        $_POST['address'],
        $_POST['city'],
        $_POST['capacity'],
        $_POST['contact_person'],
        $_POST['contact_email']
    ]);

    header("Location: dashboard.php");
    exit;
}
?>


<style>
    .container {
        max-width: 900px;
        margin: 40px auto;
        background: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        font-family: "Inter", sans-serif;
    }

    .container h1 {
        font-size: 28px;
        margin-bottom: 25px;
        color: #333;
        font-weight: 600;
    }

    form {
        display: flex;
        flex-direction: column;
        gap: 18px;
    }

    form label {
        font-size: 14px;
        font-weight: 600;
        color: #444;
    }

    form input[type="text"],
    form input[type="number"],
    form input[type="email"] {
        width: 100%;
        padding: 12px 14px;
        border: 1px solid #dcdcdc;
        border-radius: 6px;
        font-size: 15px;
        transition: 0.2s ease;
    }

    form input:focus {
        border-color: #34344a;
        box-shadow: 0 0 0 2px rgba(0,123,255,0.15);
        outline: none;
    }

    form button,
    .btn {
        display: inline-block;
        background: #34344a;
        color: white;
        padding: 10px 16px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 15px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: 0.2s ease;
    }

    form button:hover,
    .btn:hover {
        background: #34344a;
    }

</style>


<div class="container">
    <h1>Add Venue</h1>

    <form method="POST">
        <label>Venue Name</label>
        <input type="text" name="venue_name" required>

        <label>Address</label>
        <input type="text" name="address" required>

        <label>City</label>
        <input type="text" name="city" required>

        <label>Capacity</label>
        <input type="number" name="capacity" required>

        <label>Contact Person</label>
        <input type="text" name="contact_person">

        <label>Contact Email</label>
        <input type="email" name="contact_email">

        <button type="submit">Add Venue</button>
    </form>
</div>

<?php include '../includes/footer.php'; ?>
