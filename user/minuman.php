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
    <title>Menu Minuman</title>
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
                </ul>
            </nav>
        </div>
    </header>

    <h2>Menu Minuman</h2>
    <div class="menu-container-minuman">
        <?php
        $minuman = mysqli_query($conn, "SELECT * FROM menu WHERE kategori='minuman'");
        while ($n = mysqli_fetch_assoc($minuman)): ?>
            <div class="card-minuman">
                <img src="../upload/<?= $n['gambar']; ?>" width="100">
                <h4><?= $n['nama']; ?></h4>
                <p><?= $n['deskripsi']; ?></p>
                <p><strong>Rp<?= number_format($n['harga']); ?></strong></p>
                <div class="bottom-minuman">
                    <form method="POST" action="tambah_keranjang.php">
                        <input type="hidden" name="id_menu" value="<?= $n['id']; ?>">
                        <input type="number" name="jumlah" value="1" min="1" required>
                        <button type="submit">+ Tambah ke Keranjang</button>
                    </form>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</body>

</html>