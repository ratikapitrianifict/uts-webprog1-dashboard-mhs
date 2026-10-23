<?php
require 'koneksi.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['simpan'])) {
    $nim      = mysqli_real_escape_string($conn, $_POST['nim']);
    $nama     = mysqli_real_escape_string($conn, $_POST['nama']);
    $prodi    = mysqli_real_escape_string($conn, $_POST['prodi']);
    $semester = (int) $_POST['semester'];
    $email    = mysqli_real_escape_string($conn, $_POST['email']);

    $insert = mysqli_query($conn, "INSERT INTO mahasiswa (nim, nama, prodi, semester, email) 
                                   VALUES ('$nim', '$nama', '$prodi', '$semester', '$email')");
    if ($insert) {
        header("Location: index.php");
        exit;
    } else {
        $error = "Gagal menyimpan data: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Input Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="app-container">
        <aside class="sidebar">
            <div>
                <div class="brand">SIAKAD Mhs</div>
                <nav class="nav-menu">
                    <a href="index.php">Dashboard</a>
                    <a href="tambah.php" class="active">+ Input Mahasiswa</a>
                </nav>
            </div>
            <div class="nav-menu">
                <a href="logout.php">Keluar</a>
            </div>
        </aside>

        <main class="main-content">
            <div class="header-bar">
                <h2>Form Input Data Mahasiswa</h2>
            </div>

            <div class="content-card" style="max-width: 600px;">
                <form action="" method="POST">
                    <div class="form-group">
                        <label>Nomor Induk Mahasiswa (NIM)</label>
                        <input type="text" name="nim" placeholder="Contoh: 411275520125" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama" placeholder="Masukkan nama mahasiswa" required>
                    </div>
                    <div class="form-group">
                        <label>Program Studi</label>
                        <select name="prodi" required>
                            <option value="S1 Informatika">S1 Informatika</option>
                            <option value="S1 Sistem Informasi">S1 Sistem Informasi</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Semester</label>
                        <input type="number" name="semester" min="1" max="14" value="3" required>
                    </div>
                    <div class="form-group">
                        <label>Email Akademik</label>
                        <input type="email" name="email" placeholder="nama@krw.horizon.ac.id" required>
                    </div>
                    <button type="submit" name="simpan" class="btn-primary">Simpan Data</button>
                </form>
            </div>
        </main>
    </div>
</body>
</html>