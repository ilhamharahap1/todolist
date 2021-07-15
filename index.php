<?php 
//koneksi
$host = "localhost";
$user = "root";
$pass = "";
$name = "todo";

$koneksi = mysqli_connect($host, $user, $pass, $name);

//test koneksi
if (mysqli_connect_errno()) {
	die("Koneksi Database Gagal: " .
		mysql_connect_error() . 
		"(" . mysqli_connect_errno() .")");
	}


	//simpan
	if (isset($_POST['simpan'])) {
		$tugas = $_POST['task'];
		

		$tugas = mysqli_real_escape_string($koneksi, $tugas);
		$sql = "INSERT INTO tblawal (mulai_tugas)
				VALUES ('{$tugas}')";
		mysqli_query($koneksi, $sql);
	



     //Mengecek apakah ada nilai akhir yang dikirim dari form
    if (isset($_POST['selesai'])) {
    	$selesai = $_POST['radio'];

    	$selesai = mysqli_real_escape_string($koneksi, $selesai);
		$sql2 = "INSERT INTO tblakhir (akhiri_tugas)
				VALUES (mulai_tugas)";
		mysqli_query($koneksi, $sql2);
}
}




	//query database
	$sql = "SELECT * FROM tblawal";
	$hasil = mysqli_query($koneksi, $sql);
	$sql2 = "SELECT * FROM tblakhir";
	$hasil2 = mysqli_query($koneksi, $sql2);

	?>


<!DOCTYPE html>
<html>
<head>
	<title>To Do List</title>
</head>
<body>

	<h2> To DO List</h2>
	<!-- input data Todo List -->
	<form action="" method="POST">
		<input type="text" name="task" value="" autocomplete="off">
		
		<input type="submit" name="simpan" value="add">
	</form>


		<h1>Tugas Baru</h1>
		<hr>
			<!-- input dan menampilkan radio -->
			<form action="" method="POST">
			<?php 

				while ($baris = mysqli_fetch_assoc($hasil)) {
					echo "<tr>";
						echo "<input type=radio name=radio>" . $baris['mulai_tugas'] . "</td>";
						echo "</tr>";
						echo "<br>";
				}
				mysqli_free_result($hasil);

			 ?>
			 <br>
			 <input type="submit" name="selesai" value="add">
			</form>

			 <h1>Tugas Selesai</h1>
			 <hr>
			
			 			
			 <!-- menampilkan data inputan -->
			 <?php 
				while ($baris = mysqli_fetch_assoc($hasil2)) {
					echo "<tr>";
						echo "<input type=radio name=radio>" . $baris['akhiri_tugas'] . "</td>";
						echo "</tr>";
						echo "<br>";
					}

			  ?>
	
</body>
</html>

<?php 
//mengahiri koneksi
	mysqli_close($koneksi);
 ?>