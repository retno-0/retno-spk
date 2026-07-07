<?php
session_start();

if(!isset($_SESSION['role']) || $_SESSION['role']!="admin"){
    header("Location: ../login.php");
    exit;
}

require_once __DIR__ . "/../config/koneksi.php";

$query = mysqli_query($conn,"
SELECT *
FROM donat
ORDER BY score DESC
");

$ranking=[];

while($row=mysqli_fetch_assoc($query)){
    $ranking[]=$row;
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Ranking Donat</title>

<link rel="stylesheet"
href="../assets/css/style.css">

<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">

</head>

<body>

<?php include "../components/navbar.php"; ?>

<div class="main-wrapper">

<?php include "../components/sidebar_admin.php"; ?>

<div class="content">

<h1>🏆 Ranking Donat Terbaik</h1>

<div class="action-bar">

<a
href="topsis.php"
class="btn-primary">

⚙ Hitung TOPSIS

</a>

</div>

<div class="ranking-container">

<!-- JUARA 2 -->

<div class="podium second">

<h1>🥈</h1>

<img
src="../assets/img/<?= $ranking[1]['gambar'];?>"
style="width:90px;border-radius:18px;">

<h3>

<?= $ranking[1]['nama_donat'];?>

</h3>

<p>

⭐ <?= $ranking[1]['rasa'];?> /10

</p>

</div>

<!-- JUARA 1 -->

<div class="podium first">

<h1>🥇</h1>

<img
src="../assets/img/<?= $ranking[0]['gambar'];?>"
style="width:120px;border-radius:20px;">

<h3>

<?= $ranking[0]['nama_donat'];?>

</h3>

<p>

⭐ <?= $ranking[0]['rasa'];?> /10

</p>

<span class="best-badge">

🏆 Best Recommendation

</span>

</div>

<!-- JUARA 3 -->

<div class="podium third">

<h1>🥉</h1>

<img
src="../assets/img/<?= $ranking[2]['gambar'];?>"
style="width:90px;border-radius:18px;">

<h3>

<?= $ranking[2]['nama_donat'];?>

</h3>

<p>

⭐ <?= $ranking[2]['rasa'];?> /10

</p>

</div>

</div>

<div class="table-card">

<table>

<tr>

<th width="80">Rank</th>

<th>Donat</th>

<th>Harga</th>

<th>Rasa</th>

<th>Tampilan</th>

<th>Status</th>

</tr>
<?php

$no=1;

foreach($ranking as $d){

?>

<tr>

<td>

<?= $no; ?>

</td>

<td>

🍩 <?= $d['nama_donat']; ?>

</td>

<td>

Rp<?= number_format($d['harga'],0,",","."); ?>

</td>

<td>

<?= $d['rasa']; ?>/10

</td>

<td>

<?= $d['tampilan']; ?>/10

</td>

<td>

<?php

if($no==1){

echo "<span class='status juara1'>🏆 Best Recommendation</span>";

}

elseif($no==2){

echo "<span class='status juara2'>🥈 Very Good</span>";

}

elseif($no==3){

echo "<span class='status juara3'>🥉 Good</span>";

}

else{

echo "<span class='status alternatif'>✔ Alternative</span>";

}

?>

</td>

</tr>

<?php

$no++;

}

?>
</table>

</div>

</div>

</div>

<?php include "../components/footer.php"; ?>

</body>

</html>