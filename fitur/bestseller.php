<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<section class="unggulan">
  <h2>Menu Unggulan Kami</h2>
  <div class="menu-grid">
    <div class="menu-card">
      <img src="image/assets/pg" alt="Mie Pedas">
      <h4>Mie Pedas Gila</h4>
      <p>Mie dengan level pedas sesuai selera Anda.</p>
      <span class="harga">Rp 20.000</span>
    </div>
    <div class="menu-card">
      <img src="image/assets/" alt="Es Kopi">
      <h4>Es Kopi Susu</h4>
      <p>Kopi segar dengan susu kental manis premium.</p>
      <span class="harga">Rp 18.000</span>
    </div>
    <div class="menu-card">
      <img src="image/assets/nasi goreng.jpg" alt="Nasi Goreng">
      <h4>Nasi Goreng Special</h4>
      <p>Nasi goreng lengkap dengan telur dan ayam.</p>
      <span class="harga">Rp 25.000</span>
    </div>
  </div>
</section>
<style>
  .unggulan {
    padding: 50px 0;
    text-align: center;
    background-color: #f8f9fa;
  }
  .unggulan h2 {
    margin-bottom: 30px;
    font-size: 2.5rem;
    color: #333;
  }
  .menu-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    padding: 0 20px;
  }
  .menu-card {
    background-color: white;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    padding: 20px;
    text-align: center;
  }
  .menu-card img {
    width: 100%;
    height: auto;
    border-radius: 10px;
  }
  .menu-card h4 {
    margin-top: 15px;
    font-size: 1.5rem;
    color: #333;
  }
  .menu-card p {
    font-size: 1rem;
    color: #666;
    margin-bottom: 10px;
  }
  .harga {
    font-size: 1.2rem;
    color: #28a745;
    font-weight: bold;
  }
    @media (max-width: 768px) {
        .unggulan h2 {
        font-size: 2rem;
        }
        .menu-grid {
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        }
    }
  @media (max-width: 480px) {
    .unggulan h2 {
      font-size: 1.5rem;
    }
    .menu-grid {
      grid-template-columns: 1fr;
    }
    .menu-card {
      padding: 15px;
    }
    .menu-card h4 {
      font-size: 1.2rem;
    }
    .menu-card p {
      font-size: 0.9rem;
    }
    .harga {
      font-size: 1rem;
    }
  }
  .menu-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 12px rgba(0,0,0,0.2);
  }
  .menu-card img:hover {
    transform: scale(1.05);
    transition: transform 0.3s ease;
  }
  .menu-card h4:hover {
    color: #007bff;
    transition: color 0.3s ease;
  }
  .menu-card p:hover {
    color: #555;
    transition: color 0.3s ease;
  }
  .harga:hover {
    color: #dc3545;
    transition: color 0.3s ease;
  }
  .menu-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  .menu-card img {
    transition: transform 0.3s ease;
  }
  .menu-card h4, .menu-card p, .harga {
    transition: color 0.3s ease;
  }
  .menu-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 12px rgba(0,0,0,0.2);
  }
  .menu-card img:hover {
    transform: scale(1.05);
    transition: transform 0.3s ease;
  }
</style>
</section>
</body>
</html>