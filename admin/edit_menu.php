<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM menu WHERE id=$id"));
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Menu - Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            max-width: 600px;
            margin: auto;
        }
        h2 {
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="number"],
        textarea,
        select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        button {
            background-color: #28a745;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
        img {
            max-width: 100%;
            height: auto;
            margin-top: 10px;
        }
        .form-group img {
            display: block;
            margin-top: 10px;
        }
        .form-group img[alt="Gambar Menu"] {
            max-width: 150px;
            height: auto;
        }
        input[type="file"] {
            margin-top: 10px;
        }
        input[type="hidden"] {
            display: none;
        }
        textarea {
            resize: vertical;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Edit Menu</h2>
        <form action="proses_edit_menu.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $data['id']; ?>">

            <div class="form-group">
                <label for="nama">Nama Menu</label>
                <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($data['nama']); ?>" required>
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" rows="4" required><?= htmlspecialchars($data['deskripsi']); ?></textarea>
            </div>

            <div class="form-group">
                <label for="harga">Harga (Rp)</label>
                <input type="number" id="harga" name="harga" value="<?= $data['harga']; ?>" required>
            </div>

            <div class="form-group">
                <label for="kategori">Kategori</label>
                <select name="kategori" id="kategori" required>
                    <option value="makanan" <?= $data['kategori'] == 'makanan' ? 'selected' : '' ?>>Makanan</option>
                    <option value="minuman" <?= $data['kategori'] == 'minuman' ? 'selected' : '' ?>>Minuman</option>
                </select>
            </div>

            <div class="form-group">
                <label>Gambar Saat Ini</label>
                <img src="../upload/<?= $data['gambar']; ?>" alt="Gambar Menu">
            </div>

            <div class="form-group">
                <label for="gambar">Ganti Gambar (opsional)</label>
                <input type="file" id="gambar" name="gambar">
            </div>

            <div class="form-group">
                <button type="submit">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</body>
</html>