<?php
session_start();
include 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];
$role     = 'user'; // Semua pendaftar jadi user biasa

$query = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";
$result = mysqli_query($conn, $query);

if ($result) {
    echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location.href='login.php';</script>";
} else {
    echo "<script>alert('Registrasi gagal.'); window.location.href='register.php';</script>";
}
?>