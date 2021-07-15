<?php 
//koneksi
$host = "localhost";
$user = "root";
$pass = "";
$name = "todolist";

$koneksi = mysqli_connect($host, $user, $pass, $name);

//test koneksi
if (mysqli_connect_errno()) {
	die("Koneksi Database Gagal: " .
		mysql_connect_error() . 
		"(" . mysqli_connect_errno() .")");
	}


//submit
	if (isset($_POST['simpan'])) {
		$tugas = $_POST['task'];
		$priority = $_POST['priority'];

		$tugas = mysqli_real_escape_string($koneksi, $tugas);
		$priority = mysqli_real_escape_string($koneksi, $priority);
		$sql = "INSERT INTO tugas_tbl (priority, tugas, status)
				VALUES ('{$priority}', '{$tugas}', 'No Status')";
		mysqli_query($koneksi, $sql);
	}



//klik action
	if (isset($_GET['status'])) {
		if ($_GET['status'] == 1) {
			$sql = "UPDATE tugas_tbl SET status='On Progress'
				WHERE id=$_GET[id]";
		} else if($_GET['status'] == 2){
		$sql = "UPDATE tugas_tbl SET status='Cencel'
				WHERE id=$_GET[id]";
		} else if($_GET['status'] == 3){
		$sql = "UPDATE tugas_tbl SET status='Done'
				WHERE id=$_GET[id]";
		} else if ($_GET['status'] == 4){
			$sql = "DELETE FROM tugas_tbl WHERE id=$_GET[id]";
		}
		mysqli_query($koneksi, $sql);
	}

	//query SQL
	$sql = "SELECT * FROM tugas_tbl";
	$hasil = mysqli_query($koneksi, $sql);

	
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>TODO List</title>
</head>
<body>

	<h2T> To DO List</h2>
		<form action="" method="POST">
			<label>New To DO :</label>
			<input type="text" name="task" value="" autocomplete="off">
			<select name="priority">
				<option value="hight">HIGHT</option>
				<option value="medium">Medium</option>
				<option value="low">Low</option>
			</select>
			<input type="submit" name="simpan" value="add">
		</form>

	<table border="1" width="80%">
		<thead>
			<tr>
				<th>Priority</th>
				<th>Descripton</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
		</thead>

		<tbody>
			<?php 

				while ($baris = mysqli_fetch_assoc($hasil)) {
					echo "<tr>";
						echo "<td>" . $baris['priority'] . "</td>";
						echo "<td>" . $baris['tugas'] . "</td>";
						echo "<td>" . $baris['status'] . "</td>";
						echo "<td>";
						echo "<a href='index.php?status=1&id=" . $baris['id'] . "'> Start </a> |";
						echo "<a href='index.php?status=2&id=" . $baris['id'] . "'> Cencel </a> |";
						echo "<a href='index.php?status=3&id=" . $baris['id'] . "'> Done </a> |";
						echo "<a href='index.php?status=4&id=" . $baris['id'] . "'> delete </a>";
						echo "</td>";
					echo "</tr>";
				}


				mysqli_free_result($hasil);

			 ?>
		</tbody>
	</table>


</body>
</html>

<?php 
//mengahiri koneksi
	mysqli_close($koneksi);
 ?>