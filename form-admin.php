<?php 
include 'koneksi.php';
if (isset($_POST['submit'])) {
	$nama = $_POST['nama'];
	$user = $_POST['user'];
	$password = $_POST['password'];
	$alamat = $_POST['alamat'];
	$no = $_POST['no'];
	$kuari = mysqli_query($koneksi,"SELECT * FROM tbl_admin WHERE username = '$user'");
	$data = mysqli_fetch_assoc($kuari);
	if ($nama = true) {
		echo "<script>
		alert('username sama');
		document.location.href = 'form-admin.php'
		</script>";
	}else{
		$quary = mysqli_query($koneksi, "INSERT INTO tbl_admin VALUES('','$nama','$user','$password','$alamat','$no')");
		if ($quary) {
			echo "<script>
			alert('Berhasil daftar');
			document.location.href = 'login-admin.php'
			</script>";
		}else{
			echo "<script>
			alert('gagal');
			document.location.href = 'form-admin.php'
			</script>";
		}
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
	body{
		background-image: url('assets/img/gunung.png');
		background-size: cover;
	}
	#login{
		padding-top:3vh;

	}
	#kiri{
		background-color: #e0e0e0;
		border-radius: 20px;
	}
	#kanan{
		background-image: url('assets/img/gunung.png');
		background-size: cover;
		background-repeat: no-repeat;
	}
	@media(max-width: 600px) {
		#kanan{
			display: none;

		}	
		#kiri{
			opacity: 90%;
			background-color: #ffa1a1;
		}
	}
</style>
</head>
<body>
	<div class="container" id="login">
		<div class="row">

			<div class="col-sm-4 p-3 " id="kiri"><h2><b>Login</b></h2><br>
				<form method="POST">
					<div class="form-group">
						<label for="exampleInputEmail1">Nama</label>
						<input type="text" name="nama" placeholder="masukan nama anda" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">username</label>
						<input type="text" name="user" placeholder="masukan nama anda" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">alamat</label>
						<input type="text" name="alamat" placeholder="masukan nama anda" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
					</div>
					<div class="form-group">
						<label for="exampleInputPassword1">Password</label>
						<input type="password" name="password" class="form-control" id="exampleInputPassword1">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">No Telepon</label>
						<input type="text" name="no" placeholder="masukan nama anda" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
					</div>
					<button type="submit" name="submit" class="btn btn-primary">Submit</button>
				</form></div>
				<div class="col-sm-8 p-2" id="kanan" align="center" style=" border-radius: 20px; "><h1>Selamat Datang di Ujang restaurant</h1> </div>
			</div>
		</div>


		<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
	</body>
	</html>