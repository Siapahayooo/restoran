<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'user') {
    header("Location: ../login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Makanan</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Eczar:wght@400..800&family=Share+Tech&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="style-user.css">
</head>

<body>
    <header>
        <div class="navbar">
            <h1>S!Restoran</h1>
            <nav>
                <ul>
                    <li><a href="../index.php">Beranda</a></li>
                    <li><a href="#">Tentang</a></li>
                    <li><a href="#">Kontak</a></li>
                    <li><a href="keranjang.php">🛒 Keranjang</a></li>
                    <li><a href="status_pesanan.php">📄 Status Pesanan</a></li>
                    <li><a href="riwayat.php">📜 Riwayat Pesanan</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="menu">
        <ul>
            <button><a href="minuman.php">Minuman</a></button>
        </ul>
    </div>

    <div class="menu-container">
        <?php
        $makanan = mysqli_query($conn, "SELECT * FROM menu WHERE kategori='makanan'");
        while ($m = mysqli_fetch_assoc($makanan)): ?>
            <div class="menu-card">
                <img src="../upload/<?= $m['gambar']; ?>" width="100">
                <h4><?= $m['nama']; ?></h4>
                <p><?= $m['deskripsi']; ?></p>
                <p><strong>Rp<?= number_format($m['harga']); ?></strong></p>
                <form method="POST" action="tambah_keranjang.php">
                    <input type="hidden" name="id_menu" value="<?= $m['id']; ?>">
                    <input type="number" name="jumlah" value="1" min="1" required>
                    <button type="submit">+ Tambah ke Keranjang</button>
                </form>
            </div>
        <?php endwhile; ?>
    </div>
</body>

</html>