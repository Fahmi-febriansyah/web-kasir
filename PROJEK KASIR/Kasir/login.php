<?php 

    session_start();

    include 'koneksi.php';

    if( isset($_SESSION['loginAdmin']) ) {

        header("Location: admin/login.php");
        exit;

    }

    date_default_timezone_set("Asia/Jakarta");

    $hari = date("D");
    
    switch($hari){
		case 'Sun':
			$hari_ini = "Minggu";
		break;
 
		case 'Mon':			
			$hari_ini = "Senin";
		break;
 
		case 'Tue':
			$hari_ini = "Selasa";
		break;
 
		case 'Wed':
			$hari_ini = "Rabu";
		break;
 
		case 'Thu':
			$hari_ini = "Kamis";
		break;
 
		case 'Fri':
			$hari_ini = "Jumat";
		break;
 
		case 'Sat':
			$hari_ini = "Sabtu";
		break;
		
		default:
			$hari_ini = "Tidak di ketahui";		
		break;
	}
    
    if( isset($_SESSION['login']) ) {

        header("Location: index.php");
        exit;

    }

    if( isset($_POST['masuk']) ) {

        $nama = $_POST['nama'];
        $meja = $_POST['meja'];
        $token = $_POST['token'];
        
        $queryToken = "SELECT * FROM token WHERE hari = '$hari_ini'";
        $sqlToken = mysqli_query($conn, $queryToken);
        $rowToken = mysqli_fetch_assoc($sqlToken);
        
        if( $token == $rowToken['token'] ) {

            $idPengguna = rand(10000, 99999);

            $query = "INSERT INTO tbl_pengguna VALUES('$idPengguna', '$nama', '$meja')";
            mysqli_query($conn, $query);
            
            $_SESSION['id'] = $idPengguna;
            $_SESSION['login'] = true;

            header("Location: index.php");

        } else {

            echo "
            
                <script>
                    alert('Token Salah');
                    document.location.href = 'login.php';
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
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="assets/css/detail.css">

    <title>Foodie</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light pt-4">
        <div class="container">
            <a class="navbar-brand" href="#">CHOCBAN<span>.</span></a>
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
                    <form action="" method="POST">
                        <div class="forms">
                            <div class="form-group mt-5">
                                <label for="exampleFormControlInput1">Nama</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Masukkan nama anda" name="nama" required>
                            </div>
                        </div>
                        <div class="forms">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">No meja</label>
                                <input type="number" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Masukkan no meja" name="meja" required>
                            </div>
                        </div>
                        <div class="forms">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Token</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Masukkan Token" name="token" required>
                            </div>
                        </div>
                        <div class="btn-add">
                            <button type="submit" name="masuk" class="btn">Masuk</button>
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