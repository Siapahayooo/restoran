<?php
include 'koneksi.php';
session_start();


$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = mysqli_query($conn, $query);
$data   = mysqli_fetch_assoc($result);
print_r($data);
if ($data) {
    session_start();
    $_SESSION['username'] = $data['username'];
    $_SESSION['role'] = $data['role'];
    $_SESSION['user_id'] = $data['id'];

    if ($data['role'] == 'admin') {
        header("Location: admin/index.php");
    } else {
        header("Location: user/menu_user.php");
    }
} else {
    echo "<script>alert('Username atau password salah!'); window.location.href='login.php';</script>";
}
?>