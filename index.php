<?php
require 'koneksi.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$result = mysqli_query($conn, "SELECT * FROM mahasiswa ORDER BY id DESC");
$total_mhs = mysqli_num_rows($result);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Data Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="app-container">
        <aside class="sidebar">
            <div>
                <div class="brand">SIAKAD Mhs</div>
                <nav class="nav-menu">
                    <a href="index.php" class="active">Dashboard</a>
                    <a href="tambah.php">+ Input Mahasiswa</a>
                </nav>
            </div>
            <div class="nav-menu">
                <a href="logout.php">Keluar</a>
            </div>
        </aside>

        <main class="main-content">
            <div class="header-bar">
                <div>
                    <h2>Dashboard Data Mahasiswa</h2>
                    <p style="font-size: 14px; color: #718096;">Selamat datang, <?= htmlspecialchars($_SESSION['nama']); ?></p>
                </div>
                <a href="tambah.php" class="btn-primary">+ Tambah Data</a>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <span>Total Mahasiswa Terdaftar</span>
                    <h3><?= $total_mhs; ?> Orang</h3>
                </div>
                <div class="stat-card" style="border-left-color: #D5E8D4;">
                    <span>Status Semester</span>
                    <h3>Ganjil 2026/2027</h3>
                </div>
            </div>

            <div class="content-card">
                <h3>Daftar Mahasiswa Aktif</h3>
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIM</th>
                            <th>Nama Lengkap</th>
                            <th>Program Studi</th>
                            <th>Semester</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><strong><?= htmlspecialchars($row['nim']); ?></strong></td>
                            <td><?= htmlspecialchars($row['nama']); ?></td>
                            <td><?= htmlspecialchars($row['prodi']); ?></td>
                            <td><?= htmlspecialchars($row['semester']); ?></td>
                            <td><?= htmlspecialchars($row['email']); ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>