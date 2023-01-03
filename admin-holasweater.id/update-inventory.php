<?php
	include 'koneksi.php';
	date_default_timezone_set('Asia/Hong_Kong');
	session_start();
	error_reporting(0);	
	
	$waktu_skg2 = date("d/m/Y h:i:s");
	$tgl = date("Y/m/d");
	$oleh = $_SESSION['username'];
	$keterangan = "diedit oleh ".$oleh." pada tgl dan jam ".$waktu_skg2;
	$kode_barang = $_POST['KODE_BARANG'];
	$nama_barang = $_POST['NAMA_BARANG'];
	$spesf = $_POST['SPESIFIKASI'];
	$satuan = $_POST['SATUAN'];	

	if ($_SESSION['status']!="login") {
		echo "<script>alert('Anda belum login.....');window.location.href='index.php?pesan=belum_login';</script>";
	}
	else if(($_SESSION['level']!="OWNER")AND($_SESSION['level']!="SPV GUDANG")) {
		echo "<script>alert('Anda tidak memiliki akses.....');window.location.href='javascript:history.go(-1)';</script>";
	}
	else {
		$query="UPDATE t_inventory SET TGL='$tgl',NAMA_BARANG='$nama_barang',SPESIFIKASI='$spesf',SATUAN='$satuan',KETERANGAN='$keterangan',OLEH='$oleh' where KODE_BARANG='$kode_barang'";
		if (mysqli_query($koneksi, $query)) {
				echo "<script>alert('data terupdate');window.location.href='form-inventory.php';</script>";		
			} else {
				echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
			}
	}
?>