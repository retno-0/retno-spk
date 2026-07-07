<?php

require_once __DIR__ . "/../config/koneksi.php";

$id = $_GET['id'];

mysqli_query($conn,"
UPDATE keranjang
SET qty = qty + 1
WHERE id_keranjang='$id'
");

header("Location: keranjang.php");
exit;

?>