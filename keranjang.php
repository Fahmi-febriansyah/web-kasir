<?php 
include 'koneksi.php';
session_start();
date_default_timezone_set('Asia/Jakarta');
$idP = $_SESSION['id'];
$cak = mysqli_query($koneksi,"SELECT * FROM keranjang WHERE id_pembeli = '$idP'");
if (mysqli_num_rows($cak) == 0) {
	echo "

	<script>
	alert('keranjang masih kosong');
	document.location.href = 'index.php';
	</script>

	";
}
if( isset($_POST['submit']) ) {

	$jumlah = $_POST['jumlah'];
	$nama = $idP;
	$tanggal = date('Y-m-d G:i');
	$bon = $_POST['pesanan'];

	$kuaripesanan = mysqli_query($koneksi, "INSERT INTO transaksi VALUES('', '$bon', '$nama', '$tanggal', '$jumlah', 'belum selesai')");

	if( $kuaripesanan ) {

		mysqli_query($koneksi, "DELETE FROM keranjang WHERE id_pembeli = '$idP'");

		echo "

		<script>
		alert('silahkan ke kasir');
		document.location.href = 'logout.php';
		</script>

		";

	} else {

		echo "

		<script>
		alert('Pesanan Gagal Di Pesan');
		document.location.href = 'keranjang.php';
		</script>

		";

	}

}



$query = mysqli_query($koneksi,"SELECT keranjang.id_barang, keranjang.id_pembeli, keranjang.stok, tbl_barang.nama_barang,tbl_barang.harga_barang, tbl_barang.gambar FROM keranjang INNER JOIN tbl_barang ON keranjang.id_barang = tbl_barang.id_barang WHERE keranjang.id_pembeli = '$idP'");

$kuari = mysqli_query($koneksi,"SELECT keranjang.id_barang, keranjang.id_pembeli, keranjang.stok, tbl_barang.nama_barang,tbl_barang.harga_barang, tbl_barang.gambar FROM keranjang INNER JOIN tbl_barang ON keranjang.id_barang = tbl_barang.id_barang WHERE keranjang.id_pembeli = '$idP'");

$pesan = mysqli_query($koneksi,"SELECT keranjang.id_barang, keranjang.id_pembeli, keranjang.stok, tbl_barang.nama_barang,tbl_barang.harga_barang, tbl_barang.gambar FROM keranjang INNER JOIN tbl_barang ON keranjang.id_barang = tbl_barang.id_barang WHERE keranjang.id_pembeli = '$idP'");

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
	<title>Document</title>
	<style>
	#side{
		background-color: #f5f5f5;
		height: 100%;
	}
	@media(max-width: 600px) {

	}
</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-8">
				<br><h2>Keranjang Belanja</h2>
				<hr>
				<div class="container">
					<div class="row">
						<?php 
						$tambah = 1;
						while ($data = mysqli_fetch_assoc($query)){ ?>
							<div class="col-sm-11">
								<div class="media shadow p-3 mb-5 bg-white rounded">
									<img src="assets/img/<?php echo $data['gambar'] ?>" class="mr-4" style="width: 18rem; border-radius: 10px;" alt="...">
									<div class="media-body">
										<h2 class="mt-0"><?php echo $data['nama_barang'] ?></h2>
										<h5>Harga satuan : <?php echo $data['harga_barang'] ?></h5>
									</div>
								</div>
							</div>
							<?php $tambah++; ?>
						<?php } ?>
					</div>
				</div>

			</div>
			<div class="col-sm-4" id="side"><br><h2>Total harga</h2><hr>
				<br>
				<div class="container">
					<div class="row">
						<?php 
						$tambah = 1;
						while ($datu = mysqli_fetch_assoc($kuari)){ ?>
							<div class="col-sm-8"><h4><?php echo $datu['nama_barang'] ?><small> : <?php echo $datu['stok'] ?></small></h4></div>
							<div class="col-sm-4"><?php echo $datu['harga_barang'] ?></div>
							<?php $tambah++; 
							$harga = $datu['harga_barang'] * $datu['stok']. '.000';
							$jumlah[] = ($harga + $harga) / 2;

							?>
						<?php } ?>
						<?php $jumlahHarga = array_sum($jumlah) . '.000'; ?>
						<h5 class=" pl-3 ">Total Harga : <?php echo $jumlahHarga ?></h5>

					</div>
					<?php 

					while( $pesanan = mysqli_fetch_assoc($pesan) ) {

						$pesun[] = $pesanan['nama_barang'] . "(" . $pesanan['stok'] . ")";

					} 
					?>


					<?php 

					$bon = implode(' ',$pesun); 

					?>
					<br>
					<form method="POST">
						<input type="hidden" value="<?= $jumlahHarga ?>" name="jumlah">
						<input type="hidden" value="<?= $bon; ?>" name="pesanan">
						<button type="submit" name="submit" style=" width:300px; " class="btn btn-dark mb-2">Pesan</button>
					</form>
					<a class="nav-link btn btn-danger font-weight mb-3" style=" width: 301px; height: 40px; "  href="index.php">Kembali</a>
				</div>
			</div>
		</div>
	</div>



	<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>
</html>