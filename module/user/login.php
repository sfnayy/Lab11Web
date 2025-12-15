<?php
// Jika sudah login, redirect ke home
if (isset($_SESSION['is_login'])) {
    header('Location: ' . BASE_URL . '/home/index');
    exit;
}

$message = "";

// Proses Login saat tombol ditekan
if ($_POST) {
    $db = new Database();
    
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cari user di database
    $sql = "SELECT * FROM users WHERE username = '{$username}' LIMIT 1";
    $result = $db->query($sql);
    $data = $result->fetch_assoc();

    // Cek Password
    if ($data && password_verify($password, $data['password'])) {
        // Login Sukses: Simpan data ke session
        $_SESSION['is_login'] = true;
        $_SESSION['username'] = $data['username'];
        $_SESSION['nama'] = $data['nama'];

        // Redirect ke Artikel
        header('Location: ' . BASE_URL . '/artikel/index');
        exit;
    } else {
        $message = "Username atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .login-container { max-width: 400px; margin: 100px auto; padding: 20px; box-shadow: 0 0 10px rgba(0,0,0,0.1); border-radius: 8px; }
    </style>
</head>
<body>
    <div class="login-container">
        <h3 class="text-center mb-4">Login User</h3>
        <?php if ($message): ?>
            <div class="alert alert-danger"><?= $message ?></div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <div class="mb-3">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>
        <div class="mt-3 text-center">
            <a href="<?= BASE_URL ?>/home/index">Kembali ke Home</a>
        </div>
    </div>
</body>
</html>