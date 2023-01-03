<?php
include 'koneksi.php';
// menyimpan data id kedalam variabel
$keperluan   = $_GET['keperluan'];
$query="DELETE from t_pengeluaran_temp where KATEGORI='$keperluan'";
if (mysqli_query($koneksi, $query)) {
		echo "<script>alert('data terhapus');window.location.href='input-pengeluaran.php';</script>";		
	} else {
		echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
	}
?>