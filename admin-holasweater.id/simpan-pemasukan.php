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
	$ketee = "ditambahkan oleh ".$oleh." pada tgl dan jam ".$waktu_skg;
	$kod_inp = $_POST['KODE_PEMASUKAN'];
	$jenis = $_POST['JENIS'];
	$dari = $_POST['DARI'];
	$cost = $_POST['COSTUM'];
	$pem_tgl = $_POST['PEMASUKAN_TGL'];
	$noref = $_POST['NOREF'];
	$qty = $_POST['QTY'];
	$paym = $_POST['PAYMENT'];
	$paym = '-';
	$qty = str_replace(".","",$qty); 
	$tot_pem = $_POST['TOTAL_PEMBAYARAN'];	
	$tot_pem = str_replace(".","",$tot_pem); 
	$pem_trf = $_POST['PEM_TRF'];	
	$pem_trf = str_replace(".","",$pem_trf); 
	$pem_edc = $_POST['PEM_EDC'];	
	$pem_edc = str_replace(".","",$pem_edc); 
	$pem_tni = $_POST['PEM_TNI'];	
	$pem_tni = str_replace(".","",$pem_tni); 
	$notess = $_POST['KETERANGAN'];
// query SQL untuk insert data
	$query="INSERT INTO t_pemasukan2(TRF,EDC,TUNAI,COSTUM,KODE_TRANSAKSI,JENIS,DARI,TOTAL,PAYMENT,NOREF,NOTES,QTY,TGL,WAKTU,OLEH,KETERANGAN)VALUES('$pem_trf','$pem_edc','$pem_tni','$cost','$kod_inp','$jenis','$dari','$tot_pem','$paym','$noref','$notess','$qty','$tgl_saja','$waktu_skg','$oleh','$ketee')";
		if (mysqli_query($koneksi, $query)) {
			echo "<script>alert('data tersimpan');window.location.href='pemasukan-new';</script>";
		} else {
			echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
		}
?>