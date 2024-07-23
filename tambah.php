<?php 
session_start();


if( !isset($_SESSION["login"]) ) {
	header("location: login.php");
	exit;
}

require 'functions.php';
if( isset($_POST["submit"]) ) {


	if(tambah($_POST) > 0 ){
		echo "
			<script>
				alert('data berhasil di tambahkan');
				document.location.href = 'index.php';

			</script>
			";

	}else {
		echo "

			<script>
				alert('data gagal di tambahkan');
				document.location.href = 'index.php';

			</script>
		   ";
	}

}
 ?>

 <!DOCTYPE html>
<html lang="en">
<head>
	<title>Tambah Data Mahasiswa</title>
	<link rel="stylesheet" href="tambah.css">
</head>
<body>
	
	 <button class="logout-button" onclick="location.href='logout.php'">Logout</button>
    <div class="container">

	<form action="" method="post" enctype="multipart/form-data">
		<h1>Tambah Data Mahasiswa</h1>
	<ul>
		<li>
			<label for="nama">Nama</label>
			<input type="text" name="nama" id="nama" required>
		</li>
		<li>
			<label for="npm">NPM</label>
			<input type="text" name="npm" id="npm" required>
		</li>
		<li>
			<label for="email">Email</label>
			<input type="text" name="email" id="email">
		</li>
		<li>
			<label for="prodi">Prodi</label>
			<input type="text" name="prodi" id="prodi" required>
		</li>
		<li>
			<label for="gambar">Gambar</label>
			<input type="file" name="gambar" id="gambar">
		</li>
		<li>
			<button type="submit" name="submit">Tambah Data!</button>
		</li>
	</ul>
</div>
	</form>
</body>
</html>