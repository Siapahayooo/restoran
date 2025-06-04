<?php
include '../koneksi.php';

if (isset($_POST['id_keranjang'])) {
    $id = $_POST['id_keranjang'];
    mysqli_query($conn, "DELETE FROM keranjang WHERE id = $id");
}

header("Location: keranjang.php");
exit;
