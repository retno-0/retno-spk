<?php
session_start();

require_once __DIR__ . "/../config/koneksi.php";

include "../components/navbar_pembeli.php";

/*
==============================
AMBIL DATA KERANJANG
==============================
*/

$query=mysqli_query($conn,"
SELECT
keranjang.id_keranjang,
keranjang.qty,

donat.id_donat,
donat.nama_donat,
donat.harga,
donat.gambar

FROM keranjang

JOIN donat
ON keranjang.id_donat=donat.id_donat

ORDER BY keranjang.id_keranjang DESC
");

$totalItem=0;
$subtotal=0;

?>

<!DOCTYPE html>
<html>
<head>

<title>Keranjang</title>

<link rel="stylesheet"
href="../assets/css/style.css">

<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">

</head>

<body>

<div class="main-wrapper">

<?php include '../components/sidebar_pembeli.php'; ?>

<div class="content">

<h1>🛒 Keranjang Saya</h1>

<div class="cart-wrapper">

    <div class="cart-list">

<?php

if(mysqli_num_rows($query)>0){

while($d=mysqli_fetch_assoc($query)){

$total=$d['harga']*$d['qty'];

$totalItem+=$d['qty'];

$subtotal+=$total;

?>

<div class="cart-item">

<img
src="../assets/img/<?= $d['gambar'];?>"
class="cart-img">

<div class="cart-info">

<h3>

🍩 <?= $d['nama_donat']; ?>

</h3>

<span>

Rp<?= number_format($d['harga'],0,",","."); ?>

</span>

</div>

<div class="cart-qty">

<a href="qty_minus.php?id=<?= $d['id_keranjang']; ?>">

<button>-</button>

</a>

<span>

<?= $d['qty']; ?>

</span>

<a href="qty_plus.php?id=<?= $d['id_keranjang']; ?>">

<button>+</button>

</a>

</div>

<h3>

Rp<?= number_format($total,0,",","."); ?>

</h3>
<a
href="hapus_keranjang.php?id=<?= $d['id_keranjang'];?>"
class="btn-delete"
onclick="return confirm('Hapus donat dari keranjang?')">

🗑 Hapus

</a>

</div>

<?php

}

}else{

?>

<div class="cute-card">

<h2>🛒</h2>

<p>

Keranjang masih kosong.

</p>

</div>

<?php } ?>

</div>

    <div class="cart-summary">

<h2>

🧾 Ringkasan Belanja

</h2>

<div class="summary-row">

<span>Total Item</span>

<span>

<?= $totalItem; ?>

</span>

</div>

<div class="summary-row">

<span>Subtotal</span>

<span>

Rp<?= number_format($subtotal,0,",","."); ?>

</span>

</div>

<div class="summary-row">

<span>Ongkir</span>

<span>

Rp0

</span>

</div>

<hr>

<div class="summary-total">

<span>Total</span>

<span>

Rp<?= number_format($subtotal,0,",","."); ?>

</span>

</div>

<a
href="checkout.php"
class="btn-checkout">

💳 Checkout Sekarang

</a>

    </div>

</div>

</div>

</div>

<?php include '../components/footer.php'; ?>

</body>
</html>