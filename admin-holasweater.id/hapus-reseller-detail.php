<?php
include 'koneksi.php';
// menyimpan data id kedalam variabel
$jenis_barang   = $_GET['jenis_barang'];
$query="DELETE from t_reseller_temp where JENIS_BARANG='$jenis_barang'";
if (mysqli_query($koneksi, $query)) {
		echo "<script>alert('data terhapus');window.location.href='input-reseller.php';</script>";		
	} else {
		echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
	}
?>