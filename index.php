<?php
session_start();


if( !isset($_SESSION["login"]) ) {
	header("location: login.php");
	exit;
}

require 'functions.php';
$mahasiswa = query("SELECT * FROM mahasiswa");

if(isset($_POST["cari"]) ) {
	$mahasiswa = cari($_POST["keyword"]);
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Halaman Admin</title>
	<link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>
	<div class="container">
<p class="logout">
<a href="logout.php">Logout</a>
</p>
	
<h1>Daftar Mahasiswa</h1>
<a href="tambah.php">Tambah data Mahasiswa</a>
<br><br>

<form action="" method="post">
	
	<input type="text" name="keyword" size="40" autofocus placeholder="masukkan keyword pencarian..." autocomplete="off">
	<button type="submit" name="cari">Cari</button>

</form>
<br>
<table border="1" cellpadding="10" cellspacing="0">
	
	<tr> 
		<th>No.</th>
		<th>Aksi</th>
		<th>Gambar</th>
		<th>NPM</th>
		<th>Nama</th>
		<th>Email</th>
		<th>Prodi</th>
	</tr>	
	
	<?php $i = 1; ?>
	<?php foreach( $mahasiswa as $row) : ?>
	<tr> 
		<td> <?= $i; ?> </td>
		<td>
			<a href="ubah.php?id=<?= $row["id"]; ?>">ubah</a>
			<a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('yakin');" >hapus</a>
		</td>
		<td><img src="img/<?= $row["gambar"]; ?>" width="50"></td>
		<td><?= $row["npm"]; ?></td>
		<td><?= $row["nama"]; ?></td>
		<td><?= $row["email"]; ?></td>
		<td><?= $row["prodi"]; ?></td>

	</tr>
	<?php $i++; ?>
	<?php endforeach;  ?>
</table>
</div>
</body>
</html>