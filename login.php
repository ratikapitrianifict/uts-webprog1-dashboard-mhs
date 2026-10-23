<?php
require 'koneksi.php';

if (isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

$error = "";
if (isset($_POST['submit_login'])) {
    $username = mysqli_real_escape_string($conn, trim($_POST['username']));
    $password = md5($_POST['password']);

    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");
    if (mysqli_num_rows($query) === 1) {
        $row = mysqli_fetch_assoc($query);
        $_SESSION['login']    = true;
        $_SESSION['user_id']  = $row['id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['nama']     = $row['nama_lengkap'];
        header("Location: index.php");
        exit;
    } else {
        $error = "Nama pengguna (username) atau kata sandi tidak valid. Silakan periksa kembali kredensial Anda.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Portal - Horizon University Indonesia</title>
    <link rel="icon" type="image/png" href="assets/logo-horizon.png">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-wrapper">
        <div class="login-card">
            <div style="text-align: center;">
                <img src="assets/logo-horizon.png" alt="Logo Horizon University Indonesia" class="login-logo">
                <span class="login-badge">Horizon University Indonesia</span>
                <h2>Portal Akademik</h2>
                <p class="subtitle">Silakan masuk menggunakan akun resmi administrator untuk mengakses dan mengelola pangkalan data mahasiswa.</p>
            </div>

            <?php if (!empty($error)): ?>
                <div class="alert-error">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                    <span><?= htmlspecialchars($error); ?></span>
                </div>
            <?php endif; ?>

            <form action="" method="POST">
                <div class="form-group">
                    <label for="username">Nama Pengguna (Username)</label>
                    <input type="text" id="username" name="username" placeholder="Masukkan nama pengguna resmi" autocomplete="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Kata Sandi (Password)</label>
                    <input type="password" id="password" name="password" placeholder="Masukkan kata sandi akun" autocomplete="current-password" required>
                </div>
                <button type="submit" name="submit_login" class="btn-primary" style="width: 100%; margin-top: 8px;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path><polyline points="10 17 15 12 10 7"></polyline><line x1="15" y1="12" x2="3" y2="12"></line></svg>
                    Masuk ke Sistem
                </button>
            </form>

            <p class="login-footer">&copy; <?= date('Y'); ?> Horizon University Indonesia. Seluruh hak cipta dilindungi.</p>
        </div>
    </div>
</body>
</html>