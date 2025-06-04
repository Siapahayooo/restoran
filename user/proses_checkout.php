<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'user') {
    header("Location: ../login.php");
    exit;
}

$username = $_SESSION['username'];
$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id, username FROM users WHERE username='$username'"));
$id_user = $user['id'];
$nama_user = $user['username']; // Pakai username sebagai nama user

// Ambil semua item keranjang user yang pending
$keranjang = mysqli_query($conn, "SELECT * FROM keranjang WHERE id_user=$id_user AND status='pending'");

while ($item = mysqli_fetch_assoc($keranjang)) {
    $id_menu = $item['id_menu'];
    $jumlah = $item['jumlah'];

    // Ambil harga dari menu
    $metode_pembayaran = mysqli_real_escape_string($conn, $_POST['metode_pembayaran']);
    $menu = mysqli_fetch_assoc(mysqli_query($conn, "SELECT harga FROM menu WHERE id=$id_menu"));
    $harga = $menu['harga'];
    $total_harga = $harga * $jumlah;

    // Simpan ke tabel pesanan
    mysqli_query($conn, "INSERT INTO pesanan (id_user, nama_user, id_menu, jumlah, total_harga, metode_pembayaran) 
    VALUES ($id_user, '$nama_user', $id_menu, $jumlah, $total_harga, '$metode_pembayaran')");
}

// Ubah status keranjang
mysqli_query($conn, "UPDATE keranjang SET status='selesai' WHERE id_user=$id_user AND status='pending'");

echo "<script>alert('Pesanan berhasil disimpan!'); window.location.href='menu_user.php';</script>";
?>