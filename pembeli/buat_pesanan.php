<?php
session_start();

require_once __DIR__ . "/../config/koneksi.php";

/*
=====================================
AMBIL DATA FORM
=====================================
*/

$nama        = mysqli_real_escape_string($conn,$_POST['nama']);
$telepon     = mysqli_real_escape_string($conn,$_POST['telepon']);
$alamat      = mysqli_real_escape_string($conn,$_POST['alamat']);
$pembayaran  = mysqli_real_escape_string($conn,$_POST['pembayaran']);

/*
=====================================
AMBIL ISI KERANJANG
=====================================
*/

$query = mysqli_query($conn,"
SELECT
keranjang.qty,
donat.nama_donat,
donat.harga

FROM keranjang

JOIN donat
ON keranjang.id_donat = donat.id_donat
");

if(mysqli_num_rows($query)==0){

    echo "<script>

    alert('Keranjang masih kosong!');

    window.location='keranjang.php';

    </script>";

    exit;

}

/*
=====================================
SIMPAN KE TABEL PESANAN
=====================================
*/

while($d=mysqli_fetch_assoc($query)){

    $total = $d['qty'] * $d['harga'];

    mysqli_query($conn,"
    INSERT INTO pesanan
    (

    nama,
    telepon,
    alamat,
    pembayaran,

    nama_donat,
    qty,
    harga,
    total

    )

    VALUES
    (

    '$nama',
    '$telepon',
    '$alamat',
    '$pembayaran',

    '".$d['nama_donat']."',
    '".$d['qty']."',
    '".$d['harga']."',
    '$total'

    )
    ");

}

/*
=====================================
KOSONGKAN KERANJANG
=====================================
*/

mysqli_query($conn,"
DELETE FROM keranjang
");

/*
=====================================
PESANAN BERHASIL
=====================================
*/

echo "

<script>

alert('Pesanan berhasil dibuat! 🎉');

window.location='riwayat_pesanan.php';

</script>

";

?>