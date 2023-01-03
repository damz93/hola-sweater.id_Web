<?php
	error_reporting(0);	
	include 'koneksi.php';
	date_default_timezone_set('Asia/Hong_Kong');
	session_start();
	// menyimpan data kedalam variabel
	$waktu_skg = date("d/m/Y h:i:s");
	$oleh = $_SESSION['username'];
	$level = $_SESSION['level'];
	$tgl_saja = $_POST['tgl_transaksi'];
	$ketee = "diedit oleh ".$oleh." pada tgl dan jam ".$waktu_skg;
	$kod_inp = $_POST['KODE_PEMASUKAN'];
	$jenis = $_POST['JENIS'];
	$dari = $_POST['DARI'];
	$cost = $_POST['COSTUM'];
	$pem_tgl = $_POST['PEMASUKAN_TGL'];
	$noref = $_POST['NOREF'];
	$qty = $_POST['QTY'];
	$paym = $_POST['PAYMENT'];
	$qty = str_replace(".","",$qty); 
	$tot_pem = $_POST['TOTAL_PEMBAYARAN'];	
	$tot_pem = str_replace(".","",$tot_pem); 
	$notess = $_POST['KETERANGAN'];
	//KODE_TRANSAKSI,TOTAL_TRANSFER,TOTAL_PENGELUARAN,TOTAL_PEMASUKAN,QTY,TGL,WAKTU,OLEH,KETERANGAN,NOTES
	$query="UPDATE t_pemasukan2 SET COSTUM='$cost',JENIS='$jenis',DARI='$dari',TOTAL='$tot_pem',PAYMENT='$paym', NOREF='$noref',NOTES='$notess',QTY='$qty',TGL='$tgl_saja',WAKTU='$waktu_skg',OLEH='$oleh',KETERANGAN='$ketee' where KODE_TRANSAKSI='$kod_inp'";
	if (mysqli_query($koneksi, $query)) {
		echo "<script>alert('data terupdate');window.location.href='form-pemasukan.php';</script>";		
	} else {
		echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
	}
?>
//KODE_TRANSAKSI,JENIS,DARI,TOTAL,PAYMENT,NOREF,NOTES,QTY,TGL,WAKTU,OLEH,KETERANGAN