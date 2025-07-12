<?php
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $kategori = $_POST['kategori'];

    if ($_FILES['gambar']['name']) {
        $gambar = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];
        move_uploaded_file($tmp, '../upload/' . $gambar);

        // Update dengan gambar baru
        $query = mysqli_query($conn, "UPDATE menu SET 
            nama='$nama', deskripsi='$deskripsi', harga='$harga', kategori='$kategori', gambar='$gambar' 
            WHERE id=$id");
    } else {
        // Update tanpa mengganti gambar
        $query = mysqli_query($conn, "UPDATE menu SET 
            nama='$nama', deskripsi='$deskripsi', harga='$harga', kategori='$kategori' 
            WHERE id=$id");
    }

    if ($query) {
        header("Location: index.php");
        exit;
    } else {
        echo "Gagal memperbarui data.";
    }
}
?>