<?php 
session_start();


if( !isset($_SESSION["login"]) ) {
	header("location: login.php");
	exit;
}

require 'functions.php';


$id = $_GET["id"];


$mhs = query("SELECT * FROM mahasiswa WHERE id = $id")[0];

if( isset($_POST["submit"]) ) {


	if( ubah($_POST) > 0 ){
		echo "
			<script>
				alert('data berhasil di ubah');
				document.location.href = 'index.php';

			</script>
			";

	}else {
		echo "

			<script>
				alert('data gagal di ubah');
				document.location.href = 'index.php';

			</script>
		   ";
	}

}
 ?>

 <!DOCTYPE html>
<html lang="en">
<head>
	<title>ubah Data Mahasiswa</title>
	<link rel="stylesheet" href="ubah.css">
</head>
<body>
	<button class="logout-button" onclick="location.href='logout.php'">Logout</button>
    <div class="container">
	<h1>ubah Data Mahasiswa</h1>

	<form action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?= $mhs["id"]; ?>">
		<input type="hidden" name="gambarLama" value="<?= $mhs["gambar"]; ?>">
	<ul>
		<li>
			<label for="nama">Nama</label>
			<input type="text" name="nama" id="nama" required value="<?= $mhs["nama"]; ?>">
		</li>
		<li>
			<label for="npm">NPM</label>
			<input type="text" name="npm" id="npm" required value="<?= $mhs["npm"]; ?>">
		</li>
		<li>
			<label for="email">Email</label>
			<input type="text" name="email" id="email" value="<?= $mhs["email"]; ?>">
		</li>
		<li>
			<label for="prodi">Prodi</label>
			<input type="text" name="prodi" id="prodi" required value="<?= $mhs["prodi"]; ?>">
		</li>
		<li>
			<label for="gambar">Gambar</label>
			<img src="img/<?= $mhs['gambar']; ?>" width="50px" alt="">
			<input type="file" name="gambar" id="gambar">
		</li>
		<li>
			<button type="submit" name="submit">ubah Data!</button>
		</li>
	</ul>
	</div>
	</form>
</body>
</html>