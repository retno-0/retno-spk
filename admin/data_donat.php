<?php
session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] != "admin"){
    header("Location: ../login.php");
    exit;
}

require_once __DIR__ . "/../config/koneksi.php";

$query = mysqli_query($conn, "SELECT * FROM donat ORDER BY id_donat ASC");
?>

<!DOCTYPE html>
<html>

<head>

    <title>Data Donat</title>

    <link rel="stylesheet" href="../assets/css/style.css">

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">

</head>

<body>

<?php include "../components/navbar.php"; ?>

<div class="main-wrapper">

    <?php include "../components/sidebar_admin.php"; ?>

    <div class="content">

        <h1>🍩 Data Donat</h1>

        <div class="action-bar">

            <a href="tambah_donat.php" class="btn-primary">
                + Tambah Donat
            </a>

        </div>

        <div class="product-grid">

            <?php
            if(mysqli_num_rows($query) > 0){

                while($d = mysqli_fetch_assoc($query)){
            ?>

            <div class="donut-card">

                <img
                src="../assets/img/<?php echo $d['gambar']; ?>"
                alt="<?php echo $d['nama_donat']; ?>">

                <div class="donut-info">

                    <h3>
                        🍩 <?php echo $d['nama_donat']; ?>
                    </h3>

                    <p>

                        <strong>Harga :</strong>

                        Rp <?php echo number_format($d['harga'],0,",","."); ?>

                    </p>

                    <p>

                        ⭐ Rasa :
                        <?php echo $d['rasa']; ?>/10

                    </p>

                    <p>

                        🎨 Tampilan :
                        <?php echo $d['tampilan']; ?>/10

                    </p>

                    <div class="card-action">

                        <a
                        href="edit_donat.php?id=<?php echo $d['id_donat']; ?>"
                        class="btn-edit">

                            ✏ Edit

                        </a>

                        <a
                        href="hapus_donat.php?id=<?php echo $d['id_donat']; ?>"
                        class="btn-delete"

                        onclick="return confirm('Yakin ingin menghapus donat ini?')">

                            🗑 Hapus

                        </a>

                    </div>

                </div>

            </div>

            <?php

                }

            }else{

            ?>

            <div class="cute-card">

                <h2>🍩</h2>

                <p>

                    Belum ada data donat.

                </p>

            </div>

            <?php } ?>

        </div>

    </div>

</div>

<?php include "../components/footer.php"; ?>

</body>
</html>