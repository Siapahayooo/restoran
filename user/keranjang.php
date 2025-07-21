<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'user') {
    header("Location: ../login.php");
    exit;
}

// Ambil id user berdasarkan username login
$username = $_SESSION['username'];
$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE username='$username'"));
$id_user = $user['id'];

// Ambil data keranjang user
$query = "SELECT keranjang.id, menu.nama, menu.harga, menu.gambar, keranjang.jumlah 
          FROM keranjang 
          JOIN menu ON keranjang.id_menu = menu.id 
          WHERE keranjang.id_user = $id_user AND keranjang.status = 'pending'";
          $result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Keranjang Saya</title>
    <link rel="stylesheet" href="style-user.css"> <!-- Pastikan file ini sudah ada -->
</head>

<body>
    <header>
        <div class="navbar">
            <h1>S!Restoran</h1>
            <nav>
                <ul>
                    <li><a href="menu_user.php">Menu</a></li>
                    <li><a href="keranjang.php">Keranjang</a></li>
                    <li><a href="../logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <h2 style="text-align:center; margin-top: 20px;">Keranjang Saya</h2>
    <div style="text-align:center; margin-bottom: 20px;"></div>
        <a href="menu_user.php">
            <button style="padding: 10px 20px; font-size: 16px;">Kembali ke Menu</button>
        </a>
    <div class="menu-container">
        <?php
        $total = 0; // Inisialisasi total harga
        while ($row = mysqli_fetch_assoc($result)):
            $total += $row['harga'] * $row['jumlah'];
            ?>
            <div class="menu-card">
                <img src="../upload/<?= $row['gambar']; ?>" width="100">
                <h4><?= $row['nama']; ?></h4>
                <p>Harga: Rp<?= number_format($row['harga']); ?></p>
                <p>Jumlah: <?= $row['jumlah']; ?></p>
                <form method="POST" action="hapus_keranjang.php">
                    <input type="hidden" name="id_keranjang" value="<?= $row['id']; ?>">
                    <button type="submit" onclick="return confirm('Yakin ingin menghapus item ini?')">Hapus</button>
                </form>
            </div>
        <?php endwhile; ?>
    </div>

    <?php if ($total > 0): ?>
        <div style="text-align:center; margin-top: 30px;">
            <h3>Total: Rp<?= number_format($total); ?></h3>
            <a href="checkout.php">
                <button style="padding: 10px 20px; font-size: 16px;">Checkout Sekarang</button>
            </a>
        </div>
    <?php else: ?>
        <p style="text-align:center; margin-top: 30px;">Keranjang Anda kosong.</p>
    <?php endif; ?>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color:rgb(244, 244, 244);
            margin: 0;
            padding: 0;
        }
        header {
            background-color: green;
            color: white;
            padding: 10px 0;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: auto;
            padding: 0 20px;
        }
        .navbar h1 {
            margin: 0;
        }
        .navbar nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }
        .navbar nav ul li {
            display: inline;
            margin-right: 20px;
        }
        .navbar nav ul li a {
            color: white;
            text-decoration: none;
        }
        .menu-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 20px;
        }
        .menu-card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin: 10px;
            padding: 15px;
            text-align: center;
            width: 250px; /* Set a fixed width for the cards */
        }
        .menu-card img {
            width: 100%;
            height: auto;
        }
    </style>
</body>

</html>