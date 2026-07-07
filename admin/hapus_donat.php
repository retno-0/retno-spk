<?php
session_start();

if(!isset($_SESSION['role']) || $_SESSION['role']!="admin"){
    header("Location: ../login.php");
    exit;
}

require_once __DIR__."/../config/koneksi.php";

if(!isset($_GET['id'])){
    header("Location: data_donat.php");
    exit;
}

$id = (int)$_GET['id'];

// Ambil data donat
$query = mysqli_query($conn,"
SELECT *
FROM donat
WHERE id_donat='$id'
");

$data = mysqli_fetch_assoc($query);

if($data){

    $gambar = "../assets/img/".$data['gambar'];

    // Hapus file gambar jika ada
    if(file_exists($gambar)){
        unlink($gambar);
    }

    // Hapus data dari database
    mysqli_query($conn,"
    DELETE FROM donat
    WHERE id_donat='$id'
    ");

}

header("Location: data_donat.php");
exit;

?>