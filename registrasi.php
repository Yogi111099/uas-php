<?php 

require 'functions.php';

if (isset($_POST["register"]) ) {

	if( registrasi($_POST) > 0 ) {
		echo "<script>

				alert('user baru berhasil di tambahkan');
			 </script>";
	} else {
		echo mysqli_error($conn);
	}
	
}

 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Halaman Registrasi</title>
	<link rel="stylesheet" href="registrasi.css">
	<style>
		label {
			display: block;
		}
	</style>
</head>
<body>


	<form action="" method="post">
		<h1>Halaman Registrasi</h1>
		<ul>
		 <li><label for="username">username</label>
		 	 <input type="text" name="username" id="username" required>	
		  </li>
		  <li><label for="username">passowrd</label>
		 	 <input type="password" name="password" id="username" required>	
		  </li>
		  <li><label for="password2">konfirmasi password</label>
		 	 <input type="password" name="password2" id="password2" required>	
		  </li>
		  <li>
		  	<button type="submit" name="register">Resgistrasi</button>
		  </li>
		  </ul>
	</form>

</body>
</html>