<?php 

    include '../koneksi.php';

    session_start();

    if( !isset($_SESSION['loginAdmin']) ) {

        header("Location: login.php");
        exit;

    }

    $id = $_GET['id'];

    $queryData = mysqli_query($conn, "SELECT img FROM tbl_menu WHERE id = '$id'");
    $img = mysqli_fetch_assoc($queryData);
    $queryHapus = mysqli_query($conn, "DELETE FROM tbl_menu WHERE id = '$id'");

    if( $queryHapus ) {

        unlink('../assets/img_menu/' . $img['img']);

        echo "
            
                <script>
                    alert('Hapus Menu Berhasil');
                    document.location.href = 'dashboard.php';
                </script>
            
            ";

    } else {

        echo "
            
                <script>
                    alert('Hapus Menu Gagal!');
                    document.location.href = 'dashboard.php';
                </script>
            
            ";

    }

?>