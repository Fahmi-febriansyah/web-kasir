<?php 
include 'koneksi.php';
session_start();
if (isset($_POST['submit'])) {
	$user = $_POST['username'];
	$password = $_POST['password'];
	$quary = mysqli_query($koneksi,"SELECT * FROM tbl_admin WHERE username = '$user'")->fetch_assoc();
	if ($password === $quary['password']) {
		$_SESSION['nama'] = $quary['nama_admin'];
		$_SESSION['login'] = 1;
		echo "<script>
		alert('Berhasil masuk');
		document.location.href = 'admin.php'
		</script>";
	}else{
		echo "<script>
		alert('Username dan password salah');
		document.location.href = 'login-admin.php'
		</script>";
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
			background-image: url('assets/img.side.jpg');
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
					<h2><b>Admin Login Di Sini</b></h2>
					<br>
					<h5 style=" color:#b5b5b5; " >Silahkan isi form untuk login</h5>
					<br>
					<form method="POST">
						<div class="form-group">
							<label for="exampleInputEmail1">Username</label>
							<input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">Password</label>
							<input type="password" name="password" class="form-control" id="exampleInputPassword1">
						</div>
						<p>Belum Punya akun ? <a href="form-admin.php">Buat akun</a></p>
						<button type="submit" name="submit" class="btn btn-primary">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</div>


	<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>
</html>