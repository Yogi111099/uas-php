   <?php 

   $hostname = "sql302.infinityfree.com";
   $username = "if0_36920808";
   $password = "pb68rhKadA";
   $database = "if0_36920808_phpdasar";

$conn = mysqli_connect($hostname, $username, $password, $database);


function query($query) {
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while( $row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	}

	return $rows;
	}

	function tambah($data){
	global $conn;

	$nama= htmlspecialchars($data["nama"]);
	$npm = htmlspecialchars($data["npm"]);
	$email = htmlspecialchars($data["email"]);
	$prodi = htmlspecialchars($data["prodi"]);

	$gambar = upload();
	if( !$gambar ) {
		return false;
	}

	$query = "INSERT INTO mahasiswa VALUES
			('','$nama', '$npm',  '$email', '$prodi', '$gambar')
			";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
	}


	function upload() {

		$namaFile = $_FILES['gambar']['name'];
		$ukuranFile = $_FILES['gambar']['size'];
		$error = $_FILES['gambar']['error'];
		$tmpName = $_FILES['gambar']['tmp_name'];

		if( $error === 4 ) {
			echo "<script>
					alert('pilih gambar terlebih dahulu!');
					</script>";
					return false;
		}

		$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
		$ekstensiGambar = explode('.', $namaFile);
		$ekstensiGambar = strtolower(end($ekstensiGambar));
		if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
			echo "<script>
					alert('yang anda upload bukan gambar!');
					</script>";
					return false;
		}


		if( $ukuranFile > 1000000 ) {
			echo "<script>
					alert('ukuran gambar terlalu besar!');
					</script>";
		}


		$namaFileBaru = uniqid();
		$namaFileBaru .= '.';
		$namaFileBaru .= $ekstensiGambar;

		move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

		return $namaFileBaru;

	}





	function hapus($id) {
		global $conn;
		mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");
		return mysqli_affected_rows($conn);
	}


	


	
	function ubah($data) {
	global $conn;
	$id = $data["id"];
	$nama = htmlspecialchars($data["nama"]);
	$npm = htmlspecialchars($data["npm"]);
	$email = htmlspecialchars($data["email"]);
	$prodi = htmlspecialchars($data["prodi"]);
	$gambarLama = htmlspecialchars($data["gambarLama"]);


	if( $_FILES['gambar']['error'] === 4 ) {
		$gambar = $gambarLama;
	} else {$gambar = upload();


	}



	$query = "UPDATE mahasiswa SET
				nama = '$nama',
				npm = '$npm',
				email = '$email',
				prodi = '$prodi',
				gambar = '$gambar'

			WHERE id = $id
			 ";
				

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
	}

	


	function cari($keyword) {
		$query = "SELECT * FROM mahasiswa WHERE
			nama LIKE '%$keyword%' OR
			npm LIKE'%$keyword%' 

			";

		return query($query);
	}



	function registrasi($data) {
		global $conn;

		$username = strtolower(stripslashes($data["username"]));
		$password = mysqli_real_escape_string($conn, $data["password"]);
		$password2= mysqli_real_escape_string($conn, $data["password2"]);

		$result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

		if( mysqli_fetch_assoc($result) ) {
			echo "<script>
					alert('username sudah terdaftar')
				  </script>";
			return false;
		}

		if( $password !== $password2 ) {
			echo "<script>
					alert('konfirmasi password tidak sesuai');
				  </script>";
		return false;
	   }

	   $password = password_hash($password, PASSWORD_DEFAULT);

	   mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$password')");

	   return mysqli_affected_rows($conn);

	}





 ?>