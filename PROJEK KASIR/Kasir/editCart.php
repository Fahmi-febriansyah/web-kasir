<?php 

    session_start();
    include 'koneksi.php';

    if( !isset($_SESSION['login']) ) {

        header("Location: login.php");
        exit;

    }

    $namaMenu = $_GET['nama'];
    $idCart = $_GET['id'];
    $idPengguna = $_SESSION['id'];
    $query = mysqli_query($conn, "SELECT * FROM cart WHERE id = '$idCart'");
    $menu = mysqli_fetch_assoc($query);
    $idMenu = $menu['id_menu'];


    if( isset($_POST['edit']) ) {

        $jumlah = $_POST['jumlah'];

        $queryEdit = mysqli_query($conn, "UPDATE cart SET id_pengguna = '$idPengguna', id_menu = '$idMenu', jumlah = '$jumlah' WHERE id = '$idCart'");

        if( $queryEdit ) {
    
            echo "
                
                    <script>
                        alert('Edit keranjang Berhasil');
                        document.location.href = 'cart.php';
                    </script>
                
                ";
    
        } else {
    
            echo "
                
                    <script>
                        alert('Edit Keranjang Gagal!');
                        document.location.href = 'cart.php';
                    </script>
                
                ";
    
        }

    }

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
    <link rel="stylesheet" href="assets/css/detail.css">

    <title>Foodie | Detail</title>
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

    <div class="container form">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="title">
                        <h2><?= $namaMenu; ?></h2>
                    </div>
                    <form action="" method="post">
                        <div class="forms">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Jumlah</label>
                                <input type="number" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Jumlah yang ingin dibeli" name="jumlah" required value="<?= $menu['jumlah'] ?>">
                            </div>
                        </div>
                        <div class="btn-add">
                            <button type="submit" name="edit" class="btn">Edit cart</button>
                        </div>
                    </form>
                </div>
            </div>
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