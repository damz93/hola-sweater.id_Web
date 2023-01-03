<?php
	session_start();
	include 'koneksi.php';
	error_reporting(0);	
	$id   = $_GET['id'];
	if ($_SESSION['status']!="login") {
		echo "<script>alert('Anda belum login.....');window.location.href='index?pesan=belum_login';</script>";
	}
	else if($_SESSION['level']!="OWNER") {
		echo "<script>alert('Anda tidak memiliki akses.....');window.location.href='javascript:history.go(-1)';</script>";
	}
	else {
		$query="DELETE from t_kategori_pemasukan where ID='$id'";
		if (mysqli_query($koneksi, $query)) {
				echo "<script>alert('data terhapus');window.location.href='pemasukan-new';</script>";		
			} else {
				echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
			}
	}
?>