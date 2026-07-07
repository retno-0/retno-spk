<?php

session_start();

include "config/koneksi.php";

if(isset($_POST['login']))
{

    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);

    $query = mysqli_query($conn,

    "SELECT * FROM admin
    WHERE username='$username'
    AND password='$password'");

    if(mysqli_num_rows($query)>0)
    {

        $data = mysqli_fetch_assoc($query);

        $_SESSION['role']="admin";
        $_SESSION['id_admin']=$data['id_admin'];
        $_SESSION['nama_admin']=$data['nama_admin'];

        header("Location: admin/dashboard.php");
        exit;

    }

    $error="Username atau Password salah!";

}

?>

<!DOCTYPE html>
<html>
<head>

<title>Donutlicious Login</title>

<link rel="stylesheet" href="assets/css/style.css">

<link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@400;500;600;700&family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">

</head>

<body class="login-page">

<div class="login-wrapper">

    <div class="login-header">

        <div class="login-icon">
            <img src="assets/img/Untitled design (45).png">
        </div>

        <h1>Donut Choice</h1>

        <p>Sweet Decision System</p>

    </div>

    <?php if(isset($error)){ ?>

        <div class="error-box">
            <?= $error ?>
        </div>

    <?php } ?>

    <form method="POST">

        <div class="input-group">

            <label>👤 Username</label>

            <input
                type="text"
                name="username"
                placeholder="Masukkan Username"
                required>

        </div>

        <div class="input-group">

            <label>🔒 Password</label>

            <input
                type="password"
                name="password"
                placeholder="Masukkan Password"
                required>

        </div>

        <button
            type="submit"
            name="login"
            class="btn-login">

            Login

        </button>

    </form>

</div>

</body>
</html>