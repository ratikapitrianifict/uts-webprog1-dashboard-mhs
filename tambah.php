<?php
require 'koneksi.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$error = "";
if (isset($_POST['simpan'])) {
    $nim      = mysqli_real_escape_string($conn, trim($_POST['nim']));
    $nama     = mysqli_real_escape_string($conn, trim($_POST['nama']));
    $prodi    = mysqli_real_escape_string($conn, trim($_POST['prodi']));
    $semester = (int) $_POST['semester'];
    $email    = mysqli_real_escape_string($conn, trim($_POST['email']));

    $insert = mysqli_query($conn, "INSERT INTO mahasiswa (nim, nama, prodi, semester, email) 
                                   VALUES ('$nim', '$nama', '$prodi', '$semester', '$email')");
    if ($insert) {
        header("Location: mahasiswa.php");
        exit;
    } else {
        $error = "Terjadi kendala saat menyimpan data mahasiswa: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Mahasiswa - Horizon University Indonesia</title>
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
                    <a href="tambah.php" class="active">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7.5" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>
                        Pendaftaran Mahasiswa
                    </a>
                    <a href="setting.php">
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
                    <h2>Formulir Penambahan Data Mahasiswa</h2>
                    <p style="font-size: 14px; color: var(--text-secondary); margin-top: 4px;">Lengkapi seluruh parameter informasi mahasiswa di bawah ini secara cermat dan akurat.</p>
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

            <div class="content-card" style="max-width: 680px;">
                <?php if (!empty($error)): ?>
                    <div class="alert-error">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                        <span><?= htmlspecialchars($error); ?></span>
                    </div>
                <?php endif; ?>

                <form action="" method="POST">
                    <div class="form-group">
                        <label for="nim">Nomor Induk Mahasiswa (NIM) <span class="required">*</span></label>
                        <input type="text" id="nim" name="nim" placeholder="Contoh: 411275520125" pattern="[0-9]+" title="Hanya angka yang diperkenankan" required>
                        <small class="form-text">Nomor Induk Mahasiswa resmi yang terdaftar pada pangkalan data.</small>
                    </div>

                    <div class="form-group">
                        <label for="nama">Nama Lengkap Mahasiswa <span class="required">*</span></label>
                        <input type="text" id="nama" name="nama" placeholder="Masukkan nama lengkap sesuai kartu identitas resmi" required>
                    </div>

                    <div class="form-group">
                        <label for="prodi">Program Studi <span class="required">*</span></label>
                        <select id="prodi" name="prodi" required>
                            <option value="" disabled selected>-- Pilih Program Studi --</option>
                            <option value="S1 Informatika">S1 Informatika</option>
                            <option value="S1 Sistem Informasi">S1 Sistem Informasi</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="semester">Tingkat Semester <span class="required">*</span></label>
                        <input type="number" id="semester" name="semester" min="1" max="14" value="1" placeholder="Masukkan tingkat semester (1-14)" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Alamat Email Akademik / Institusi <span class="required">*</span></label>
                        <input type="email" id="email" name="email" placeholder="mahasiswa@krw.horizon.ac.id" required>
                        <small class="form-text">Gunakan alamat surel institusi resmi yang aktif (@krw.horizon.ac.id).</small>
                    </div>

                    <div style="display: flex; gap: 12px; margin-top: 28px;">
                        <button type="submit" name="simpan" class="btn-primary">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                            Simpan Data Mahasiswa
                        </button>
                        <a href="mahasiswa.php" class="btn-secondary">Batalkan</a>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>