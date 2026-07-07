<?php
include "../components/navbar_pembeli.php";
?>

<!DOCTYPE html>
<html>

<head>

<title>Sweet Recommendation</title>

<link rel="stylesheet"
href="../assets/css/style.css">

<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">

</head>

<body>

<div class="main-wrapper">

<?php include "../components/sidebar_pembeli.php"; ?>

<div class="content">

<div class="recommend-header">

<h1>🎡 Sweet Recommendation</h1>

<p>

Spin the wheel and let Donutlicious choose your perfect donut!

</p>

</div>

<div class="spin-card">

<img
src="../assets/img/Untitled design (45).png"
id="wheel"
class="wheel-img">

<br><br>

<button
class="btn-spin"
id="spinBtn">

🍩 SPIN NOW

</button>

<p class="spin-note">

Powered by TOPSIS Decision Support System

</p>

</div>

</div>

</div>

<?php include "../components/footer.php"; ?>

<script>

document
.getElementById("spinBtn")
.onclick=function(){

const btn=this;

const wheel=document.getElementById("wheel");

btn.disabled=true;

wheel.style.transform=
"rotate("+(2160+Math.random()*360)+"deg)";

setTimeout(function(){

window.location.href="rekomendasi.php";

},2500);

}

</script>

</body>

</html>