<?php
require 'koneksi.php';

if (isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

$error = "";
if (isset($_POST['submit_login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']);

    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");
    if (mysqli_num_rows($query) === 1) {
        $row = mysqli_fetch_assoc($query);
        $_SESSION['login'] = true;
        $_SESSION['nama']  = $row['nama_lengkap'];
        header("Location: index.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Dashboard Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-wrapper">
        <div class="login-card">
            <h2>Portal Akademik</h2>
            <p>Silakan masuk untuk mengelola data mahasiswa</p>

            <?php if ($error): ?>
                <div class="alert-error"><?= $error; ?></div>
            <?php endif; ?>

            <form action="" method="POST">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" placeholder="Masukkan username (admin)" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Masukkan password (123)" required>
                </div>
                <button type="submit" name="submit_login" class="btn-primary" style="width: 100%;">Masuk</button>
            </form>
        </div>
    </div>
</body>
</html>