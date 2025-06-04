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
</head>
<body>
    <h2>Form Tambah Menu</h2>
    <form action="proses_menu.php" method="post" enctype="multipart/form-data">
        <label>Nama Menu:</label><br>
        <input type="text" name="nama" required><br><br>

        <label>Harga:</label><br>
        <input type="number" name="harga" required><br><br>

        <label>Kategori:</label><br>
        <select name="kategori" required>
            <option value="makanan">Makanan</option>
            <option value="minuman">Minuman</option>
        </select><br><br>

        <label>Deskripsi:</label><br>
        <textarea name="deskripsi" required></textarea><br><br>

        <label>Gambar:</label><br>
        <input type="file" name="gambar" accept="image/*" required><br><br>

        <input type="submit" value="Tambah Menu">
    </form>
</body>
</html>