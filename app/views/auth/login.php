<?php
$page_title = 'Login';
require_once APP_PATH . '/views/layout/header.php';

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate CSRF token
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $error = 'CSRF token mismatch';
    } else {
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        if (empty($username) || empty($password)) {
            $error = 'Username and password are required';
        } else {
            // Check credentials
            $user = new User();
            $user_data = $user->getByUsername($username);

            if ($user_data && $user->verifyPassword($password, $user_data['password'])) {
                // Set session
                $_SESSION['user_id'] = $user_data['id'];
                $_SESSION['username'] = $user_data['username'];
                $_SESSION['role'] = $user_data['role'];
                $_SESSION['full_name'] = $user_data['full_name'];

                // Redirect based on role
                if ($user_data['role'] === 'patient') {
                    header('Location: ' . SITE_URL . '?page=patient&action=dashboard');
                } elseif ($user_data['role'] === 'doctor') {
                    header('Location: ' . SITE_URL . '?page=doctor&action=dashboard');
                } elseif ($user_data['role'] === 'admin') {
                    header('Location: ' . SITE_URL . '?page=admin&action=dashboard');
                }
                exit;
            } else {
                $error = 'Invalid username or password';
            }
        }
    }
}
?>

<div class="row" style="margin-top: 3rem;">
    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="card-body">
                <h1 class="text-center">Login</h1>

                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>

                <?php if (isset($_GET['registered'])): ?>
                    <div class="alert alert-success">Registrasi berhasil! Silakan login dengan akun Anda.</div>
                <?php endif; ?>

                <form method="POST">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" required autofocus
                               value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </form>

                <div style="margin-top: var(--spacing-lg); text-align: center;">
                    <p>Belum punya akun? <a href="<?php echo SITE_URL; ?>?page=auth&action=register">Daftar di sini</a></p>
                </div>

                <hr style="margin: var(--spacing-lg) 0;">

                <div style="background-color: var(--gray-100); padding: var(--spacing-md); border-radius: var(--radius-md);">
                    <h5 style="margin-top: 0;">Demo Credentials:</h5>
                    <p style="margin: 0.25rem 0;"><strong>Username:</strong> patient1</p>
                    <p style="margin: 0;"><strong>Password:</strong> password</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once APP_PATH . '/views/layout/footer.php'; ?>
