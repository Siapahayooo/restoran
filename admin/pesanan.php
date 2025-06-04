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
<html>
<head>
    <meta charset="UTF-8">
    <title>Data Pesanan</title>
    <link rel="stylesheet" href="style-admin.css">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #aaa;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        select, button {
            padding: 5px 10px;
        }

        form.inline {
            display: inline;
        }

        .filter-container {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h2>Data Pesanan Pengguna</h2>

    <div class="filter-container">
        <form method="GET" action="">
            <label for="status">Filter Status: </label>
            <select name="status" id="status" onchange="this.form.submit()">
                <option value="">Semua</option>
                <option value="pending" <?= $status_filter == 'pending' ? 'selected' : '' ?>>Pending</option>
                <option value="diproses" <?= $status_filter == 'diproses' ? 'selected' : '' ?>>Diproses</option>
                <option value="selesai" <?= $status_filter == 'selesai' ? 'selected' : '' ?>>Selesai</option>
                <option value="dibatalkan" <?= $status_filter == 'dibatalkan' ? 'selected' : '' ?>>Dibatalkan</option>
            </select>
        </form>
    </div>

    <table>
        <tr>
            <th>No</th>
            <th>Username</th>
            <th>Menu</th>
            <th>Jumlah</th>
            <th>Total Harga</th>
            <th>Metode</th>
            <th>Status</th>
            <th>Ubah Status</th>
            <th>Bukti</th>
            <th>Status Bayar</th>
            <th>Verifikasi</th>
            <th>Hapus</th>
        </tr>

        <?php $no = 1; while ($row = mysqli_fetch_assoc($pesanan)) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= htmlspecialchars($row['username']); ?></td>
                <td><?= htmlspecialchars($row['nama_menu']); ?></td>
                <td><?= $row['jumlah']; ?></td>
                <td>Rp<?= number_format($row['total_harga']); ?></td>
                <td><?= htmlspecialchars($row['metode_pembayaran']); ?></td>
                <td><?= ucfirst($row['status']); ?></td>
                
                <td>
                    <form method="POST" action="ubah_status.php" class="inline">
                        <input type="hidden" name="id_pesanan" value="<?= $row['id']; ?>">
                        <select name="status">
                            <option value="pending" <?= $row['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                            <option value="diproses" <?= $row['status'] == 'diproses' ? 'selected' : '' ?>>Diproses</option>
                            <option value="selesai" <?= $row['status'] == 'selesai' ? 'selected' : '' ?>>Selesai</option>
                            <option value="dibatalkan" <?= $row['status'] == 'dibatalkan' ? 'selected' : '' ?>>Dibatalkan</option>
                        </select>
                        <button type="submit">Ubah</button>
                    </form>
                </td>

                <td>
                    <?php if ($row['bukti_bayar']) : ?>
                        <a href="../bukti/<?= $row['bukti_bayar']; ?>" target="_blank">Lihat</a>
                    <?php else : ?>
                        <span style="color: red;">Belum Upload</span>
                    <?php endif; ?>
                </td>

                <td><?= ucfirst($row['status_pembayaran']); ?></td>

                <td>
                    <?php if ($row['status_pembayaran'] == 'menunggu') : ?>
                        <a href="verifikasi.php?id=<?= $row['id']; ?>&status=diterima">✔ Terima</a> |
                        <a href="verifikasi.php?id=<?= $row['id']; ?>&status=ditolak">✘ Tolak</a>
                    <?php else: ?>
                        -
                    <?php endif; ?>
                </td>

                <td>
                    <form method="POST" action="hapus_pesanan.php" onsubmit="return confirm('Yakin hapus pesanan ini?')" class="inline">
                        <input type="hidden" name="id" value="<?= $row['id']; ?>">
                        <button type="submit">Hapus</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>