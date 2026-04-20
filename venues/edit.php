<?php 
include '../includes/header.php';
include '../includes/navbar.php';
require_once('../config/db.php');

$conn = db();

$id = $_GET['id'];

// Fetch venue
$stmt = $conn->prepare("SELECT * FROM venues WHERE venue_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$venue = $result->fetch_assoc();

if (!$venue) {
    die("Venue not found");
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $update = $conn->prepare("UPDATE venues 
        SET venue_name=?, address=?, city=?, capacity=?, contact_person=?, contact_email=?
        WHERE venue_id=?");

    $update->bind_param(
        "sssissi",
        $_POST['venue_name'],
        $_POST['address'],
        $_POST['city'],
        $_POST['capacity'],
        $_POST['contact_person'],
        $_POST['contact_email'],
        $id
    );

    $update->execute();

    header("Location: dashboard.php");
    exit;
}
?>

<style>
    .container {
        max-width: 700px;
        margin: 40px auto;
        background: #ffffff;
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
        margin-bottom: 5px;
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

    form button {
        margin-top: 10px;
        padding: 12px 18px;
        background: #34344a;
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.2s ease;
    }

    form button:hover {
        background: #34344a;
    }

    @media (max-width: 600px) {
        .container {
            padding: 20px;
        }

        form input,
        form button {
            font-size: 14px;
        }
    }
</style>


<div class="container">
    <h1>Edit Venue</h1>

    <form method="POST">
        <label>Venue Name</label>
        <input type="text" name="venue_name" value="<?= $venue['venue_name'] ?>" required>

        <label>Address</label>
        <input type="text" name="address" value="<?= $venue['address'] ?>" required>

        <label>City</label>
        <input type="text" name="city" value="<?= $venue['city'] ?>" required>

        <label>Capacity</label>
        <input type="number" name="capacity" value="<?= $venue['capacity'] ?>" required>

        <label>Contact Person</label>
        <input type="text" name="contact_person" value="<?= $venue['contact_person'] ?>">

        <label>Contact Email</label>
        <input type="email" name="contact_email" value="<?= $venue['contact_email'] ?>">

        <button type="submit">Update Venue</button>
    </form>
</div>

<?php include '../includes/footer.php'; ?>

