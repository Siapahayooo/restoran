<?php
include '../koneksi.php';
$result = mysqli_query($conn, "SELECT * FROM menu");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin | Daftar Menu</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="admin-style.css">
</head>
<body>
  <div class="container mt-5">
    <h2 class="mb-4 text-center">Manajemen Menu Restoran</h2>

    <div class="d-flex justify-content-between mb-3">
      <div>
        <a href="tambah_menu.php" class="btn btn-primary">+ Tambah Menu</a>
        <a href="pesanan.php" class="btn btn-success">Daftar Pesanan</a>
      </div>
      <a href="../logout.php" class="btn btn-danger">Logout</a>
    </div>

    <table class="table table-bordered table-hover">
      <thead class="table-dark">
        <tr>
          <th>Nama</th>
          <th>Deskripsi</th>
          <th>Kategori</th>
          <th>Harga</th>
          <th>Gambar</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
          <tr>
            <td><?= htmlspecialchars($row['nama']) ?></td>
            <td><?= htmlspecialchars($row['deskripsi']) ?></td>
            <td><?= ucfirst($row['kategori']) ?></td>
            <td>Rp<?= number_format($row['harga']) ?></td>
            <td><img src="../upload/<?= $row['gambar'] ?>" width="80"></td>
            <td>
              <a href="edit_menu.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
              <a href="hapus_menu.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin hapus menu ini?')">Hapus</a>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>