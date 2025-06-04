<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'user') {
    header("Location: ../login.php");
    exit;
}

$username = $_SESSION['username'];
$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id FROM users WHERE username='$username'"));
$id_user = $user['id'];

$query = mysqli_query($conn, "SELECT pesanan.*, menu.nama AS nama_menu 
                              FROM pesanan 
                              JOIN menu ON pesanan.id_menu = menu.id 
                              WHERE pesanan.id_user = $id_user 
                              ORDER BY pesanan.id DESC");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Riwayat Pesanan</title>
    <link rel="stylesheet" href="style-user.css">
</head>

<body>
    <h2>Riwayat Pesanan</h2>
    <table border="1" cellpadding="10">
        <tr>
            <th>Menu</th>
            <th>Jumlah</th>
            <th>Total Harga</th>
            <th>Metode</th>
            <th>print</th>
            <th>Status Bayar</th>
            <th>Bukti</th>
            <th>Upload</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($query)) : ?>
            <tr>
                <td><?= $row['nama_menu']; ?></td>
                <td><?= $row['jumlah']; ?></td>
                <td>Rp<?= number_format($row['total_harga']); ?></td>
                <td><?= $row['metode_pembayaran']; ?></td>
                <td><a href="invoice.php?id=<?= $row['id']; ?>" target="_blank">Cetak Invoice</a></td>
                <td><?= ucfirst($row['status_pembayaran']); ?></td>
                <td>
                    <?php if ($row['bukti_bayar']) : ?>
                        <a href="../bukti/<?= $row['bukti_bayar']; ?>" target="_blank">Lihat</a>
                    <?php else : ?>
                        -
                    <?php endif; ?>
                </td>
                <td>
                    <?php if (!$row['bukti_bayar'] && $row['metode_pembayaran'] != 'COD') : ?>
                        <a href="upload_bukti.php?id=<?= $row['id']; ?>">Upload Bukti</a>
                    <?php elseif ($row['status_pembayaran'] == 'menunggu') : ?>
                        Menunggu Verifikasi
                    <?php elseif ($row['status_pembayaran'] == 'diterima') : ?>
                        Sudah Dibayar
                    <?php elseif ($row['status_pembayaran'] == 'ditolak') : ?>
                        Ditolak - Upload Ulang
                    <?php else : ?>
                        -
                    <?php endif; ?>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>

</html>