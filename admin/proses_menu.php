<?php
include '../koneksi.php';

$nama = $_POST['nama'];
$harga = $_POST['harga'];
$deskripsi = $_POST['deskripsi'];
$kategori = $_POST['kategori'];

$gambar = $_FILES['gambar']['name'];
$tmp = $_FILES['gambar']['tmp_name'];
$path = "../upload/" . $gambar;

if (move_uploaded_file($tmp, $path)) {
    $query = "INSERT INTO menu (nama, harga, deskripsi , kategori, gambar) VALUES ('$nama', '$harga',' $deskripsi'  , '$kategori', '$gambar')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header("Location: index.php");
    } else {
        echo "Gagal menambahkan menu.";
    }
} else {
    echo "Gagal upload gambar.";
}
?>