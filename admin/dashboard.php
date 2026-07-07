<?php

session_start();

if(!isset($_SESSION['role']) || $_SESSION['role']!="admin")
{
    header("Location: ../login.php");
    exit;
}

include '../components/navbar.php';

?>

<!DOCTYPE html>
<html>
<head>

<title>Dashboard Admin</title>

<link rel="stylesheet"
href="../assets/css/style.css">

<link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@400;500;600;700&family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">

</head>

<body>

<div class="main-wrapper">

<?php include '../components/sidebar_admin.php'; ?>

<div class="content">

<!-- WELCOME -->

<div class="welcome-box">

<h1>🍩 Dashboard Admin</h1>

<p>
Selamat datang di Sistem Pendukung Keputusan
Pemilihan Donat Terbaik menggunakan metode TOPSIS.
</p>

</div>

<!-- STATISTIK -->

<div class="card-group">

<div class="cute-card">

<h2>5</h2>

<p>Total Donat</p>

</div>

</div>

<!-- BEST DONUT -->

<h2 class="section-title">
🏆 Donat Terbaik Saat Ini
</h2>

<div class="winner-card">

<img
src="../assets/img/Untitled design (27).png"
class="winner-img">

<h2>🍓 Strawberry Dream</h2>

<p>
Nilai Preferensi TOPSIS
</p>

<h1 style="color:#8bb17a;">
0.832
</h1>

</div>

<!-- QUICK MENU -->

<h2 class="section-title">
⚡ Quick Menu
</h2>

<div class="card-group">

<div class="cute-card">

<h2>🍩</h2>

<p>Data Donat</p>

</div>

</div>


</div>

</div>

<?php include '../components/footer.php'; ?>

</body>
</html>