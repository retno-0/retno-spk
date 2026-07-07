<?php
session_start();

require_once __DIR__ . "/../config/koneksi.php";

$query=mysqli_query($conn,"
SELECT *
FROM pesanan
ORDER BY tanggal DESC
");
?>

<!DOCTYPE html>

<html>

<head>

<title>Riwayat Pesanan</title>

<link rel="stylesheet" href="../assets/css/style.css">

<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">

</head>

<body>

<?php include "../components/navbar_pembeli.php"; ?>

<div class="main-wrapper">

<?php include "../components/sidebar_pembeli.php"; ?>

<div class="content">

<h1>📜 Riwayat Pesanan</h1>

<div class="table-card">

<table>

<tr>

<th>No</th>

<th>Tanggal</th>

<th>Donat</th>

<th>Qty</th>

<th>Total</th>

<th>Pembayaran</th>

</tr>

<?php

$no=1;

while($d=mysqli_fetch_assoc($query)){

?>

<tr>

<td><?= $no++; ?></td>

<td><?= date("d-m-Y H:i",strtotime($d['tanggal'])); ?></td>

<td>🍩 <?= $d['nama_donat']; ?></td>

<td><?= $d['qty']; ?></td>

<td>Rp<?= number_format($d['total'],0,",","."); ?></td>

<td><?= $d['pembayaran']; ?></td>

</tr>

<?php } ?>

</table>

</div>

</div>

</div>

<?php include "../components/footer.php"; ?>

</body>

</html>