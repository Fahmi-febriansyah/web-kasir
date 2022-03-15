<?php 

    session_start();

    date_default_timezone_set('Asia/Jakarta');

    include 'koneksi.php';

    if( !isset($_SESSION['login']) ) {

        header("Location: login.php");
        exit;

    }

    $idPengguna = $_SESSION['id'];

    $queryJumlahCart = mysqli_query($conn, "SELECT * FROM cart WHERE id_pengguna = '$idPengguna'");

    $queryPesan = mysqli_query($conn, "SELECT tbl_menu.nama, tbl_menu.harga, cart.jumlah FROM cart INNER JOIN tbl_menu ON cart.id_menu = tbl_menu.id WHERE cart.id_pengguna = '$idPengguna'");
    
    $queryPengguna = mysqli_query($conn, "SELECT * FROM tbl_pengguna WHERE id = '$idPengguna'");
    $rowPengguna = mysqli_fetch_assoc($queryPengguna);

    if( isset($_POST['pesan']) ) {

        $jumlahHarga = $_POST['jumlahHarga'];
        $nama = $rowPengguna['id'];
        $tgl = date('Y-m-d G:i');
        $pesanan = $_POST['pesanan'];

        $queryAddPesanan = mysqli_query($conn, "INSERT INTO tbl_pesanan VALUES('', '$nama', '$pesanan', '$jumlahHarga', '$tgl', '', 'belum selesai')");

        if( $queryAddPesanan ) {

            mysqli_query($conn, "DELETE FROM cart WHERE id_pengguna = '$idPengguna'");
            
            echo "
            
                <script>
                    alert('Pesanan Kamu Berhasil');
                    document.location.href = 'pesanan.php';
                </script>
            
            ";

        } else {
 
            echo "
            
                <script>
                    alert('Pesanan Gagal Di Pesan');
                    document.location.href = 'cart.php';
                </script>
            
            ";

        }

    }

    $queryCart = mysqli_query($conn, "SELECT tbl_menu.nama, tbl_menu.harga, cart.jumlah, cart.id, cart.id_menu FROM cart INNER JOIN tbl_menu ON cart.id_menu = tbl_menu.id WHERE cart.id_pengguna = '$idPengguna'");

    $queryPrice = mysqli_query($conn, "SELECT tbl_menu.nama, tbl_menu.harga, cart.jumlah FROM cart INNER JOIN tbl_menu ON cart.id_menu = tbl_menu.id WHERE cart.id_pengguna = '$idPengguna'");

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

    <?php if( mysqli_num_rows($queryJumlahCart) == 0 ) : ?>

    <div class="container noCart">
        <div class="row">
            <div class="col-md-12">
                <h1>Keranjang Kosong</h1>
                <a href="index.php" class="btn btn-success mt-3">Pesan sekarang</a>
            </div>
        </div>
    </div>

    <?php endif; ?>
    
    <?php if( mysqli_num_rows($queryJumlahCart) >= 1 ) : ?>

    <div class="container cart">
        <div class="row">
            <?php while( $menu = mysqli_fetch_assoc($queryCart) ) : ?>
            <div class="col-md-12 mt-4">
                <div class="card">
                    <div class="detail-box">
                        <div class="kotak">
                            <h3>X<?= $menu['jumlah']; ?></h3>
                        </div>
                        <div class="title">
                            <h3><?= $menu['nama']; ?></h3>
                        </div>
                    </div>
                    <div class="aksi">
                        <div class="group-btn">
                            <a href="editCart.php?id=<?= $menu['id']; ?>&nama=<?= $menu['nama']; ?>&idMenu=<?= $menu['id_menu']; ?>" class="btn btn-warning mr-1"><img src="assets/img/edit.png" width="20"></a>
                            <a href="hapusCart.php?id=<?= $menu['id']; ?>" onclick="return confirm('Yakin ingin hapus?')" class="btn"><img src="assets/img/trash.png" width="25"></a>
                        </div>
                        <?php 

                            $price = $menu['harga'] * $menu['jumlah']. '.000';

                        ?>
                        <h4>Price : Rp.<?= $price; ?></h4>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="total">
                    <h4>Total : <?php 
                    
                        while( $m = mysqli_fetch_assoc($queryPrice) ) {
                            
                            $price2 = $m['harga'] * $m['jumlah']. '.000';
                            $jumlah[] = ($price2 + $price2) / 2;

                        }

                        $jumlahHarga = array_sum($jumlah) . '.000';

                        echo $jumlahHarga;
                    
                    ?></h4>

                    <?php 
                    
                        while( $rowPesan = mysqli_fetch_assoc($queryPesan) ) {

                            $pesan[] = $rowPesan['nama'] . "(" . $rowPesan['jumlah'] . ")";

                        } 
                    ?>


                    <?php 

                        $cetakPesanan = implode(' ',$pesan); 
                        
                    ?>
                    <form action="" method="post">
                        <input type="hidden" value="<?= $jumlahHarga ?>" name="jumlahHarga">
                        <input type="hidden" value="<?= $cetakPesanan; ?>" name="pesanan">
                        <button type="submit" name="pesan" class="btn btn-success">Pesan</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php endif; ?>





    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
</body>

</html>