<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id_pesanan'];
    $status = $_POST['status'];

    mysqli_query($conn, "UPDATE pesanan SET status='$status' WHERE id=$id");
}

header("Location: pesanan.php");
exit;
?>