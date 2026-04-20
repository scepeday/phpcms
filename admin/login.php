<?php 
$page_title = "Login";
$errorMessage = '';

include_once('../includes/header.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($email) || empty($password)) {
        $errorMessage = 'Please fill in all fields';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage = 'Invalid email address';
    } else {
        $query = "SELECT id, email, password FROM users WHERE email = ? LIMIT 1";
        $stmt = $db->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if (!$user) {
            $errorMessage = 'User not found';
        } elseif (!password_verify($password, $user['password'])) {
            $errorMessage = 'Incorrect password';
        } else {
            $_SESSION['id'] = $user['id'];
            $_SESSION['email'] = $user['email'];

            header('Location: dashboard.php');
            exit;
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

        <div class="auth-title">Welcome Back</div>
        <div class="auth-subtitle">Login to your admin account</div>

        <?php if (!empty($errorMessage)): ?>
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

            <button type="submit" class="btn btn-dark w-100">
                Login
            </button>

        </form>

        <div class="auth-link">
            Don't have an account?
            <a href="/admin/register.php">Register</a>
        </div>

    </div>
</div>

<?php include_once('../includes/footer.php'); ?>