<?php

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "donutlicious"
);

if(!$conn){
    die("Koneksi database gagal : ".mysqli_connect_error());
}