<?php
session_start();

require_once __DIR__ . "/../config/koneksi.php";

include "../components/navbar_pembeli.php";

/*
===========================
AMBIL DATA KERANJANG
===========================
*/

$query=mysqli_query($conn,"
SELECT
keranjang.*,
donat.nama_donat,
donat.harga,
donat.gambar

FROM keranjang

JOIN donat
ON keranjang.id_donat=donat.id_donat
");

$total=0;
?>

<!DOCTYPE html>
<html>
<head>

<title>Checkout</title>

<link rel="stylesheet"
href="../assets/css/style.css">

<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">

</head>

<body>

<div class="main-wrapper">

    <?php include '../components/sidebar_pembeli.php'; ?>

    <div class="content">

        <h1>💳 Checkout</h1>

        <div class="checkout-wrapper">

            <!-- FORM PEMESAN -->

            <div class="checkout-card">

<form action="buat_pesanan.php" method="POST">

<div class="checkout-header">

<div class="checkout-icon">

🍩

</div>

<div>

<h2>Informasi Pemesan</h2>

<p>Lengkapi data untuk proses pemesanan.</p>

</div>

</div>

<input
type="text"
name="nama"
placeholder="Nama Lengkap"
required>

<input
type="text"
name="telepon"
placeholder="Nomor HP"
required>

<textarea
name="alamat"
placeholder="Alamat Pengiriman"
required></textarea>

<h2>💳 Metode Pembayaran</h2>

<select name="pembayaran">

<option>Transfer Bank</option>

<option>DANA</option>

<option>OVO</option>

<option>GoPay</option>

<option>COD</option>

</select>

<button
type="submit"
class="btn-order">

🍩 Buat Pesanan

</button>

</form>

</div>

            <!-- RINGKASAN PESANAN -->

            <div class="order-summary">

<h2>🛒 Ringkasan Pesanan</h2>

<?php

if(mysqli_num_rows($query)==0){

?>

<div class="cute-card">

<h3>Keranjang masih kosong.</h3>

</div>

<?php

}else{

mysqli_data_seek($query,0);

while($d=mysqli_fetch_assoc($query)){

$jumlah = $d['harga'] * $d['qty'];

$total += $jumlah;

?>

<div class="summary-item">

<div>

<b>🍩 <?= $d['nama_donat']; ?></b>

<br>

<small>

<?= $d['qty']; ?> x
Rp<?= number_format($d['harga'],0,",","."); ?>

</small>

</div>

<div>

Rp<?= number_format($jumlah,0,",","."); ?>

</div>

</div>

<?php

}

?>

<div class="summary-total">

<span>Total</span>

<span>

Rp<?= number_format($total,0,",","."); ?>

</span>

</div>

<button class="btn-order">

✔ Konfirmasi Pesanan

</button>

<?php } ?>

</div>

        </div>

    </div>

</div>

<?php include '../components/footer.php'; ?>

</body>
</html>