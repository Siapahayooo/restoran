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

$query = mysqli_query($conn, "SELECT keranjang.*, menu.nama, menu.harga 
    FROM keranjang 
    JOIN menu ON keranjang.id_menu = menu.id 
    WHERE keranjang.id_user=$id_user AND keranjang.status='pending'");

$total = 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <link rel="stylesheet" href="style-user.css">
</head>

<script>
function tampilkanQR() {
    const metode = document.getElementById("metode").value;
    const qrImg = document.getElementById("qr-img");

    if (metode === "QRIS") {
        qrImg.src = "../image/S!Restoran.png"; // ganti path QR sesuai file kamu
        qrImg.style.display = "block";
    } else if (metode === "Transfer Bank") {
        qrImg.src = "../image/S!Restoran.png";
        qrImg.style.display = "block";
    } else {
        qrImg.style.display = "none";
    }
}
</script>

<body>
    <h2>Checkout Pesanan</h2>
    <form action="proses_checkout.php" method="POST">
        <table>
            <tr>
                <th>Menu</th>
                <th>Harga</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($query)): ?>
                <tr>
                    <td><?= $row['nama']; ?></td>
                    <td>Rp<?= number_format($row['harga']); ?></td>
                </tr>
                <?php $total += $row['harga']; ?>
            <?php endwhile; ?>
            <tr>
                <td><strong>Total</strong></td>
                <td><strong>Rp<?= number_format($total); ?></strong></td>
            </tr>
        </table>
        <br>
        <label for="metode">Metode Pembayaran:</label>
        <select name="metode_pembayaran" id="metode" onchange="tampilkanQR()" required>
            <option value="">-- Pilih --</option>
            <option value="QRIS">QRIS</option>
            <option value="Transfer Bank">Transfer Bank</option>
            <option value="COD">COD (Bayar di Tempat)</option>
        </select>

        <div id="qr-container" style="margin-top: 20px;">
            <img id="qr-img" src="" alt="QR Code" style="display:none; width:200px;">
        </div>
        </select>
        <br>
        <button type="submit">Selesaikan Pesanan</button>
    </form>
</body>

</html>