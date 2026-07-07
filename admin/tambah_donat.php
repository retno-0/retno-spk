<?php
session_start();

if(!isset($_SESSION['role']) || $_SESSION['role']!="admin"){
    header("Location: ../login.php");
    exit;
}

require_once __DIR__."/../config/koneksi.php";

if(isset($_POST['simpan'])){

    $nama       = mysqli_real_escape_string($conn,$_POST['nama_donat']);
    $harga      = $_POST['harga'];
    $rasa       = $_POST['rasa'];
    $tampilan   = $_POST['tampilan'];

    $gambar = $_FILES['gambar']['name'];
    $tmp    = $_FILES['gambar']['tmp_name'];

    if($gambar!=""){

        move_uploaded_file(
            $tmp,
            "../assets/img/".$gambar
        );

    }

    mysqli_query($conn,"
        INSERT INTO donat
        (
            nama_donat,
            harga,
            rasa,
            tampilan,
            gambar
        )
        VALUES
        (
            '$nama',
            '$harga',
            '$rasa',
            '$tampilan',
            '$gambar'
        )
    ");

    header("Location: data_donat.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>

<title>Tambah Donat</title>

<link rel="stylesheet"
href="../assets/css/style.css">

<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">

</head>

<body>

<?php include "../components/navbar.php"; ?>

<div class="main-wrapper">

<?php include "../components/sidebar_admin.php"; ?>

<div class="content">

<h1>🍩 Tambah Donat</h1>

<div class="form-card">

<form
method="POST"
enctype="multipart/form-data">

<label>Nama Donat</label>

<input
type="text"
name="nama_donat"
required>

<label>Harga</label>

<input
type="number"
name="harga"
required>

<label>Rasa (1-10)</label>

<input
type="number"
name="rasa"
min="1"
max="10"
required>

<label>Tampilan (1-10)</label>

<input
type="number"
name="tampilan"
min="1"
max="10"
required>

<label>Gambar Donat</label>

<input
type="file"
name="gambar"
accept="image/*"
required>

<br><br>

<button
type="submit"
name="simpan"
class="btn-primary">

💾 Simpan Donat

</button>

<a
href="data_donat.php"
class="btn-delete">

Batal

</a>

</form>

</div>

</div>

</div>

<?php include "../components/footer.php"; ?>

</body>
</html>