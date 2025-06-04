<?php
include '../koneksi.php';

$id = intval($_GET['id']); // Hindari SQL injection

// Cek dulu apakah menu masih dipakai di keranjang
mysqli_query($conn, "DELETE FROM keranjang WHERE id_menu = $id");

// Ambil nama file gambar jika ada
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT gambar FROM menu WHERE id=$id"));
$gambar = $data['gambar'] ?? '';

// Hapus file gambar jika ada
if ($gambar && file_exists("../upload/$gambar")) {
    unlink("../upload/$gambar");
}

// Hapus data menu dari database
mysqli_query($conn, "DELETE FROM menu WHERE id=$id");

// Redirect kembali ke halaman index admin
header("Location: index.php");
exit;
?>