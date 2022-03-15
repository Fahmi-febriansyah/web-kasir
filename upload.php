<?php 
include 'koneksi.php';
$kuari = mysqli_query($koneksi,"SELECT * FROM Kategori");
if (isset($_POST['submit'])) {
	$ekstensi_diperbolehkan = array('png','jpg');
	$nama = $_FILES['file']['name'];
	$x = explode('.', $nama);
	$ekstensi = strtolower(end($x));
	$ukuran	= $_FILES['file']['size'];
	$file_tmp = $_FILES['file']['tmp_name'];
	$gambar = $_POST['nama'];
	$harga = $_POST['harga'];
	$kategori = $_POST['kategori'];	

	if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
		if($ukuran < 1044070){			
			move_uploaded_file($file_tmp, 'assets/img/'.$nama);
			$query = mysqli_query($koneksi,"INSERT INTO tbl_barang VALUES(NULL, '$gambar','$harga','$nama','$kategori')");
			if($query){
				echo "<script>
				alert('data berhasil di upload');
				document.location.href = 'admin.php'
				</script>";
			}else{
				echo "<script>
				alert('gagal upload data');
				document.location.href = 'upload.php'
				</script>";
			}
		}else{
			echo "<script>
			alert('ukuran file terlalu besar');
			document.location.href = 'upload.php'
			</script>";
		}
	}else{
		echo "<script>
		alert('hanya menerima png dan jpg');
		document.location.href = 'upload.php'
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
	body{
		background-image: url('assets/img/gunung.png');
		background-size: cover;
	}
	#login{
		padding-top:10vh;

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
			<div class="col-sm-4 p-3 " id="kiri"><h2><b>Upload Produk</b></h2><br>
				<form method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label for="exampleInputEmail1">Nama Barang</label>
						<input type="text" name="nama" placeholder="masukan nama anda" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Harga</label><br>
						<input type="number" name="harga" style=" width:345px; height: 40px; border-radius: 5px; " placeholder="masukan harga">
					</div>
					<div class="form-group">
						<label for="">Gambar</label>
						<input type="file" name="file">
					</div>
					<div class="form-group my-3">
						<label for="basic-url">Kategori</label>
						<select class="form-control" id="type" name="kategori">
							<?php while( $row = mysqli_fetch_assoc($kuari) ) : ?>
								<option value="<?= $row['id_kategori'] ?>"><?= $row['kategori'] ?></option>
							<?php endwhile; ?>
						</select>
					</div>
					<button type="submit" name="submit" class="btn btn-primary">Submit</button>
				</form></div>
				<div class="col-sm-8 p-2" id="kanan" align="center" style=" border-radius: 20px; "><h1>Silahkan Upload Produk</h1> </div>
			</div>
		</div>


		<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
	</body>
	</html>