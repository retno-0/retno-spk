<?php
session_start();

if(!isset($_SESSION['role']) || $_SESSION['role']!="admin"){
    header("Location: ../login.php");
    exit;
}

require_once __DIR__ . "/../config/koneksi.php";

$query=mysqli_query($conn,"
SELECT *
FROM pesanan
ORDER BY tanggal DESC
");

$totalPendapatan=0;
$totalPesanan=0;
?>

<!DOCTYPE html>

<html>

<head>

<title>Laporan Penjualan</title>

<link rel="stylesheet"
href="../assets/css/style.css">

<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap"
rel="stylesheet">

</head>

<body>

<?php include "../components/navbar.php"; ?>

<div class="main-wrapper">

<?php include "../components/sidebar_admin.php"; ?>

<div class="content">

<div id="laporanPDF">

<h1>📑 Laporan Penjualan</h1>

<div class="action-bar">

<a href="#" id="downloadPDF" class="btn-primary">
    📄 Download PDF
</a>
</div>

<div class="table-card">

<?php

if(mysqli_num_rows($query)>0){

?>

<table>

<tr>

<th>No</th>

<th>Tanggal</th>

<th>Nama</th>

<th>Donat</th>

<th>Qty</th>

<th>Pembayaran</th>

<th>Total</th>

</tr>

<?php

$no=1;

mysqli_data_seek($query,0);

while($d=mysqli_fetch_assoc($query)){

$totalPendapatan += $d['total'];

$totalPesanan++;

?>

<tr>

<td><?= $no++; ?></td>

<td><?= date("d-m-Y H:i",strtotime($d['tanggal'])); ?></td>

<td><?= $d['nama']; ?></td>

<td><?= $d['nama_donat']; ?></td>

<td><?= $d['qty']; ?></td>

<td><?= $d['pembayaran']; ?></td>

<td>

Rp<?= number_format($d['total'],0,",","."); ?>

</td>

</tr>

<?php } ?>

</table>

<?php }else{ ?>

<div class="cute-card">

<h2>📄</h2>

<p>

Belum ada data penjualan.

</p>

</div>

<?php } ?>

</div>

<br>

<div class="card-group">

<div class="cute-card">

<h2>🛒</h2>

<h3><?= $totalPesanan; ?></h3>

<p>Total Pesanan</p>

</div>

<div class="cute-card">

<h2>💰</h2>

<h3>

Rp<?= number_format($totalPendapatan,0,",","."); ?>

</h3>

<p>Total Pendapatan</p>

</div>

</div>
</div>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<script>

document.getElementById("downloadPDF").addEventListener("click", function(e){

    e.preventDefault();

    const element = document.getElementById("laporanPDF");
    const tombol = document.getElementById("downloadPDF");

    tombol.style.display = "none";

    html2pdf()
        .set({

            margin:10,

            filename:"Laporan_Penjualan.pdf",

            image:{
                type:"jpeg",
                quality:1
            },

            html2canvas:{
                scale:2
            },

            jsPDF:{
                unit:"mm",
                format:"a4",
                orientation:"portrait"
            }

        })
        .from(element)
        .save()
        .then(function(){

            tombol.style.display="inline-block";

        });

});

</script>
</div>
<?php include "../components/footer.php"; ?>
</body>

</html>