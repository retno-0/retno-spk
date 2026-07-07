<?php

require_once __DIR__ . "/../config/koneksi.php";

$id = $_GET['id'];

$cek = mysqli_query($conn,"
SELECT *
FROM keranjang
WHERE id_donat='$id'
");

if(mysqli_num_rows($cek)>0){

    mysqli_query($conn,"
    UPDATE keranjang
    SET qty = qty + 1
    WHERE id_donat='$id'
    ");

}else{

    mysqli_query($conn,"
    INSERT INTO keranjang(id_donat,qty)
    VALUES('$id',1)
    ");

}

header("Location: keranjang.php");
exit;

?>