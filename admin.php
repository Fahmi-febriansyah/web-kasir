<?php 
session_start();
if (!$_SESSION['login']) {
	header("location: login-admin.php");
}
include 'koneksi.php';
$query = mysqli_query($koneksi,"SELECT tbl_barang.nama_barang, tbl_barang.harga_barang, kategori.kategori FROM tbl_barang INNER JOIN kategori ON tbl_barang.kategori = kategori.id_kategori");

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
	<title>Document</title>
	<style>
	@media(max-width: 600px) {
		#naon{
			display: none;
		}	
	}
</style>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link" href="#">Beranda <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item active">
					<a class="nav-link" href="pesanan.php">Pesanan <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item active">
					<a class="nav-link" href="#"> <span class="sr-only">(current)</span></a>
				</li>
			</ul>
			<form class="form-inline my-2 my-lg-0">
				<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
			</form>
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
				<img src="assets/img/admin.png" style=" width: 2rem; " alt="">
			</a>
			<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
				<a class="dropdown-item" href="#">Tambah admin</a>
				<a class="dropdown-item" href="logout.php">Logout</a>
				<a class="dropdown-item" href="#">Edit</a>
			</div>
		</div>
	</nav>
	<br>
	<div class="container">
		<div class="row">
			<div class="col-sm-3 px-2 py-3 mr-3" id="naon" style=" background-color: #ededed; border-radius: 10px; " align="center"><b><h3>Hi Fahmi</h3><br>Klik dibawah untuk tambah produk</b> <br><br> <a class="nav-link btn btn-primary font-weight-bold" href="upload.php">Tambah Produk</a></div>
			<div class="col-sm-8 py-3" style=" background-image: url('assets/img/ngakak.jpg'); border-radius: 10px; "><h2>Ayo Semangat Dalam Bekerja</h2><br><h5>Selesaikan Pesanan Dengan Mudah <br> Dan Buat pelanggan Senang</h5></p>
				<button type="button" class="btn btn-primary" style=" border-radius: 60px; ">
					<img src="assets/img/order.png" style=" width:2rem ; " alt=""> <span class="badge badge-light">4</span>
				</button>
			</div>
		</div>
	</div>
	<br><br>
	<div class="container-fluid" style="" >
		<h4>List Produk</h4>
		<table class="table">
			<thead>
				<tr>
					<th scope="col">No</th>
					<th scope="col">Nama Produk</th>
					<th scope="col">Harga</th>
					<th scope="col">Kategori</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$tambah = 1;
				while ($data = mysqli_fetch_assoc($query)){ ?>
					<tr>
						<th scope="row"><?php echo $tambah ?></th>
						<td><?php echo $data['nama_barang'] ?></td>
						<td><?php echo $data['harga_barang'] ?></td>
						<td><?php echo $data['kategori'] ?></td>
					</tr>
					<?php $tambah++; ?>
				<?php } ?>
			</tbody>
		</table>	
	</div>

	<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>
</html>