<?php 

    include 'koneksi.php';

    session_start();

    if( !isset($_SESSION['login']) ) {

        header("Location: login.php");
        exit;

    }
    
    $query = mysqli_query($conn, "SELECT * FROM tbl_menu");

    if( isset($_GET['kategori']) ) {

        $kategori = $_GET['kategori'];
        $query = mysqli_query($conn, "SELECT * FROM tbl_menu INNER JOIN kategori ON tbl_menu.id_kategori = kategori.id WHERE kategori LIKE '%$kategori%'");


    }

    if( isset($_POST['cari']) ) {

        $keyword = $_POST['keyword'];
        $query = mysqli_query($conn, "SELECT tbl_menu.id, tbl_menu.img, tbl_menu.nama, tbl_menu.harga, kategori.kategori FROM tbl_menu INNER JOIN kategori ON tbl_menu.id_kategori = kategori.id WHERE nama LIKE '%$keyword%'");

    }

    $queryKategory = mysqli_query($conn, "SELECT * FROM kategori");

    $idPengguna = $_SESSION['id'];

    $queryCart = mysqli_query($conn, "SELECT * FROM cart WHERE id_pengguna = '$idPengguna'");


?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <!-- My CSS -->
    <link rel="stylesheet" href="assets/css/home.css">

    <title>Foodie</title>
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
                <div class="navbar-nav ml-auto">
                    <a class="nav-link text-danger mr-4" href="cart.php">
                        <button type="button" class="btn btn-primary">
                            Cart
                            <span class="badge badge-light"><?= mysqli_num_rows($queryCart); ?></span>
                        </button>
                    </a>
                    <a class="nav-link text-danger" href="logout.php">Log Out</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container search">
        <div class="row">
            <div class="col-md-12">
                <form action="" method="post">
                    <div class="input-box">
                        <input type="text" name="keyword" placeholder="Search your favorite food">
                        <button type="submit" name="cari">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container kategori">
        <div class="row">
            <div class="col-md-12">
                <div class="dropdown">
                    <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        Category
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <?php while( $menu = mysqli_fetch_assoc($queryKategory) ) : ?>
                        <a class="dropdown-item"
                            href="index.php?kategori=<?= $menu['kategori']; ?>"><?= $menu['kategori']; ?></a>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container food">
        <div class="row">
            <?php while( $menu = mysqli_fetch_assoc($query) ) : ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="assets/img_menu/<?= $menu['img']; ?>">
                    <div class="desk">
                        <h4><?= $menu['nama'] ?></h4>
                        <h2>Rp.<?= $menu['harga']; ?></h2>
                    </div>
                    <a href="detail.php?id=<?= $menu['id']; ?>" class="btn">Add to cart</a>
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