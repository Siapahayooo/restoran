<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

$status_filter = isset($_GET['status']) && $_GET['status'] != '' ? $_GET['status'] : '';
$where_status = $status_filter ? "WHERE pesanan.status = '$status_filter'" : '';

$pesanan = mysqli_query($conn, "SELECT pesanan.*, users.username, menu.nama AS nama_menu 
    FROM pesanan 
    JOIN users ON pesanan.id_user = users.id
    JOIN menu ON pesanan.id_menu = menu.id
    $where_status
    ORDER BY pesanan.id DESC");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Data Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-4">
        <h2 class="mb-4 text-center">Data Pesanan Pengguna</h2>

        <form method="GET" class="mb-3 d-flex justify-content-end">
            <div class="input-group w-25">
                <label class="input-group-text" for="status">Status</label>
                <select name="status" id="status" class="form-select" onchange="this.form.submit()">
                    <option value="">Semua</option>
                    <option value="pending" <?= $status_filter == 'pending' ? 'selected' : '' ?>>Pending</option>
                    <option value="diproses" <?= $status_filter == 'diproses' ? 'selected' : '' ?>>Diproses</option>
                    <option value="selesai" <?= $status_filter == 'selesai' ? 'selected' : '' ?>>Selesai</option>
                    <option value="dibatalkan" <?= $status_filter == 'dibatalkan' ? 'selected' : '' ?>>Dibatalkan</option>
                </select>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered table-hover bg-white">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama User</th>
                        <th>Menu</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                        <th>Metode</th>
                        <th>Status</th>
                        <th>Bukti</th>
                        <th>Status Bayar</th>
                        <th>Aksi</th>
                        <th>Hapus</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    while ($row = mysqli_fetch_assoc($pesanan)) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($row['username']); ?></td>
                            <td><?= htmlspecialchars($row['nama_menu']); ?></td>
                            <td><?= $row['jumlah']; ?></td>
                            <td>Rp<?= number_format($row['total_harga']); ?></td>
                            <td><?= htmlspecialchars($row['metode_pembayaran']); ?></td>
                            <td>
                                <form action="ubah_status.php" method="POST" class="d-flex">
                                    <input type="hidden" name="id_pesanan" value="<?= $row['id']; ?>">
                                    <select name="status" class="form-select form-select-sm me-2">
                                        <option value="pending" <?= $row['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                                        <option value="diproses" <?= $row['status'] == 'diproses' ? 'selected' : '' ?>>Diproses</option>
                                        <option value="selesai" <?= $row['status'] == 'selesai' ? 'selected' : '' ?>>Selesai</option>
                                        <option value="dibatalkan" <?= $row['status'] == 'dibatalkan' ? 'selected' : '' ?>>Dibatalkan</option>
                                    </select>
                                    <button class="btn btn-sm btn-primary">Ubah</button>
                                </form>
                            </td>
                            <td>
                                <?php if ($row['bukti_bayar']) : ?>
                                    <a href="../bukti/<?= $row['bukti_bayar']; ?>" class="btn btn-sm btn-outline-success" target="_blank">Lihat</a>
                                <?php else : ?>
                                    <span class="text-muted">Belum Upload</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <span class="badge bg-<?= $row['status_pembayaran'] == 'menunggu' ? 'warning' : ($row['status_pembayaran'] == 'diterima' ? 'success' : 'danger') ?>">
                                    <?= ucfirst($row['status_pembayaran']); ?>
                                </span>
                            </td>
                            <td>
                                <?php if ($row['status_pembayaran'] == 'menunggu') : ?>
                                    <a href="verifikasi.php?id=<?= $row['id']; ?>&status=diterima" class="btn btn-sm btn-success">Terima</a>
                                    <a href="verifikasi.php?id=<?= $row['id']; ?>&status=ditolak" class="btn btn-sm btn-danger">Tolak</a>
                                <?php else : ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <form method="POST" action="hapus_pesanan.php" onsubmit="return confirm('Yakin hapus pesanan ini?')">
                                    <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>