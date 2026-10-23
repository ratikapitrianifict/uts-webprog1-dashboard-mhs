<?php
session_start();
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_mahasiswa";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi ke basis data gagal: " . mysqli_connect_error());
}
?>