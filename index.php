<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Selamat Datang di S!Restoran</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .hero {
            background: url('image/assets/background.jpg') no-repeat center center;
            background-size: cover;
            color: white;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
        .hero h1 {
            font-size: 3rem;
            font-weight: bold;
        }
        .hero p {
            font-size: 1.2rem;
            margin-bottom: 20px;
        }
        .navbar-brand {
            font-weight: bold;
        }
        footer {
            padding: 30px 0;
            background: #f8f9fa;
            text-align: center;
        }
    </style>
</head>
<body>
<!-- Navbar -->
<?php include 'fitur/navbar.php'; ?>
<!-- Slide -->
<?php include 'fitur/slide.php'; ?>

<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <h1>Selamat Datang di S!Restoran</h1>
        <p>Nikmati menu makanan dan minuman terbaik dari kami!</p>
        <a href="user/menu_user.php" class="btn btn-light btn-lg">Lihat Menu</a>
    </div>
</section>

<!-- Galeri -->
<?php include 'fitur/galeri.php'; ?>
<!-- Menu Unggulan -->
<?php include 'fitur/bestseller.php'; ?>

<!-- Tentang -->
<section id="tentang" class="py-5">
    <div class="container text-center">
        <h2 class="mb-4">Tentang Kami</h2>
        <p>S!Restoran adalah tempat terbaik untuk menikmati berbagai hidangan lezat dan minuman segar. Kami mengutamakan kualitas dan kepuasan pelanggan.</p>
    </div>
</section>

<!-- Kontak -->
<?php include 'fitur/kontak.php'; ?>

<!-- Footer -->
<footer>
    <div class="container">
        <p>&copy; <?= date('Y'); ?> S!Restoran. All Rights Reserved.</p>
    </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>