<?php

require_once __DIR__ . "/../config/koneksi.php";

$id = $_GET['id'];

$data=mysqli_query($conn,"
SELECT *
FROM keranjang
WHERE id_keranjang='$id'
");

$d=mysqli_fetch_assoc($data);

if($d['qty']>1){

    mysqli_query($conn,"
    UPDATE keranjang
    SET qty=qty-1
    WHERE id_keranjang='$id'
    ");

}else{

    mysqli_query($conn,"
    DELETE FROM keranjang
    WHERE id_keranjang='$id'
    ");

}

header("Location: keranjang.php");
exit;

?>