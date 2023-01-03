<?php
include 'koneksi.php';
// menyimpan data id kedalam variabel
session_start();
//$oleh = $_SESSION['username'];
$olehx = $_GET['userx'];
$query="DELETE from t_stok_masuk_temp WHERE OLEH='$olehx'";
if (mysqli_query($koneksi, $query)) {
	//	echo "<script>alert('List Dibersihkan...');window.location.href='input-stok-keluar.php';</script>";		
	} else {
		echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
	}
?>