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

// Ambil semua pesanan milik user
$status_filter = isset($_GET['status']) && $_GET['status'] != '' ? $_GET['status'] : '';
$where_status = $status_filter ? "AND pesanan.status = '$status_filter'" : '';

$query = mysqli_query($conn, "SELECT pesanan.*, menu.nama AS nama_menu 
    FROM pesanan 
    JOIN menu ON pesanan.id_menu = menu.id 
    WHERE pesanan.id_user = $id_user $where_status
    ORDER BY pesanan.id DESC");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Status Pesanan</title>
    <link rel="stylesheet" href="style-user.css">
</head>

<body>
    <h2>Status Pesanan Saya</h2>
    <table border="1" cellpadding="10">
        <form method="GET" action="">
            <label for="status">Filter Status: </label>
            <select name="status" id="status" onchange="this.form.submit()">
                <option value="">Semua</option>
                <option value="pending" <?= isset($_GET['status']) && $_GET['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                <option value="diproses" <?= isset($_GET['status']) && $_GET['status'] == 'diproses' ? 'selected' : '' ?>>Diproses</option>
                <option value="selesai" <?= isset($_GET['status']) && $_GET['status'] == 'selesai' ? 'selected' : '' ?>>Selesai</option>
                <option value="dibatalkan" <?= isset($_GET['status']) && $_GET['status'] == 'dibatalkan' ? 'selected' : '' ?>>Dibatalkan</option>
            </select>
        </form>
        <tr>
            <th>Menu</th>
            <th>Jumlah</th>
            <th>Total Harga</th>
            <th>Status</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($query)) : ?>
            <tr>
                <td><?= $row['nama_menu']; ?></td>
                <td><?= $row['jumlah']; ?></td>
                <td>Rp<?= number_format($row['total_harga']); ?></td>
                <td><?= ucfirst($row['status']); ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>

</html>