<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<section class="galeri">
  <h2>Galeri Restoran</h2>
  <div class="galeri-grid">
    <img src="image/assets/galeri1.jpg" alt="Restoran 1">
    <img src="image/assets/galeri2.jpg" alt="Restoran 2">
    <img src="image/assets/chef.juna.jpg" alt="Restoran 3">
    <img src="image/assets/chef.rennata.jpg" alt="Restoran 4">
  </div>
</section>
<style>
  .galeri {
    padding: 50px 0;
    text-align: center;
  }
  .galeri h2 {
    margin-bottom: 30px;
    font-size: 2.5rem;
    color: #333;
  }
  .galeri-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    padding: 0 20px;
  }
  .galeri-grid img {
    width: 100%;
    height: auto;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
  }
    @media (max-width: 768px) {
        .galeri h2 {
        font-size: 2rem;
        }
        .galeri-grid {
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        }
    }
  @media (max-width: 480px) {
    .galeri h2 {
      font-size: 1.5rem;
    }
    .galeri-grid {
      grid-template-columns: 1fr;
    }
    .galeri-grid img {
      width: 100%;
      height: auto;
    }
  }
  
</style>
</body>
</html>