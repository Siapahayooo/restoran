<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'user') {
    header("Location: ../login.php");
    exit;
}

$id_menu = $_POST['id_menu'];
$harga = $_POST['harga'];
$jumlah = $_POST['jumlah'];
$alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
$nama_user = $_SESSION['username'];
$total = $harga * $jumlah;

$query = mysqli_query($conn, "INSERT INTO pesanan (id_menu, nama_user, alamat, jumlah, total , created_at)
    VALUES ('$id_menu', '$nama_user', '$alamat', '$jumlah', '$total', NOW())");

header("Location: menu_user.php?status=berhasil");
exit;