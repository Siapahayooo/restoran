<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'user') {
    header("Location: ../login.php");
    exit;
}

$id_menu = $_GET['id'];
$menu = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM menu WHERE id = $id_menu"));
?>

<h2>Pesan: <?= $menu['nama'] ?></h2>

<form action="proses_pesan.php" method="post">
    <input type="hidden" name="id_menu" value="<?= $menu['id'] ?>">
    <input type="hidden" name="harga" value="<?= $menu['harga'] ?>">
    <label>Jumlah:</label><br>
    <input type="number" name="jumlah" required><br><br>

    <label>Alamat:</label><br>
    <textarea name="alamat" required></textarea><br><br>

    <input type="submit" value="Kirim Pesanan">
</form>