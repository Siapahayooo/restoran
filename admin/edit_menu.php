<?php
include '../koneksi.php';

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM menu WHERE id = '$id'");
$data = mysqli_fetch_assoc($query);
?>

<h2>Edit Menu</h2>

<form action="proses_edit_menu.php" method="post" enctype="multipart/form-data">
  <input type="hidden" name="id" value="<?= $data['id'] ?>">

  Nama:
  <input type="text" name="nama" value="<?= $data['nama'] ?>" required><br>

  Kategori:
  <select name="kategori" required><br>
    <option value="makanan" <?= $data['kategori'] == 'makanan' ? 'selected' : '' ?>>Makanan</option>
    <option value="minuman" <?= $data['kategori'] == 'minuman' ? 'selected' : '' ?>>Minuman</option>
  </select><br><br>
  
  Deskripsi:
  <textarea name="deskripsi"><?= $data['deskripsi'] ?></textarea><br>

  Harga:
  <input type="number" name="harga" value="<?= $data['harga'] ?>" required><br>

  Gambar Saat Ini:<br>
  <img src="../upload/<?= $data['gambar'] ?>" width="100"><br>
  Ganti Gambar (opsional): 
  <input type="file" name="gambar"><br><br>
  

  <input type="submit" name="update" value="Update Menu">
</form>