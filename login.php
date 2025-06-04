<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
  $data = mysqli_fetch_assoc($query);

  if ($data && password_verify($password, $data['password'])) {
    $_SESSION['user_id'] = $data['id'];
    $_SESSION['username'] = $data['username'];
    $_SESSION['role'] = $data['role'];

    if ($data['role'] == 'admin') {
      header("Location: admin/index.php");
    } else {
      header("Location: user/menu_user.php");
    }
  } else {
    echo "<script>alert('Username atau password salah!');</script>";
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="login-box">
    <div class="h2-box">
      <h2>Login</h2>
      <div class="login-container">
        <div class="container">
          <form method="POST" action="proses_login.php">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Login</button>
            <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
          </form>
        </div>
      </div>
    </div>

  </div>
</body>

</html>