<?php
include '../koneksi.php';

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];   
    $deskripsi = $_POST['deskripsi'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];

    // Cek apakah ada file gambar baru di-upload
    if ($_FILES['gambar']['name'] != '') {
        $gambar = time() . "_" . $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];
        move_uploaded_file($tmp, "../upload/" . $gambar);

        // Update termasuk gambar
        $query = "UPDATE menu SET nama='$nama', deskripsi='$deskripsi', kategori='$kategori', harga='$harga', gambar='$gambar' WHERE id='$id'";
    } else {
        // Update tanpa gambar
        $query = "UPDATE menu SET nama='$nama', deskripsi='$deskripsi', kategori='$kategori', harga='$harga' WHERE id='$id'";
    }

    mysqli_query($conn, $query);
    header("Location: index.php");
}
?>