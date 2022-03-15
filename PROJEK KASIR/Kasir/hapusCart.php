<?php 

    session_start();

    include 'koneksi.php';

    if( !isset($_SESSION['login']) ) {

        header("Location: login.php");
        exit;

    }

    $id = $_GET['id'];

    $query = mysqli_query($conn, "DELETE FROM cart WHERE id = '$id'");

    if( $query ) {
    
        echo "
            
                <script>
                    alert('Hapus keranjang Berhasil');
                    document.location.href = 'cart.php';
                </script>
            
            ";

    } else {

        echo "
            
                <script>
                    alert('Hapus Keranjang Gagal!');
                    document.location.href = 'cart.php';
                </script>
            
            ";

    }

?>