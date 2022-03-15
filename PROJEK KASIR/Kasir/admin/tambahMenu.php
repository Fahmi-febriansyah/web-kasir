<?php 

    include '../koneksi.php';
    include 'functions.php';

    if( !isset($_SESSION['loginAdmin']) ) {

        header("Location: login.php");
        exit;

    }


    $query = mysqli_query($conn, "SELECT * FROM kategori");

    if( isset($_POST['tambah']) ) {

        if( tambahMenu($_POST) > 0 ) {

            echo "
            
                <script>
                    alert('Tambah Menu Berhasil');
                    document.location.href = 'dashboard.php';
                </script>
            
            ";

        } else {

            echo "
            
                <script>
                    alert('Tambah Menu Gagal!');
                    document.location.href = 'tambahMenu.php';
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
    <link rel="stylesheet" href="../assets/css/home.css">
    <link rel="stylesheet" href="../assets/css/admin/dashboard.css">
    <link rel="stylesheet" href="../assets/css/admin/tambahMenu.css">
    <title>Foodie | Tambah Menu</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light pt-4">
        <div class="container">
            <a class="navbar-brand" href="dashboard.php"><img src="../assets/img/logo.svg"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ml-auto">
                    <a class="nav-link mr-4 active" href="dashboard.php">Menu</a>
                    <a class="nav-link mr-4" href="pesanan.php">Pesanan</a>
                    <a class="nav-link mr-4" href="token.php">Token</a>
                    <a class="nav-link mr-5" href="logoutAdmin.php" style="color: #E84545 !important;">Log Out</a>
                </div>
            </div>
        </div>
    </nav>
    <section>
        <div class="container container1">
            <div class="row">
                <div class="col-md-8 m-auto">
                    <h1>Tambah Menu</h1>
                    <div class="card">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Nama Makanan</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Masukkan nama makanan" required name="nama">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Harga</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Masukkan Harga" required name="harga">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Kategori</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="kategori">
                                    <?php while( $row = mysqli_fetch_assoc($query) ) : ?>
                                    <option value="<?= $row['id'] ?>"><?= $row['kategori'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Gambar</label>
                                <input type="file" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Masukkan gambar" name="gambar" required>
                            </div>
                            <button type="submit" class="btn" name="tambah">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
</body>

</html>