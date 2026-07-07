<?php
session_start();

if(!isset($_SESSION['role']) || $_SESSION['role']!="admin"){
    header("Location: ../login.php");
    exit;
}

require_once __DIR__ . "/../config/koneksi.php";

$bobot=[

"harga"=>0.30,
"rasa"=>0.40,
"tampilan"=>0.30

];

$query=mysqli_query($conn,"
SELECT *
FROM donat
ORDER BY id_donat ASC
");

$data=[];

while($row=mysqli_fetch_assoc($query)){
    $data[]=$row;
}

$hitung=isset($_GET['hitung']);

?>

<!DOCTYPE html>

<html>

<head>

<title>Perhitungan TOPSIS</title>

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

<h1>📊 Perhitungan TOPSIS</h1>

<div class="cute-card">

<h2>

Metode TOPSIS

</h2>

<p>

Jumlah Alternatif :
<b><?= count($data); ?></b>

</p>

<p>

Jumlah Kriteria :
<b>3</b>

</p>

<p>

Harga (30%) •
Rasa (40%) •
Tampilan (30%)

</p>

<br>

<a
href="topsis.php?hitung=1"
class="btn-primary">

⚙ Hitung TOPSIS

</a>

</div>
<?php if($hitung)
    { ?>
    <div class="table-card">
        <h2>📋 Matriks Keputusan</h2>
        <table>
            <tr>
                <th>No</th>
                <th>Nama Donat</th>
                <th>Harga</th>
                <th>Rasa</th>
                <th>Tampilan</th>
            </tr>
    <?php
    $no=1;
    foreach($data as $d){
        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $d['nama_donat']; ?></td>
            <td>Rp <?= number_format($d['harga'],0,",","."); ?></td>
            <td><?= $d['rasa']; ?></td>
            <td><?= $d['tampilan']; ?></td>
        </tr>
    <?php } ?>

        </table>

    </div>
    <?php

$totalHarga=0;
$totalRasa=0;
$totalTampilan=0;

foreach($data as $d){

    $totalHarga += pow($d['harga'],2);

    $totalRasa += pow($d['rasa'],2);

    $totalTampilan += pow($d['tampilan'],2);

}

$totalHarga=sqrt($totalHarga);

$totalRasa=sqrt($totalRasa);

$totalTampilan=sqrt($totalTampilan);

?>
<div class="table-card">

<h2>📊 Matriks Normalisasi</h2>

<table>

<tr>

<th>Nama Donat</th>

<th>Harga</th>

<th>Rasa</th>

<th>Tampilan</th>

</tr>

<?php

$normalisasi=[];

foreach($data as $d){

$nharga=$d['harga']/$totalHarga;

$nrasa=$d['rasa']/$totalRasa;

$ntampilan=$d['tampilan']/$totalTampilan;

$normalisasi[]=[

"id"=>$d['id_donat'],

"nama"=>$d['nama_donat'],

"harga"=>$nharga,

"rasa"=>$nrasa,

"tampilan"=>$ntampilan

];

?>

<tr>

<td><?= $d['nama_donat']; ?></td>

<td><?= round($nharga,4); ?></td>

<td><?= round($nrasa,4); ?></td>

<td><?= round($ntampilan,4); ?></td>

</tr>

<?php } ?>

</table>

</div>

<?php

$terbobot=[];

foreach($normalisasi as $n){

    $harga = $n['harga'] * $bobot['harga'];
    $rasa = $n['rasa'] * $bobot['rasa'];
    $tampilan = $n['tampilan'] * $bobot['tampilan'];

    $terbobot[]=[

        "id"=>$n['id'],
        "nama"=>$n['nama'],

        "harga"=>$harga,
        "rasa"=>$rasa,
        "tampilan"=>$tampilan

    ];

}

?>

<div class="table-card">

<h2>📈 Matriks Normalisasi Terbobot</h2>

<table>

<tr>

<th>Nama Donat</th>
<th>Harga</th>
<th>Rasa</th>
<th>Tampilan</th>

</tr>

<?php foreach($terbobot as $t){ ?>

<tr>

<td><?= $t['nama']; ?></td>

<td><?= round($t['harga'],4); ?></td>

<td><?= round($t['rasa'],4); ?></td>

<td><?= round($t['tampilan'],4); ?></td>

</tr>

<?php } ?>

</table>

</div>
<?php

$harga=array_column($terbobot,"harga");
$rasa=array_column($terbobot,"rasa");
$tampilan=array_column($terbobot,"tampilan");

/*
Harga = COST
Rasa = BENEFIT
Tampilan = BENEFIT
*/

$Aplus=[

"harga"=>min($harga),
"rasa"=>max($rasa),
"tampilan"=>max($tampilan)

];

$Amin=[

"harga"=>max($harga),
"rasa"=>min($rasa),
"tampilan"=>min($tampilan)

];

?>

<div class="table-card">

<h2>⭐ Solusi Ideal</h2>

<table>

<tr>

<th></th>
<th>Harga</th>
<th>Rasa</th>
<th>Tampilan</th>

</tr>

<tr>

<td><b>A+</b></td>

<td><?= round($Aplus['harga'],4); ?></td>

<td><?= round($Aplus['rasa'],4); ?></td>

<td><?= round($Aplus['tampilan'],4); ?></td>

</tr>

<tr>

<td><b>A-</b></td>

<td><?= round($Amin['harga'],4); ?></td>

<td><?= round($Amin['rasa'],4); ?></td>

<td><?= round($Amin['tampilan'],4); ?></td>

</tr>

</table>

</div>
<?php

$hasil=[];

foreach($terbobot as $t){

    /* ==========================
       HITUNG D+
    ========================== */

    $dPlus = sqrt(

        pow($t['harga']-$Aplus['harga'],2)+
        pow($t['rasa']-$Aplus['rasa'],2)+
        pow($t['tampilan']-$Aplus['tampilan'],2)

    );

    /* ==========================
       HITUNG D-
    ========================== */

    $dMin = sqrt(

        pow($t['harga']-$Amin['harga'],2)+
        pow($t['rasa']-$Amin['rasa'],2)+
        pow($t['tampilan']-$Amin['tampilan'],2)

    );

    /* ==========================
       NILAI PREFERENSI
    ========================== */

    $score = $dMin / ($dPlus + $dMin);

    $hasil[]=[

        "id"=>$t['id'],
        "nama"=>$t['nama'],

        "dplus"=>$dPlus,
        "dmin"=>$dMin,

        "score"=>$score

    ];

    /* ==========================
       UPDATE SCORE DATABASE
    ========================== */

    mysqli_query($conn,"
        UPDATE donat
        SET score='$score'
        WHERE id_donat='".$t['id']."'
    ");

}

?>
<div class="table-card">

<h2>📌 Nilai Preferensi TOPSIS</h2>

<table>

<tr>

<th>Nama Donat</th>
<th>D+</th>
<th>D−</th>
<th>Score</th>

</tr>

<?php foreach($hasil as $h){ ?>

<tr>

<td><?= $h['nama']; ?></td>

<td><?= round($h['dplus'],4); ?></td>

<td><?= round($h['dmin'],4); ?></td>

<td><b><?= round($h['score'],4); ?></b></td>

</tr>

<?php } ?>

</table>

</div>
<?php

usort($hasil,function($a,$b){

    return $b['score'] <=> $a['score'];

});

?>

<?php } ?>