<?php
   error_reporting(0);
   session_start();
   include 'koneksi.php';
   //include 'csrf.php';
    date_default_timezone_set('Asia/Hong_Kong');
    $waktu_skg2 = date("d/m/Y h:i:s");
   	$tgl = date("Y/m/d");
   	$oleh = $_SESSION['username'];
	$kode_tr = $_POST['kode_transaksi'];
   	$keterangan = "ditambah oleh ".$oleh." pada tgl dan jam ".$waktu_skg2;
	$keperluan = $_POST['keperluan'];
	$notes = $_POST['keterangan'];
	$banyaknya = $_POST['banyaknya'];
	$banyaknya = str_replace(".","",$banyaknya); 
	$per_item = $_POST['per_item'];
	$per_item = str_replace(".","",$per_item); 
	$nominal = $_POST['nominal'];
	$nominal = str_replace(".","",$nominal); 
   	$insert = "INSERT into t_pengeluaran_temp(KODE_PENGELUARAN,PER_ITEM,BANYAKNYA,KATEGORI,NOTES,NOMINAL,TGL,WAKTU,OLEH,KETERANGAN) VALUES('$kode_tr','$per_item','$banyaknya','$keperluan','$notes','$nominal','$tgl','$waktu_skg2','$oleh','$keterangan')";
   	mysqli_query($koneksi, $insert);
   	mysqli_close($koneksi);   
?>