<?php

include '../components/navbar_pembeli.php';
?>

<!DOCTYPE html>
<html>
<head>

<title>Dashboard Pembeli</title>

<link rel="stylesheet"
href="../assets/css/style.css">

<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">

</head>

<body>

<div class="main-wrapper">

<?php include '../components/sidebar_pembeli.php'; ?>

<div class="content">

<div class="welcome-box">

    <div>
        <h1>🍩 Welcome Sweet Customer</h1>
        <p>Temukan rekomendasi donat terbaik berdasarkan metode TOPSIS.</p>
    </div>

</div>

<!-- BEST DONUT -->

<div class="winner-card">

    <img src="../assets/img/Untitled design (27).png" class="winner-img">

    <h2>🏆 Best Recommendation</h2>

    <h1>Strawberry Dream</h1>

    <p class="score">
        TOPSIS Score : <b>0.832</b>
    </p>

</div>

<!-- DONUT CARDS -->

<h2 class="section-title">🍓 Top Donut Choices</h2>

<div class="donut-grid">

    <div class="donut-card">

        <img src="../assets/img/Untitled design (27).png">

        <h3>Strawberry Dream</h3>

        <span>Score 0.832</span>

    </div>

    <div class="donut-card">

        <img src="../assets/img/Untitled design (30).png">

        <h3>Choco Heaven</h3>

        <span>Score 0.781</span>

    </div>

    <div class="donut-card">

        <img src="../assets/img/Untitled design (41).png">

        <h3>Matcha Ring</h3>

        <span>Score 0.703</span>

    </div>

</div>

</div>

</div>

<?php include '../components/footer.php'; ?>

</body>
</html>