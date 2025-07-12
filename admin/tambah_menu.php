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

    <style>
.admin-container {
    width: 50%;
    margin: 0 auto;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}
.admin-container h2 {
    text-align: center;
    margin-bottom: 20px;
}
.admin-container label {
    display: block;
    margin-bottom: 5px;
}
.admin-container input[type="text"],
.admin-container input[type="number"],
.admin-container textarea,
.admin-container select {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
}
.admin-container button {
    width: 100%;
    padding: 10px;
    background-color: #28a745;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
.admin-container button:hover {
    background-color: #218838;
}
.admin-container input[type="file"] {
    margin-bottom: 15px;
    padding: 5px;
    border: 1px solid #ccc;
    border-radius: 4px;
}
.admin-container textarea {
    height: 100px;
    resize: vertical;
}
.admin-container input[type="submit"] {
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
.admin-container input[type="submit"]:hover {
    background-color: #0056b3;
}
.admin-container input[type="file"] {
    display: block;
    margin-top: 10px;
    margin-bottom: 15px;
    padding: 5px;
    border: 1px solid #ccc;
    border-radius: 4px;
    width: 100%;
}
.admin-container input[type="file"]::file-selector-button {
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    padding: 5px 10px;
    cursor: pointer;
}
.admin-container input[type="file"]::file-selector-button:hover {
    background-color: #0056b3;
    color: white;
}
    </style>
</body>
</html>
