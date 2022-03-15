<?php 
session_start();
include 'koneksi.php';
$query = mysqli_query($koneksi,"SELECT * FROM user ORDER BY no_meja DESC")->fetch_assoc();
$no = $query['no_meja'] + 1;

if (isset($_POST['submit'])) {
	$nama = $_POST['nama'];
	$idPengguna = rand(10000, 99999);
	$quari = mysqli_query($koneksi, "INSERT INTO user VALUES('$idPengguna','$nama','$no')");
	if ($quari) {
		
		$_SESSION['nama'] = "$nama";
		$_SESSION['id'] = $idPengguna;
		echo "<script>
		alert('Berhasil Mendapatkan meja');
		document.location.href = 'index.php'
		</script>";
	}else{
		echo "gagal";
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
	<title>Document</title>
	<style>
	@import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');
	body{
		font-family: 'Poppins', sans-serif;
	}
	#kiri{
		background-image: url('assets/img/side.jpg');
	}
	#kiri img{
		width: 35rem; 
		padding-top:20vh;
		padding-bottom: auto;
	}
	@media(max-width: 700px) {
		#kiri{
			display: none;
		}
		.kanan{
			background-color: red;
		}
		#btn{
			width: 400px;
		}
		body{
			background-image: url('assets/img/side.jpg');
		}

	}
</style>
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-7" align="center" id="kiri" style="height: 100vh;"><img src="assets/img/orang.png" alt=""></div>
			<div class="col-sm-5">
				<br><br>
				<div class="container" id="kanan">
					<h2><b>Selamat Datang Di Ujang Restaurant</b></h2>
					<br>
					<h5 style=" color:#b5b5b5; " >Silahkan isi form untuk memesan</h5>
					<br>
					<form method="POST">
						<div class="form-group">
							<label for="exampleInputEmail1">Nama</label>
							<input type="text" name="nama" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">Nomor Meja</label>
							<br>
							<label for=""><?php echo $no ?></label>
						</div>
						<br><br>
						<button type="submit" name="submit" id="btn" class="btn btn-primary">Kirim</button>
					</form>
				</div>
			</div>
		</div>
	</div>


	<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>
</html>