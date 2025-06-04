<?php
include '../koneksi.php';
$id = $_GET['id'];
$status = $_GET['status'];

if (in_array($status, ['diterima', 'ditolak'])) {
    mysqli_query($conn, "UPDATE pesanan SET status_pembayaran='$status' WHERE id=$id");
}

header("Location: pesanan.php");