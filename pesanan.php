<?php 
include 'koneksi.php';
$kuari = mysqli_query($koneksi, "SELECT transaksi.id_transaksi, transaksi.id_user, transaksi.id_barang, transaksi.jumlah, transaksi.tanggal, transaksi.status, user.nama_pembeli, user.no_meja  FROM transaksi INNER JOIN user ON transaksi.id_user = user.id_user");

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
					<a class="nav-link" href="admin.php">Beranda <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item active">
					<a class="nav-link" href="#">Pesanan <span class="sr-only">(current)</span></a>
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
				<a class="dropdown-item" href="#">Something else here</a>
			</div>
		</div>
	</nav>
	<br>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 py-3" style=" background-image: url('assets/img/ngakak.jpg'); background-size: cover; border-radius: 10px; "><h2>Ayo Semangat Dalam Bekerja</h2><br><h5>Selesaikan Pesanan Dengan Mudah <br> Dan Buat pelanggan Senang</h5></p>
				<button type="button" class="btn btn-primary" style=" border-radius: 60px; ">
					<img src="assets/img/order.png" style=" width:2rem ; " alt=""> <span class="badge badge-light">4</span>
				</button>
			</div>
		</div>
	</div>
	<br><br>
	<div class="container-fluid" style="" >
		<h4>List Pesanan</h4>
		<table class="table">
			<thead>
				<tr>
					<th scope="col">No</th>
					<th scope="col">Nama Pelanggan</th>
					<th scope="col">No meja</th>
					<th scope="col">Harga</th>
					<th scope="col">Tanggal Pemesanan</th>
					<th scope="col">aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$tambah = 1;
				while ($data = mysqli_fetch_assoc($kuari)){ ?>
					<tr id="tos">
						<th scope="row"><?php echo $tambah ?></th>
						<td><?php echo $data['nama_pembeli'] ?></td>
						<td><?php echo $data['no_meja'] ?></td>
						<td><?php echo $data['jumlah'] ?></td>
						<td><?php echo $data['tanggal'] ?></td>
						<td><a class="nav-link btn btn-danger font-weight-bold w-150" href="struk.php?id=<?php echo $data['id_transaksi'] ?>">Logout</a>
						</td>
					</tr>
				<?php } ?>
			</tbody>

		</table>	
	</div>

	<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>
</html>