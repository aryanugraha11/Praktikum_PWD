<!DOCTYPE html>
<html>

<head>

	<style>
		.error {
			font-size: 15px;
			color: red;
		}
	</style>
</head>

<body>
	<?php
	$nimErr = $namaErr = $jkelErr = $alamatErr = $tgllahirErr = $jurusanErr = "";
	$nim = $nama = $jkel = $alamat = $tgllahir = $jurusan = "";

	$flag = true;
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		if (empty($_POST["nim"])) {
			$nimErr = "nim harus diisi";
			$flag = false;
		} else {
			$nim = test_input($_POST["nim"]);
		}

		if (empty($_POST["nama"])) {
            $namaErr = "nama harus diisi";
			$flag = false;
            }else {
            $nama = test_input($_POST["nama"]);
            }

		if (empty($_POST["jkel"])) {
            $jkelErr = 'Jenis Kelamin harus diisi';
			$flag = false;
		} else {
			$jkel = test_input($_POST["jkel"]);
		}

		if (empty($_POST["alamat"])) {
			$alamat = 'alamat harus diisi';
			$flag = false;
		} else {
			$alamat = test_input($_POST["alamat"]);
		}

		if (empty($_POST["tgllahir"])) {
			$tgllahirErr = "tanggal lahir harus diisi";
            $flag = false;
		}else {
			$tgllahir = test_input($_POST["tgllahir"]);
		}

        if (empty($_POST["jurusan"])) {
			$jurusanErr = "jurusan harus diisi";
            $flag = false;
		}else {
			$jurusan = test_input($_POST["jurusan"]);
		}

		// kondisi untuk memvalidasi data yang diinputkan di from untuk dimasukkan ke dalam table mahasiswa
		if ($flag) {

			$conn = new mysqli("localhost","root","","akademik");

			if ($conn->connect_error) {
				die("connection failed error: " . $conn->connect_error);
			}
			
			$sql = "INSERT INTO mahasiswa (nim, nama, jkel, alamat, tgllahir, jurusan) VALUES('$nim', '$nama', '$jkel','$alamat', '$tgllahir', '$jurusan') ";
			// execute sql insert
			if ($conn->query($sql) === TRUE) {
				echo "<script> alert('Data Tersimpan');</script>";
			}
		}
	}

	function test_input($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	?>
	<form action=" <?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
		<h2>Validasi Data Mahasiswa </h2>
		<table>
                <tr>
                    <td>Nim : </td>
					<td><input type="text" name="nim" placeholder="nim">
					<span class="error">* <?= $nimErr; ?></span>
					</td>
				</tr>

                <tr>
                    <td>Nama : </td>
					<td><input type="text" name="nama" placeholder="Nama">
					<span class="error">* <?= $namaErr; ?></span>
					</td>
				</tr>
                <tr>
					<td>Jenis Kelamin :</td>
				    <td>
                    <input type = "radio" name = "jkel" value = "L">Laki-Laki
                    <input type = "radio" name = "jkel" value = "P">Perempuan
                    <span class = "error">* <?php echo $jkelErr; ?></span>
                    </td>
				</tr>
				<tr>
					<td>Alamat : </td>
					<td><input type="text" name="alamat" placeholder="alamat">
					<span class="error"> <?= $alamatErr; ?></span>
					</td>
				</tr>
				<tr>
					<td>Tanggal Lahir : </td>
					<td><input type="date" name="tgllahir" ></input></td>
                    <span class="error"> <?= $tgllahirErr; ?></span>
				</tr>
                <tr>
					<td>Jurusan : </td>
					<td><input type="text" name="jurusan" ></input></td>
                    <span class="error"> <?= $jurusanErr; ?></span>
				</tr>
				
				<td>
				<input class="button btn btn-primary" type="submit" name="button">
				</td>
		</table>
	</form>
	</body>
</html>