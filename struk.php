<?php 	
include 'koneksi.php';
session_start();
$idP = $_SESSION['id'];
$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE id_transaksi = '$id'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=	, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
	<div class="container struk mt-5">
		<div class="row">
			<div class="col-md-12">
				<h1 class="text-center">Struk Pemesanan</h1>
				<table class="table mt-5">
					<tr>
						<th>no</th>
						<th>pesanan</th>
						<th>jumlah</th>
					</tr>
					<?php 
					$tambah = 1;
					while ($data = mysqli_fetch_assoc($query)){ ?>
						<tr>
							<td>1</td>
							<td><?php echo $data['id_barang'] ?></td>
							<td><?php echo $data['jumlah'] ?></td>
						</tr>
					<?php } ?>
				</table>
				<a class="nav-link btn btn-danger font-weight-bold" onclick="window.print()" href="pesanan.php">Logout</a>

			</div>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>
</html>