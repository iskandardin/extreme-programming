<?php
$page_title = 'Daftar';
require_once APP_PATH . '/views/layout/header.php';

// Handle registration form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate CSRF token
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $error = 'CSRF token mismatch';
    } else {
        $username = trim($_POST['username'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';
        $full_name = trim($_POST['full_name'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $role = $_POST['role'] ?? 'patient';

        // Validation
        $errors = [];

        if (empty($username) || strlen($username) < 3) {
            $errors[] = 'Username harus minimal 3 karakter';
        }

        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Email tidak valid';
        }

        if (empty($password) || strlen($password) < 6) {
            $errors[] = 'Password harus minimal 6 karakter';
        }

        if ($password !== $confirm_password) {
            $errors[] = 'Password dan konfirmasi password tidak cocok';
        }

        if (empty($full_name)) {
            $errors[] = 'Nama lengkap harus diisi';
        }

        if (!empty($errors)) {
            $error = implode('<br>', $errors);
        } else {
            // Check if user already exists
            $user_model = new User();

            if ($user_model->usernameExists($username)) {
                $error = 'Username sudah terdaftar';
            } elseif ($user_model->emailExists($email)) {
                $error = 'Email sudah terdaftar';
            } else {
                // Create new user
                $user_data = [
                    'username' => $username,
                    'email' => $email,
                    'password' => $password,
                    'role' => $role === 'doctor' ? 'doctor' : 'patient',
                    'full_name' => $full_name,
                    'phone' => $phone,
                    'address' => '',
                    'is_active' => 1
                ];

                $user_id = $user_model->create($user_data);

                if ($user_id) {
                    // Create patient or doctor profile
                    if ($role === 'patient') {
                        $patient_data = [
                            'user_id' => $user_id,
                            'nik' => '',
                            'date_of_birth' => null,
                            'gender' => null,
                            'blood_type' => null,
                            'emergency_contact' => '',
                            'emergency_phone' => '',
                            'medical_history' => '',
                            'allergies' => ''
                        ];

                        $patient = new Patient();
                        $patient->create($patient_data);
                    }

                    // Redirect to login
                    header('Location: ' . SITE_URL . '?page=auth&action=login&registered=1');
                    exit;
                } else {
                    $error = 'Terjadi kesalahan saat membuat akun';
                }
            }
        }
    }
}
?>

<div class="row" style="margin-top: 2rem;">
    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="card-body">
                <h1 class="text-center">Daftar Akun</h1>

                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>

                <form method="POST">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

                    <div class="form-group">
                        <label for="full_name">Nama Lengkap</label>
                        <input type="text" id="full_name" name="full_name" required
                               value="<?php echo isset($_POST['full_name']) ? htmlspecialchars($_POST['full_name']) : ''; ?>">
                    </div>

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" required
                               value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required
                               value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                    </div>

                    <div class="form-group">
                        <label for="phone">Nomor Telepon</label>
                        <input type="text" id="phone" name="phone"
                               value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : ''; ?>">
                    </div>

                    <div class="form-group">
                        <label for="role">Tipe Pengguna</label>
                        <select id="role" name="role" required>
                            <option value="patient" <?php echo (isset($_POST['role']) && $_POST['role'] === 'patient') ? 'selected' : ''; ?>>Pasien</option>
                            <option value="doctor" <?php echo (isset($_POST['role']) && $_POST['role'] === 'doctor') ? 'selected' : ''; ?>>Dokter</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                    </div>

                    <div class="form-group">
                        <label for="confirm_password">Konfirmasi Password</label>
                        <input type="password" id="confirm_password" name="confirm_password" required>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Daftar</button>
                </form>

                <div style="margin-top: var(--spacing-lg); text-align: center;">
                    <p>Sudah punya akun? <a href="<?php echo SITE_URL; ?>?page=auth&action=login">Login di sini</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once APP_PATH . '/views/layout/footer.php'; ?>
