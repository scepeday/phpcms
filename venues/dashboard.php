<?php 
include '../includes/header.php';
include '../includes/navbar.php';

$query = "SELECT * FROM venues";
$result = $db->query($query);

$venues = [];
if ($result && $result->num_rows > 0) {
    $venues = $result->fetch_all(MYSQLI_ASSOC);
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

    .btn,
    button[type="submit"] {
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

    .btn:hover,
    button[type="submit"]:hover {
        background: #34344a;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    table th {
        background: #f5f5f5;
        padding: 12px;
        text-align: left;
        font-weight: 600;
        border-bottom: 2px solid #ddd;
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

    form button {
        margin-top: 10px;
    }

</style>


<div class="container">
    <h1>All Venues</h1>
    <a href="add.php" class="btn">Add Venue</a>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>City</th>
            <th>Capacity</th>
            <th>Actions</th>
        </tr>

        <?php foreach ($venues as $v): ?>
        <tr>
            <td><?= $v['venue_id'] ?></td>
            <td><?= $v['venue_name'] ?></td>
            <td><?= $v['city'] ?></td>
            <td><?= $v['capacity'] ?></td>
            <td>
                <a href="edit.php?id=<?= $v['venue_id'] ?>">Edit</a> |
                <a href="delete.php?id=<?= $v['venue_id'] ?>" onclick="return confirm('Delete this venue?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>

<?php include '../includes/footer.php'; ?>
