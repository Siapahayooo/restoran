<?php
include '../koneksi.php';

$id_menu = $_POST['id_menu'];
$nama_user = $_POST['nama_user'];
$alamat = $_POST['alamat'];
$jumlah = $_POST['jumlah'];
$harga = $_POST['harga'];
$total = $jumlah * $harga;

$query = "INSERT INTO pesanan (id_menu, nama_user, alamat, jumlah, total)
          VALUES ('$id_menu', '$nama_user', '$alamat', '$jumlah', '$total')";
mysqli_query($conn, $query);

echo "Pesanan berhasil! Silakan tunggu konfirmasi.";
?>