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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style-index.css">
</head>

<body>
<?php 
  include 'header.php';
?>

    <div class="menu-container">
        <?php
        $minuman = mysqli_query($conn, "SELECT * FROM menu WHERE kategori='minuman'");
        while ($n = mysqli_fetch_assoc($minuman)): ?>
            <div class="menu-card">
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

    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
  }

a {
    text-decoration: none;
    color: white;
}

h2 {
    text-align: center;
    margin-top: 20px;
}


        .menu-container {
    display: flex;
    flex-wrap: wrap;
    gap: 100px;
    justify-content: center;
    margin-top: 20px;
}

.menu-card {
    width: 250px;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 30px;
    text-align: center;
    background: #fff;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.menu-card img {
    width: 100%;
    height: 250px;
    object-fit: cover;
    border-radius: 6px;
}

.menu-card p {
    font-size: small;
    font-weight: bold;
    height: 20px;
}

.bottom-makanan {
    display: flex;
    justify-content: center;
    margin-top: 30px;
}

.menu-card button {
    background-color: green;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
}

.menu-card button:hover {
    background-color: rgb(11, 155, 11);
}
    </style>
</body>

</html>