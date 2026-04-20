<?php
$page_title = "Register";
$isValid = true;
$errorMessage = '';

include_once('../includes/header.php');

if (isset($_POST['register'])) {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (!isset($_POST['agree'])) {
        $isValid = false;
        $errorMessage = 'You must agree to the terms and conditions';
    } elseif (empty($email) || empty($password)) {
        $isValid = false;
        $errorMessage = 'Email and password cannot be empty';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $isValid = false;
        $errorMessage = 'Email is not valid';
    }

    if ($isValid) {
        $query = "INSERT INTO users (email, password) VALUES (?, ?)";
        $stmt = $db->prepare($query);

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt->bind_param('ss', $email, $hashedPassword);

        if ($stmt->execute() === false) {
            echo "Error: " . $stmt->error;
        } else {
            echo "<div class='alert alert-success'>Registration successful!</div>";
        }

        $stmt->close();
    }
}
?>


<style>
    .auth-wrapper {
        min-height: 90vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f5f7fb;
    }

    .auth-card {
        width: 100%;
        max-width: 420px;
        background: #fff;
        padding: 35px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    }

    .auth-title {
        font-size: 26px;
        font-weight: 600;
        margin-bottom: 10px;
        color: #1e1e2f;
    }

    .auth-subtitle {
        font-size: 14px;
        color: #777;
        margin-bottom: 25px;
    }

    .auth-link {
        font-size: 14px;
        text-align: center;
        margin-top: 20px;
    }

    .auth-link a {
        text-decoration: none;
        font-weight: 500;
    }
</style>

<div class="auth-wrapper">
    <div class="auth-card">

        <div class="auth-title">Create Account</div>
        <div class="auth-subtitle">Register to access the admin dashboard</div>

        <?php if (!$isValid): ?>
            <div class="alert alert-danger">
                <?= $errorMessage ?>
            </div>
        <?php endif; ?>

        <form action="" method="post">

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input
                    type="email"
                    name="email"
                    class="form-control"
                    placeholder="Enter your email"
                >
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input
                    type="password"
                    name="password"
                    class="form-control"
                    placeholder="Enter your password"
                >
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" name="agree" id="agree">
                <label class="form-check-label" for="agree">
                    I agree to terms and conditions
                </label>
            </div>

            <button type="submit" name="register" class="btn btn-dark w-100">
                Create Account
            </button>

        </form>

        <div class="auth-link">
            Already have an account?
            <a href="/admin/login.php">Login</a>
        </div>

    </div>
</div>

<?php include_once('../includes/footer.php'); ?>