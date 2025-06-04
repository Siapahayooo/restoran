<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'user') {
    header("Location: ../login.php");
    exit;
}

$id_pesanan = isset($_GET['id']) ? intval($_GET['id']) : 0;
$username = $_SESSION['username'];
$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id FROM users WHERE username='$username'"));
$id_user = $user['id'];

$query = mysqli_query($conn, "SELECT pesanan.*, menu.nama AS nama_menu, menu.harga 
                              FROM pesanan 
                              JOIN menu ON pesanan.id_menu = menu.id 
                              WHERE pesanan.id_user = $id_user AND pesanan.id = $id_pesanan");

if (mysqli_num_rows($query) == 0) {
    echo "Data tidak ditemukan.";
    exit;
}

$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Invoice Pesanan</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .invoice { border: 1px solid #ccc; padding: 20px; max-width: 600px; margin: auto; }
        h2 { text-align: center; }
        table { width: 100%; margin-top: 20px; }
        td { padding: 5px 0; }
        .print-btn { margin-top: 20px; text-align: center; }
    </style>
</head>
<body>
    <div class="invoice">
        <h2>RestoranKita - Invoice</h2>
        <hr>
        <p><strong>Nama Menu:</strong> <?= $data['nama_menu'] ?></p>
        <p><strong>Jumlah:</strong> <?= $data['jumlah'] ?></p>
        <p><strong>Harga Satuan:</strong> Rp<?= number_format($data['harga']) ?></p>
        <p><strong>Total:</strong> Rp<?= number_format($data['total_harga']) ?></p>
        <p><strong>Metode Pembayaran:</strong> <?= $data['metode_pembayaran'] ?></p>
        <p><strong>Status:</strong> <?= ucfirst($data['status']) ?></p>
        <p><strong>Status Pembayaran:</strong> <?= ucfirst($data['status_pembayaran']) ?></p>
        <p><strong>Tanggal Pesan:</strong> <?= date('d-m-Y H:i', strtotime($data['tanggal'])) ?></p>

        <div class="print-btn">
            <button onclick="window.print()">Cetak / Simpan PDF</button>
        </div>
    </div>
</body>
</html>