<?php
error_reporting(0);	
include 'koneksi.php';
date_default_timezone_set('Asia/Hong_Kong');
session_start();
// menyimpan data kedalam variabel
$waktu_skg = date("d/m/Y h:i:s");

$oleh = $_SESSION['username'];
$level = $_SESSION['level'];
if (($level == "OWNER") OR ($level == "SPV KASIR")){
	$tgl_saja = $_POST['tgl_transaksi'];
}
else{
	$tgl_saja = date("Y/m/d");
}
$ketee = "ditambahkan oleh ".$oleh." pada tgl dan jam ".$waktu_skg;
$kode_pengeluaran = $_POST['KODE_PENGELUARAN'];
$kategori = $_POST['KATEGORIX'];
$notes = $_POST['KETERANGAN'];
$nominal = $_POST['NOMINAL'];
$nominal = str_replace(".","",$nominal); 
// query SQL untuk insert data
$query="INSERT INTO t_pengeluaran(KODE_PENGELUARAN,KATEGORI,NOTES,NOMINAL,TGL,WAKTU,OLEH,KETERANGAN)VALUES('$kode_pengeluaran','$kategori','$notes','$nominal','$tgl_saja','$waktu_skg','$oleh','$ketee')";
	if (mysqli_query($koneksi, $query)) {
		echo "<script>alert('data tersimpan');window.location.href='form-pengeluaran.php';</script>";
	} else {
		echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
	}
?>