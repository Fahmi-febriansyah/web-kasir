<?php 

    session_start();

    include 'koneksi.php';

    $id = $_SESSION['id'];
    

    if( !isset($_SESSION['login']) ) {

        header("Location: login.php");
        exit;

    }

    $query = mysqli_query($conn, "SELECT * FROM tbl_pesanan WHERE id_pengguna = '$id'");

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <!-- My CSS -->
    <link rel="stylesheet" href="assets/css/home.css">
    <link rel="stylesheet" href="assets/css/cart.css">
    <link rel="stylesheet" href="assets/css/pesanan.css">

    <title>Foodie | Cart</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light pt-4">
        <div class="container">
            <a class="navbar-brand" href="index.php"><img src="assets/img/logo.svg"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">

                </div>
            </div>
        </div>
    </nav>

    <div class="container cart">
        <div class="row">
            <?php  while( $menu = mysqli_fetch_assoc($query) ) : ?>
            <div class="col-md-12 mt-4">
                <h1>Pesanan Saya</h1>
                <div class="card">
                    <div class="detail-box">
                        <div class="title">
                            <h3><?= $menu['pesanan']; ?></h3>
                        </div>
                    </div>
                    <div class="aksi">
                        <div class="group-btn">
                            <!-- <a href="" class="btn btn-success mr-1">Cetak</a> -->
                            <a href="strukPemesanan.php" target="_blank" class="btn btn-warning mr-1">Cetak</a>
                        </div>
                        <h4>Total : Rp.<?= $menu['jumlah_harga']; ?></h4>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>





    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
</body>

</html>