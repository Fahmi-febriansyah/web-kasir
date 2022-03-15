<?php 
include 'koneksi.php';
session_start();
if (!$_SESSION['nama']) {
	header("location: awal.php");
}else{
	$id = $_SESSION['id'];
	$pembeli = mysqli_query($koneksi,"SELECT * FROM keranjang WHERE id_pembeli = '$id'");
	$query = mysqli_query($koneksi,"SELECT * FROM tbl_barang");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
	<style>
	body{
		background-image: url("assets/img/bg.jpg");
		background-size: cover;
		background-repeat: no-repeat;
	}
	#su img{
		width: 284px;
		height: 180px;
	}
	@media(max-width: 600px) {
		#kata {
			display: none;
		}
		#iklan{
			display: none;
		}
		#produk{
			text-align: center;
		}
		#produk a{
			width: 350px;
		}
	}
</style>
</head>
<body>
	<nav class="navbar navbar-dark " style=" background-color: #3F94AF; ">
		<a class="navbar-brand" href="#">
			<img src="assets/img/store.png" width="40" height="40" class="d-inline-block align-top" alt="">
			<label id="kata">Arap restaurant</label>
		</a>

		<form class="form-inline">
			<input class="form-control" style=" width:350px; " type="search" placeholder="Promo 80% makanan dan minuman" aria-label="Search">
		</form>
		
		<a href="keranjang.php"><img src="assets/img/carts.png" width="40" height="40" class="d-inline-block align-top" alt=""> <span class="badge badge-light"><?= mysqli_num_rows($pembeli); ?> </span></a>
		<a class="nav-link btn btn-danger font-weight-bold" style="  margin-left:-250px; " href="logout.php">Logout</a>

	</nav>
	<div class="container-fluid my-2">
		<div class="row">
			<div class="col-sm-8">
				<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
					<div class="carousel-inner">
						<div class="carousel-item active">
							<img src="assets/img/makanan.jpg" class="d-block w-100" alt="...">
						</div>
						<div class="carousel-item">
							<img src="assets/img/minuman.jpg" class="d-block w-100" alt="...">
						</div>
						<div class="carousel-item">
							<img src="assets/img/kopi.jpg" class="d-block w-100" alt="...">
						</div>
					</div>
					<button class="carousel-control-prev" type="button" data-target="#carouselExampleControls" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</button>
					<button class="carousel-control-next" type="button" data-target="#carouselExampleControls" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</button>
				</div>
			</div>
			<div class="col-sm-4" id="iklan">
				<a href=""><img src="assets/img/burger.jpg" class="d-block w-100" alt=""></a>
				<br>
				<a href=""><img src="assets/img/sayur.jpg" class="d-block w-100" alt=""></a>
			</div>
		</div>
		<br>
		<h3>Kategori</h3>

	</div>
	<br>
	<div class="container-fluid">
		<div class="row" id="produk">
			<?php while( $menu = mysqli_fetch_assoc($query) ) : ?>
				<div class="col-sm-3 pt-2 ">
					<div class="card" id="su" >
						<img src="assets/img/<?= $menu['gambar']; ?>"  >
						<div class="card-body">
							<h4 class="card-title"><?= $menu['nama_barang'] ?></h4>
							<h6><?= $menu['harga_barang'] ?></h6>
							<a href="berapa.php?id=<?php echo $menu['id_barang'] ?>" class="btn btn-primary">BELI</a>
						</div>
					</div>

				</div>

			<?php endwhile; ?>

		</div>
	</div>
	

	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>
</html>