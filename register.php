<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $username = $_POST['username'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $role = 'user';

  $cek = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
  if (mysqli_num_rows($cek) > 0) {
    echo "<script>alert('Username sudah terdaftar!');</script>";
  } else {
    $insert = mysqli_query($conn, "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')");
    if ($insert) {
      echo "Registrasi sukses! <a href='login.php'>Login sekarang</a>";
    } else {
      echo "Gagal mendaftar!";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="login-box">
    <div class="h2-box">
      <h2>Register</h2>
      <div class="login-container">
        <div class="container">
          <form method="POST" action="proses_register.php">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Register</button>
          </form>
        </div>
      </div>
    </div>

  </div>
</body>

</html>
