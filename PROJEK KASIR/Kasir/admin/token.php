<?php 

    include '../koneksi.php';

    session_start();

    if( !isset($_SESSION['loginAdmin']) ) {

        header("Location: login.php");
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

    
    $queryToken = "SELECT * FROM token WHERE hari = '$hari_ini'";
    $sqlToken = mysqli_query($conn, $queryToken);
    $rowToken = mysqli_fetch_assoc($sqlToken);

    $query = mysqli_query($conn, "SELECT * FROM token");


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
    <link rel="stylesheet" href="../assets/css/admin/token.css">
    <title>Foodie | Token</title>
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
                    <a class="nav-link mr-4" href="dashboard.php">Menu</a>
                    <a class="nav-link mr-4" href="pesanan.php">Pesanan</a>
                    <a class="nav-link mr-4 active" href="#">Token</a>
                    <a class="nav-link mr-5" href="logoutAdmin.php" style="color: #E84545 !important;">Log Out</a>
                </div>
            </div>
        </div>
    </nav>
    <section>
        <div class="container container1">
            <div class="row">
                <div class="col-md-12">
                    <h1>Token Hari Ini</h1>
                    <div class="card">
                        <h3 class="text-center">
                            <?= $rowToken['token'] ?>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="container container1">
            <div class="row">
                <div class="col-md-12">
                    <div class="card cardToken">
                        <table class="table mt-4">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Hari</th>
                                    <th scope="col">Token</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php while( $token = mysqli_fetch_assoc($query) ) : ?>
                                <tr>
                                    <th scope="row"><?= $no++; ?></th>
                                    <td><?= $token['hari']; ?></td>
                                    <td><?= $token['token'] ?></td>
                                    <td>
                                        <a href="acakToken.php?hari=<?= $token['hari']; ?>" class="btn btn-edit">Acak</a>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
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