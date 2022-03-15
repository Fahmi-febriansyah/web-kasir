<?php 

    session_start();

    include 'koneksi.php';

    $id = $_SESSION['id'];

    if( !isset($_SESSION['login']) ) {

        header("Location: login.php");
        exit;

    }

    $query = mysqli_query($conn, "SELECT * FROM tbl_pesanan WHERe id_pengguna = '$id'");


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

    <div class="container struk mt-5">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Struk Pemesanan</h1>
                <table class="table mt-5">
                    <thead>
                        <tr>
                            <th scope="col">Pesanan</th>
                            <th scope="col">Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while( $menu = mysqli_fetch_assoc($query) ) : ?>
                        <tr>
                            <td scope="row"><?= $menu['pesanan']; ?></td>
                            <td>Rp.<?= $menu['jumlah_harga']; ?></td>
                        </tr>
                        <tr>
                            <th>Tanggal pemesanan</th>
                            <td colspan="2"><?= $menu['tgl_pemesanan']; ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <div class="desk">
                    <h6 class="mt-5"><b>Note</b>: Lakukan Pembayan Di Kasir</h6>
                </div>
            </div>
        </div>
    </div>


    <script>
        window.print();
    </script>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
</body>

</html>