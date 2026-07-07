<?php
session_start();

if(!isset($_SESSION['role']) || $_SESSION['role']!="admin"){
    header("Location: ../login.php");
    exit;
}

require_once __DIR__."/../config/koneksi.php";

$id = $_GET['id'];

$data = mysqli_query($conn,"SELECT * FROM donat WHERE id_donat='$id'");
$d = mysqli_fetch_assoc($data);

if(isset($_POST['update'])){

    $nama       = mysqli_real_escape_string($conn,$_POST['nama_donat']);
    $harga      = $_POST['harga'];
    $rasa       = $_POST['rasa'];
    $tampilan   = $_POST['tampilan'];

    $gambarLama = $d['gambar'];

    if($_FILES['gambar']['name']!=""){

        $gambar = $_FILES['gambar']['name'];
        $tmp    = $_FILES['gambar']['tmp_name'];

        move_uploaded_file(
            $tmp,
            "../assets/img/".$gambar
        );

        $gambarLama = $gambar;
    }

    mysqli_query($conn,"
    UPDATE donat SET

        nama_donat='$nama',
        harga='$harga',
        rasa='$rasa',
        tampilan='$tampilan',
        gambar='$gambarLama'

    WHERE id_donat='$id'
    ");

    header("Location:data_donat.php");
    exit;
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Edit Donat</title>

<link rel="stylesheet"
href="../assets/css/style.css">

<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">

</head>

<body>

<?php include "../components/navbar.php"; ?>

<div class="main-wrapper">

<?php include "../components/sidebar_admin.php"; ?>

<div class="content">

<h1>✏ Edit Donat</h1>

<div class="form-card">

<form
method="POST"
enctype="multipart/form-data">

<label>Nama Donat</label>

<input
type="text"
name="nama_donat"
value="<?= $d['nama_donat']; ?>"
required>

<label>Harga</label>

<input
type="number"
name="harga"
value="<?= $d['harga']; ?>"
required>

<label>Rasa</label>

<input
type="number"
name="rasa"
min="1"
max="10"
value="<?= $d['rasa']; ?>"
required>

<label>Tampilan</label>

<input
type="number"
name="tampilan"
min="1"
max="10"
value="<?= $d['tampilan']; ?>"
required>

<label>Gambar Saat Ini</label>

<br>

<img

src="../assets/img/<?= $d['gambar']; ?>"

style="width:180px;
border-radius:20px;
margin:15px 0;">

<br>

<label>Ganti Gambar (Opsional)</label>

<input
type="file"
name="gambar"
accept="image/*">

<br><br>

<button
type="submit"
name="update"
class="btn-primary">

💾 Update Donat

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