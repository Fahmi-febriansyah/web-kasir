<?php 
include 'koneksi.php';
session_start();
if (!$_SESSION['nama']) {
	header("location: awal.php");
}
$idP = $_SESSION['id'];
$id = $_GET['id'];
$query = mysqli_query($koneksi,"SELECT * FROM tbl_barang WHERE id_barang = '$id'")->fetch_assoc();

if (isset($_POST['submit'])) {
	$nomor = $_POST['nomor'];
	$kuari = mysqli_query($koneksi,"INSERT INTO keranjang VALUES('','$id','$idP','$nomor')");
	if ($kuari) {
		echo "
		<script>
		alert('Berhasil');
		document.location.href = 'index.php';
		</script>
		";
	}else{
		echo "
		<script>
		alert('gagal');
		document.location.href = 'index.php';
		</script>
		";
	}
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
	#es{
		height: 350px;  
		margin: 100px auto 0;
		border-radius: 50px;
	}
	#es input{
		width: 50px;
	}
	#cape img{
		width: 19rem;
		border-radius: 10px;

	}
</style>
</head>
<body>
	<div class="container">
		
		<div class="row">
			<div class="col-sm-7 shadow p-5 mb-5 bg-white" id="es">
				<div class="row">
					<div class="col-sm-6"><h1><?php echo $query['nama_barang'] ?></h1>
						<h5>Jumlah</h5>
						<br><form method="post">
							<input type="number" name="nomor"><br>
							<small>*silahkan masukan jumlah yang ingin di beli</small>
							<br><br>
							<button class="btn btn-info" name="submit">Beli</button></div>
							<div class="col-sm-2" id="cape"><img src="assets/img/<?php echo $query['gambar'] ?>"></div></form>
						</div>

					</div>

				</div>
			</div>


			<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
			<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
		</body>
		</html>