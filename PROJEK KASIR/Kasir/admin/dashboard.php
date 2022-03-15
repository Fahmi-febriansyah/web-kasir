<?php 

    include '../koneksi.php';
    include 'functions.php';

    if( !isset($_SESSION['loginAdmin']) ) {

        header("Location: login.php");
        exit;

    }

    $batas = 5;
    $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
    $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;

    $previous = $halaman - 1;
    $next = $halaman + 1;

    $jumlah_data = count(query("SELECT * FROM tbl_menu"));
    $total_halaman = ceil($jumlah_data / $batas);

    $query = mysqli_query($conn, "SELECT tbl_menu.id, tbl_menu.nama, tbl_menu.harga, kategori.kategori FROM tbl_menu INNER JOIN kategori ON tbl_menu.id_kategori = kategori.id LIMIT $halaman_awal, $batas");

    $nomor = $halaman_awal+1;


    if( isset($_POST['cari']) ) {

        $keyword = $_POST['keyword'];

        $jumlah_data = count(query("SELECT * FROM tbl_menu WHERE nama LIKE '%$keyword%'"));
        $total_halaman = ceil($jumlah_data / $batas);

        $query = mysqli_query($conn, "SELECT tbl_menu.id, tbl_menu.nama, tbl_menu.harga, kategori.kategori FROM tbl_menu INNER JOIN kategori ON tbl_menu.id_kategori = kategori.id WHERE nama LIKE '%$keyword%' LIMIT $halaman_awal, $batas");

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
    <title>Foodie | Dashboard</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light pt-4">
        <div class="container">
            <a class="navbar-brand" href="#" style="color: #FF865E; font-weight: 500;">CHOCBAN.</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ml-auto">
                    <a class="nav-link mr-4 active" href="#">Menu</a>
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
                <div class="col-md-12">
                    <h1>Daftar Menu</h1>
                    <div class="card">
                        <div class="row-btn">
                            <a href="tambahMenu.php" class="btn btn-tambah">Tambah Menu</a>
                            <form action="" method="post">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Cari..."
                                        aria-label="Recipient's username" name="keyword"
                                        aria-describedby="button-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2"
                                            name="cari">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <table class="table mt-4">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Makanan</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Kategory</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while( $menu = mysqli_fetch_assoc($query) ) : ?>
                                <tr>
                                    <th scope="row"><?= $nomor++; ?></th>
                                    <td><?= $menu['nama']; ?></td>
                                    <td>Rp.<?= $menu['harga']; ?></td>
                                    <td><?= $menu['kategori']; ?></td>
                                    <td>
                                        <a href="editMenu.php?id=<?= $menu['id']; ?>" class="btn btn-edit"><img
                                                src="../assets/img/edit.svg" width="20"></a>
                                        <a href="hapusMenu.php?id=<?= $menu['id']; ?>" class="btn btn-danger"><img
                                                src="../assets/img/delete.svg" width="20"
                                                onclick="return confirm('Yakin ingin hapus?')"></a>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                    <nav class="ml-auto mt-4 mb-5">
                        <ul class="pagination justify-content-center">
                            <li class="page-item">
                                <a class="page-link previous"
                                    <?php if($halaman > 1){ echo "href='?halaman=$previous'"; } ?>>Previous</a>
                            </li>
                            <?php 
                                    for($x=1;$x<=$total_halaman;$x++){
                                ?>
                            <li class="page-item <?= ($halaman == $x) ? 'active' : '' ?>"><a class="page-link"
                                    href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
                            <?php
                                    }
                                ?>
                            <li class="page-item">
                                <a class="page-link"
                                    <?php if($halaman < $total_halaman) { echo "href='?halaman=$next'"; } ?>>Next</a>
                            </li>
                        </ul>
                    </nav>
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