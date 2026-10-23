<?php
require 'koneksi.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$success = "";
$error   = "";

// Fetch user data
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'admin';
$q_user = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
$user_data = mysqli_fetch_assoc($q_user);

if (isset($_POST['update_profile'])) {
    $nama_lengkap = mysqli_real_escape_string($conn, trim($_POST['nama_lengkap']));
    
    if (!empty($nama_lengkap)) {
        $update = mysqli_query($conn, "UPDATE users SET nama_lengkap='$nama_lengkap' WHERE username='$username'");
        if ($update) {
            $_SESSION['nama'] = $nama_lengkap;
            $user_data['nama_lengkap'] = $nama_lengkap;
            $success = "Profil administrator berhasil diperbarui.";
        } else {
            $error = "Terjadi kegagalan saat memperbarui data profil: " . mysqli_error($conn);
        }
    } else {
        $error = "Nama lengkap administrator tidak boleh kosong.";
    }
}

if (isset($_POST['update_password'])) {
    $pass_lama = md5($_POST['password_lama']);
    $pass_baru = trim($_POST['password_baru']);
    $pass_konf = trim($_POST['password_konfirmasi']);

    // Check old password
    if ($pass_lama !== $user_data['password']) {
        $error = "Kata sandi lama yang Anda masukkan tidak sesuai.";
    } elseif (strlen($pass_baru) < 4) {
        $error = "Kata sandi baru minimal harus terdiri dari 4 karakter.";
    } elseif ($pass_baru !== $pass_konf) {
        $error = "Konfirmasi kata sandi baru tidak cocok.";
    } else {
        $pass_hash = md5($pass_baru);
        $update_pwd = mysqli_query($conn, "UPDATE users SET password='$pass_hash' WHERE username='$username'");
        if ($update_pwd) {
            $success = "Kata sandi akun administrator berhasil diperbarui.";
            // Reload user data
            $q_user = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
            $user_data = mysqli_fetch_assoc($q_user);
        } else {
            $error = "Gagal memperbarui kata sandi: " . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Sistem - Horizon University Indonesia</title>
    <link rel="icon" type="image/png" href="assets/logo-horizon.png">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="app-container">
        <!-- Sidebar Navigation -->
        <aside class="sidebar">
            <div>
                <div class="brand">
                    <img src="assets/logo-horizon.png" alt="Logo Horizon University" class="brand-logo-img">
                    <div class="brand-text">
                        <span class="brand-title">HORIZON</span>
                        <span class="brand-subtitle">University Indonesia</span>
                    </div>
                </div>

                <div class="nav-section-label">Navigasi Utama</div>
                <nav class="nav-menu">
                    <a href="index.php">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                        Dashboard
                    </a>
                    <a href="mahasiswa.php">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                        Data Mahasiswa
                    </a>
                    <a href="tambah.php">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7.5" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>
                        Pendaftaran Mahasiswa
                    </a>
                    <a href="setting.php" class="active">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                        Pengaturan
                    </a>
                </nav>
            </div>

            <div class="nav-menu">
                <a href="logout.php" class="logout">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                    Keluar dari Sistem
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="header-bar">
                <div>
                    <h2>Pengaturan Akun & Sistem</h2>
                    <p style="font-size: 14px; color: var(--text-secondary); margin-top: 4px;">Konfigurasi profil administrator dan informasi institusi akademik.</p>
                </div>

                <!-- User Profile Badge -->
                <div class="user-profile">
                    <img src="assets/logo-horizon.png" alt="Profile Horizon" class="user-avatar">
                    <div class="user-info">
                        <span class="user-name"><?= htmlspecialchars($_SESSION['nama']); ?></span>
                        <span class="user-role">Administrator</span>
                    </div>
                </div>
            </div>

            <?php if (!empty($success)): ?>
                <div class="alert-success">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                    <span><?= htmlspecialchars($success); ?></span>
                </div>
            <?php endif; ?>

            <?php if (!empty($error)): ?>
                <div class="alert-error">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                    <span><?= htmlspecialchars($error); ?></span>
                </div>
            <?php endif; ?>

            <div class="settings-grid">
                <!-- Card 1: Profil Administrator -->
                <div class="content-card">
                    <div style="display: flex; align-items: center; gap: 14px; margin-bottom: 20px;">
                        <img src="assets/logo-horizon.png" alt="Logo Avatar" style="width: 56px; height: 56px; border-radius: 50%; border: 2px solid var(--primary-border); padding: 2px; background: #fff;">
                        <div>
                            <h3 style="font-size: 16px; font-weight: 700; color: var(--text-main);"><?= htmlspecialchars($user_data['nama_lengkap']); ?></h3>
                            <span class="badge badge-blue">Administrator Utama</span>
                        </div>
                    </div>

                    <form action="" method="POST">
                        <h4 style="font-size: 14px; font-weight: 700; color: var(--primary-dark); margin-bottom: 14px; border-bottom: 1px solid var(--border-color); padding-bottom: 8px;">
                            Perbarui Nama Profil
                        </h4>
                        <div class="form-group">
                            <label for="username">Nama Pengguna (Username)</label>
                            <input type="text" id="username" value="<?= htmlspecialchars($user_data['username']); ?>" disabled style="background-color: var(--bg-muted); cursor: not-allowed;">
                            <small class="form-text">Username bersifat tetap dan digunakan untuk otentikasi login.</small>
                        </div>
                        <div class="form-group">
                            <label for="nama_lengkap">Nama Lengkap Administrator <span class="required">*</span></label>
                            <input type="text" id="nama_lengkap" name="nama_lengkap" value="<?= htmlspecialchars($user_data['nama_lengkap']); ?>" required>
                        </div>
                        <button type="submit" name="update_profile" class="btn-primary" style="width: 100%;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                            Simpan Perubahan Nama
                        </button>
                    </form>
                </div>

                <!-- Card 2: Keamanan / Ubah Password -->
                <div class="content-card">
                    <h4 style="font-size: 14px; font-weight: 700; color: var(--primary-dark); margin-bottom: 14px; border-bottom: 1px solid var(--border-color); padding-bottom: 8px;">
                        Keamanan & Kata Sandi
                    </h4>
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="password_lama">Kata Sandi Saat Ini <span class="required">*</span></label>
                            <input type="password" id="password_lama" name="password_lama" placeholder="Masukkan kata sandi saat ini" required>
                        </div>
                        <div class="form-group">
                            <label for="password_baru">Kata Sandi Baru <span class="required">*</span></label>
                            <input type="password" id="password_baru" name="password_baru" placeholder="Masukkan kata sandi baru (min. 4 karakter)" required>
                        </div>
                        <div class="form-group">
                            <label for="password_konfirmasi">Konfirmasi Kata Sandi Baru <span class="required">*</span></label>
                            <input type="password" id="password_konfirmasi" name="password_konfirmasi" placeholder="Ulangi kata sandi baru" required>
                        </div>
                        <button type="submit" name="update_password" class="btn-primary" style="width: 100%;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                            Perbarui Kata Sandi
                        </button>
                    </form>
                </div>
            </div>

            <!-- Card 3: Informasi Institusi -->
            <div class="content-card" style="margin-top: 24px;">
                <h4 style="font-size: 14px; font-weight: 700; color: var(--primary-dark); margin-bottom: 16px; border-bottom: 1px solid var(--border-color); padding-bottom: 8px;">
                    Informasi Pangkalan Data & Institusi
                </h4>
                <div class="info-box">
                    <div class="info-box-item">
                        <span class="info-box-label">Institusi Pendidikan</span>
                        <span class="info-box-val">Horizon University Indonesia</span>
                    </div>
                    <div class="info-box-item">
                        <span class="info-box-label">Kampus Utama</span>
                        <span class="info-box-val">Karawang, Jawa Barat, Indonesia</span>
                    </div>
                    <div class="info-box-item">
                        <span class="info-box-label">Domain Email Resmi</span>
                        <span class="info-box-val">@krw.horizon.ac.id</span>
                    </div>
                    <div class="info-box-item">
                        <span class="info-box-label">Tahun Akademik Aktif</span>
                        <span class="info-box-val">Semester Ganjil 2026/2027</span>
                    </div>
                    <div class="info-box-item">
                        <span class="info-box-label">Status Server Basis Data</span>
                        <span class="info-box-val" style="color: #166534;"><span class="badge badge-green">Terhubung (MySQL)</span></span>
                    </div>
                    <div class="info-box-item">
                        <span class="info-box-label">Versi Sistem</span>
                        <span class="info-box-val">v2.5 Enterprise White-Blue</span>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
