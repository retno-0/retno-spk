<?php

require_once __DIR__ . "/../config/koneksi.php";

/* ==========================
   Donat Terbaik (Score Tertinggi)
========================== */

$queryTerbaik = mysqli_query($conn,"
SELECT *
FROM donat
ORDER BY score DESC
LIMIT 1
");

$terbaik = mysqli_fetch_assoc($queryTerbaik);

/* ==========================
   Semua Donat
========================== */

$queryDonat = mysqli_query($conn,"
SELECT *
FROM donat
ORDER BY score DESC
");

?>

<!DOCTYPE html>
<html>

<head>

<title>Recommendation Result</title>

<link rel="stylesheet"
href="../assets/css/style.css">

<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">

</head>

<body>

<?php include "../components/navbar_pembeli.php"; ?>

<div class="main-wrapper">

<?php include "../components/sidebar_pembeli.php"; ?>

<div class="content">

<div class="recommend-header">

<h1>🏆 Your Sweet Recommendation</h1>

<p>

Based on TOPSIS calculation, we found the best donut for you.

</p>

</div>

<!-- ===================== BEST DONUT ===================== -->

<div class="winner-card">

<img
src="../assets/img/<?php echo $terbaik['gambar']; ?>"
style="width:260px;border-radius:25px;">

<br><br>

<h2>

🍩 <?php echo $terbaik['nama_donat']; ?>

</h2>

<br>

<div class="recommend-info">

<div class="info-box">

💰

<h4>Price</h4>

<p>

Rp<?= number_format($terbaik['harga'],0,",","."); ?>

</p>

</div>

<div class="info-box">

⭐

<h4>Taste</h4>

<p>

<?= $terbaik['rasa']; ?>/10

</p>

</div>

<div class="info-box">

🎨

<h4>Appearance</h4>

<p>

<?= $terbaik['tampilan']; ?>/10

</p>

</div>

</div>

<br>

<p>

<b>TOPSIS Score :</b>

<?= number_format($terbaik['score'],3); ?>

</p>

<br>

<p>

This donut has the highest preference value based on the TOPSIS decision support method.

</p>

<br>

<div class="recommend-action">

<a
href="tambah_keranjang.php?id=<?= $terbaik['id_donat']; ?>"
class="btn-checkout">

🛒 Add To Cart

</a>

<a
href="spinner.php"
class="btn-edit">

🎡 Spin Again

</a>

</div>

</div>

<!-- ===================== OTHER DONUT ===================== -->

<h2 class="section-title">

🍩 Other Sweet Choices

</h2>

<div class="product-grid">

<?php while($d=mysqli_fetch_assoc($queryDonat)){ ?>

<div class="donut-card">

<img
src="../assets/img/<?php echo $d['gambar']; ?>">

<div class="donut-info">

<h3>

🍩 <?php echo $d['nama_donat']; ?>

</h3>

<p>

Harga :
<b>

Rp<?= number_format($d['harga'],0,",","."); ?>

</b>

</p>

<p>

⭐ Rasa :
<?= $d['rasa']; ?>/10

</p>

<p>

🎨 Tampilan :
<?= $d['tampilan']; ?>/10

</p>

<p>

🏆 Score :
<b>

<?= number_format($d['score'],3); ?>

</b>

</p>

<a
href="tambah_keranjang.php?id=<?= $d['id_donat']; ?>"
class="btn-primary">

🛒 Add To Cart

</a>

</div>

</div>

<?php } ?>

</div>

</div>

</div>

<?php include "../components/footer.php"; ?>

</body>

</html>