<?php
error_reporting(0);	
include 'koneksi.php';
date_default_timezone_set('Asia/Hong_Kong');
session_start();
// menyimpan data kedalam variabel
$waktu_skg = date("d/m/Y h:i:s a");
$oleh = $_SESSION['username'];
$tgl_saja = date("Y/m/d");
$ketee = "ditambahkan oleh ".$oleh." pada tgl dan jam ".$waktu_skg;
$level = $_SESSION['level'];
$kode_pengeluaran = $_POST['KODE_PENGELUARAN'];
$divisi = $_POST['DIVISI'];
$kategori = $_POST['JENIS'];
$notes = $_POST['DETAIL'];
$olh = $_POST['OLEH'];
$nominal = $_POST['TOTAL_PEMBAYARAN'];
$nominal = str_replace(".","",$nominal); 
// query SQL untuk insert data
$query="INSERT INTO t_pengeluaran(DIVISI,PERMINTAAN,KODE_PENGELUARAN,KATEGORI,NOTES,NOMINAL,TGL,WAKTU,OLEH,KETERANGAN)VALUES('$divisi','$olh','$kode_pengeluaran','$kategori','$notes','$nominal','$tgl_saja','$waktu_skg','$oleh','$ketee')";
	if (mysqli_query($koneksi, $query)) {
		echo "<script>alert('data tersimpan');window.location.href='pengeluaran-new.php';</script>";
	} else {
		echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
	}
?>