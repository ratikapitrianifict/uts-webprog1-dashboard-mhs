<?php
require 'koneksi.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

// Total counts
$res_total = mysqli_query($conn, "SELECT COUNT(*) as total FROM mahasiswa");
$total_mhs = mysqli_fetch_assoc($res_total)['total'];

// Count S1 Informatika
$res_ti = mysqli_query($conn, "SELECT COUNT(*) as total FROM mahasiswa WHERE prodi = 'S1 Informatika'");
$total_ti = mysqli_fetch_assoc($res_ti)['total'];

// Count S1 Sistem Informasi
$res_si = mysqli_query($conn, "SELECT COUNT(*) as total FROM mahasiswa WHERE prodi = 'S1 Sistem Informasi'");
$total_si = mysqli_fetch_assoc($res_si)['total'];

// Recent students
$recent_res = mysqli_query($conn, "SELECT * FROM mahasiswa ORDER BY id DESC LIMIT 5");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Utama - Horizon University Indonesia</title>
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
                    <a href="index.php" class="active">
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
            <!-- Header Bar -->
            <div class="header-bar">
                <div>
                    <h2>Dashboard Akademik</h2>
                    <p style="font-size: 14px; color: var(--text-secondary); margin-top: 4px;">Selamat datang kembali di Portal Akademik, <strong><?= htmlspecialchars($_SESSION['nama']); ?></strong>.</p>
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

            <!-- Welcome Banner -->
            <div class="welcome-banner">
                <div>
                    <h3>Portal Akademik Horizon University Indonesia</h3>
                    <p>Sistem Informasi Akademik terintegrasi untuk mengelola data mahasiswa, verifikasi berkas akademik, dan pemantauan statistik perkuliahan.</p>
                </div>
                <div class="banner-actions">
                    <a href="mahasiswa.php" class="btn-light">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                        Cari Mahasiswa
                    </a>
                    <a href="tambah.php" class="btn-primary" style="background: rgba(255,255,255,0.2); border: 1px solid rgba(255,255,255,0.4); box-shadow: none;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        Tambah Data
                    </a>
                </div>
            </div>

            <!-- Stat Cards Grid -->
            <div class="stats-grid">
                <div class="stat-card">
                    <span>Total Mahasiswa</span>
                    <h3><?= $total_mhs; ?> Mahasiswa</h3>
                    <div class="stat-desc">Terdaftar aktif di sistem</div>
                </div>
                <div class="stat-card stat-info">
                    <span>S1 Informatika</span>
                    <h3><?= $total_ti; ?> Mahasiswa</h3>
                    <div class="stat-desc">Fakultas Teknologi Informasi</div>
                </div>
                <div class="stat-card stat-teal">
                    <span>S1 Sistem Informasi</span>
                    <h3><?= $total_si; ?> Mahasiswa</h3>
                    <div class="stat-desc">Fakultas Teknologi Informasi</div>
                </div>
                <div class="stat-card stat-purple">
                    <span>Periode Akademik</span>
                    <h3 style="font-size: 19px; margin-top: 10px;">Ganjil 2026/2027</h3>
                    <div class="stat-desc">Tahun ajaran berjalan</div>
                </div>
            </div>

            <!-- Recent Students Preview Card with Quick Search -->
            <div class="content-card">
                <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; margin-bottom: 16px;">
                    <div>
                        <h3 style="font-size: 17px; color: var(--text-main); font-weight: 700;">Data Mahasiswa Terbaru</h3>
                        <p style="font-size: 13px; color: var(--text-muted); margin-top: 2px;">5 mahasiswa terakhir yang terdaftar pada sistem pangkalan data.</p>
                    </div>
                    <a href="mahasiswa.php" class="btn-secondary" style="font-size: 13px;">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                        Buka & Cari di Data Mahasiswa &rarr;
                    </a>
                </div>

                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 50px;">No.</th>
                                <th>NIM</th>
                                <th>Nama Lengkap</th>
                                <th>Program Studi</th>
                                <th style="text-align: center;">Semester</th>
                                <th>Email Institusi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($total_mhs > 0): ?>
                                <?php $no = 1; while ($row = mysqli_fetch_assoc($recent_res)): ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><strong style="color: var(--primary-color); letter-spacing: 0.5px;"><?= htmlspecialchars($row['nim']); ?></strong></td>
                                    <td style="font-weight: 600; color: var(--text-main);"><?= htmlspecialchars($row['nama']); ?></td>
                                    <td><span class="badge badge-secondary"><?= htmlspecialchars($row['prodi']); ?></span></td>
                                    <td style="text-align: center;"><span class="badge badge-blue">Semester <?= htmlspecialchars($row['semester']); ?></span></td>
                                    <td style="color: var(--text-secondary);"><?= htmlspecialchars($row['email']); ?></td>
                                </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" style="text-align: center; padding: 36px; color: var(--text-muted);">
                                        Belum ada data mahasiswa yang tersimpan.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>
</html>