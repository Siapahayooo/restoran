<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'user') {
    header("Location: ../login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_menu'], $_POST['jumlah'])) {
    $id_menu = (int) $_POST['id_menu'];
    $jumlah = (int) $_POST['jumlah'];
    if ($jumlah < 1) $jumlah = 1; // validasi minimal jumlah

    $username = $_SESSION['username'];
    $user_query = mysqli_query($conn, "SELECT id FROM users WHERE username = '$username'");
    $user_data = mysqli_fetch_assoc($user_query);
    $id_user = $user_data['id'];

    // Cek apakah item sudah ada di keranjang
    $cek = mysqli_query($conn, "SELECT * FROM keranjang WHERE id_user=$id_user AND id_menu=$id_menu AND status='pending'");

    if (mysqli_num_rows($cek) > 0) {
        // Update jumlah jika sudah ada
        mysqli_query($conn, "UPDATE keranjang SET jumlah = jumlah + $jumlah WHERE id_user=$id_user AND id_menu=$id_menu AND status='pending'");
    } else {
        // Insert baru jika belum ada
        mysqli_query($conn, "INSERT INTO keranjang (id_user, id_menu, jumlah, status) VALUES ($id_user, $id_menu, $jumlah, 'pending')");
    }

    header("Location: keranjang.php");
    exit;
} else {
    echo "<script>alert('Permintaan tidak valid.'); window.location.href='menu_user.php';</script>";
}