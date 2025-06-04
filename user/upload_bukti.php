<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'user') {
    header("Location: ../login.php");
    exit;
}

$id_pesanan = $_GET['id']; // Dapat dari link
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_file = $_FILES['bukti']['name'];
    $tmp = $_FILES['bukti']['tmp_name'];
    $folder = '../bukti/' . $nama_file;

    if (move_uploaded_file($tmp, $folder)) {
        mysqli_query($conn, "UPDATE pesanan SET bukti_bayar='$nama_file', status_pembayaran='menunggu' WHERE id=$id_pesanan");
        echo "<script>alert('Bukti bayar berhasil diunggah'); window.location.href='riwayat.php';</script>";
    } else {
        echo "<script>alert('Gagal upload!');</script>";
    }
}
?>

<form action="" method="POST" enctype="multipart/form-data">
    <label>Upload Bukti Pembayaran:</label><br>
    <input type="file" name="bukti" required><br><br>
    <button type="submit">Kirim</button>
</form>