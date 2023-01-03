<?php
	error_reporting(0);	
	include 'koneksi.php';
	date_default_timezone_set('Asia/Hong_Kong');
	session_start();
	// menyimpan data kedalam variabel
	$waktu_skg = date("d/m/Y h:i:s");		
	$level = $_SESSION['level'];
	if (($level == "OWNER") OR ($level == "BENDAHARA")){
		$tgl_saja = $_POST['tgl_transaksi'];
	}
	else{
		$tgl_saja = date("Y/m/d");
	}
	$oleh = $_SESSION['username'];
	$keter = "diedit oleh ".$oleh." pada tgl dan jam ".$waktu_skg;
	$kode_pengeluaran = $_POST['KODE_PENGELUARAN'];
	$kategori = $_POST['KATEGORIX'];
	$keterangan = $_POST['KETERANGAN'];
	$nominal = $_POST['NOMINAL'];
	$nominal = str_replace(".","",$nominal); 
	$query="UPDATE t_pengeluaran SET TGL='$tgl_saja', KATEGORI='$kategori',NOTES='$keterangan',KETERANGAN='$keter',NOMINAL='$nominal' where KODE_PENGELUARAN='$kode_pengeluaran'";
	if (mysqli_query($koneksi, $query)) {
		echo "<script>alert('data terupdate');window.location.href='form-pengeluaran.php';</script>";		
	} else {
		echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
	}
?>