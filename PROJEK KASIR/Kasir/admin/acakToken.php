<?php 

    include '../koneksi.php';

    session_start();

    if( !isset($_SESSION['loginAdmin']) ) {

        header("Location: login.php");
        exit;

    }

    $hari = $_GET['hari'];
    $token = rand(100000, 999999);

    $query = mysqli_query($conn, "UPDATE token SET hari = '$hari', token = '$token' WHERE hari = '$hari'");

    if( $query ) {

        echo "
            
                <script>
                    alert('Acak Token Berhasil');
                    document.location.href = 'token.php';
                </script>
            
            ";

    } else {

        echo "
            
                <script>
                    alert('Acak Token Gagal!');
                    document.location.href = 'token.php';
                </script>
            
            ";

    }
    

?>