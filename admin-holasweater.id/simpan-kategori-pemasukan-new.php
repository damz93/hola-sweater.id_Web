<?php
error_reporting(0);	
include 'koneksi.php';
session_start();
date_default_timezone_set('Asia/Hong_Kong');
$oleh = $_SESSION['username'];
$kategori = $_POST['kategori'];
$query="INSERT INTO t_kategori_pemasukan(KATEGORI,NOTES)VALUES('$kategori','$oleh')";
	$cekdulu= "select * from t_kategori_pemasukan where KATEGORI='$kategori'";
	$prosescek= mysqli_query($koneksi, $cekdulu);
	if (mysqli_num_rows($prosescek)>0) {
		echo "<script>alert('Gagal menyimpan, Sumber Dana sudah ada.');history.go(-1) </script>";
	}
	else {
		if (mysqli_query($koneksi, $query)) {
		echo "<script>alert('data tersimpan');window.location.href='pemasukan-new';</script>";
		} else {
			echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
		}
	}
?>