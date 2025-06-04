<?php
include '../koneksi.php';
$result = mysqli_query($conn, "SELECT * FROM menu");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Index</title>
</head>

<body>
  <a href="tambah_menu.php">Tambah Menu</a>
  <a href="pesanan.php">Daftar Pesanan</a>
  <a href="../logout.php">Logout</a>
  <table border="1">
    <tr>
      <th>Nama</th>
      <th>Deskripsi</th>
      <th>Kategori</th>
      <th>Harga</th>
      <th>Gambar</th>
      <th>Aksi</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
      <tr>
        <td><?= $row['nama'] ?></td>
        <td><?= $row['deskripsi'] ?></td>
        <td><?= $row['kategori'] ?></td>
        <td><?= $row['harga'] ?></td>
        <td><img src="../upload/<?= $row['gambar'] ?>" width="100"></td>
        <td>
          <a href="edit_menu.php?id=<?= $row['id'] ?>">Edit</a> |
          <a href="hapus_menu.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin hapus menu ini?')">Hapus</a>
        </td>
      </tr>
    <?php } ?>
  </table>
</body>

</html>