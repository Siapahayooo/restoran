<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Menu</title>
    <link rel="stylesheet" href="style-admin.css">
</head>
<body>
    <div class="admin-container">
        <h2>Tambah Menu Baru</h2>
        <form action="proses_tambah.php" method="POST" enctype="multipart/form-data">
            <label>Nama Menu</label>
            <input type="text" name="nama" required>

            <label>Deskripsi</label>
            <textarea name="deskripsi" required></textarea>

            <label>Harga</label>
            <input type="number" name="harga" required>

            <label>Kategori</label>
            <select name="kategori" required>
                <option value="makanan">Makanan</option>
                <option value="minuman">Minuman</option>
            </select>

            <label>Gambar</label>
            <input type="file" name="gambar" required>

            <button type="submit">Tambah Menu</button>
        </form>
    </div>
</body>
</html>
