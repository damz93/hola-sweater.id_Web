<?php
	error_reporting(0);
	include 'koneksi.php';
	session_start();
	$ongkir         = $_POST['ongkir'];
	$ongkir = str_replace(".","",$ongkir); 
	$nama         = $_POST['nacost'];
	$waa         = $_POST['wacost'];
	$alamat         = $_POST['alcost'];
	$payment         = $_POST['payment'];
	$norek = $_POST['norek'];	
	$kategr = $_POST['kategori'];	
	$sql = mysqli_query($koneksi, "select * from t_reseller_temp");
	while ($data = mysqli_fetch_array($sql)) {		
		$kode_tr             = $data['KODE_TRANSAKSI'];
		$desk           = $data['DESKRIPSI'];
		$jen_bar            = $data['JENIS_BARANG'];
		$per_item      = $data['PER_ITEM'];
		$banyakx     = $data['BANYAKNYA'];
		$nominal    = $data['TOTAL'];
		$tgl           = $data['TGL'];
		$waktu           = $data['WAKTU'];
		$oleh          = $data['OLEH'];
		$ketern         = $data['KETERANGAN'];
		$query           = "INSERT INTO t_reseller(COSTUMER,WA,ALAMAT,ONGKIR,KODE_TRANSAKSI,DESKRIPSI,JENIS_BARANG,PER_ITEM,BANYAKNYA,TOTAL,PAYMENT,NOREK,KATEGORI,TGL,WAKTU,OLEH,KETERANGAN)VALUES('$nama','$waa','$alamat','$ongkir','$kode_tr','$desk','$jen_bar','$per_item','$banyakx','$nominal','$payment','$norek','$kategr','$tgl','$waktu','$oleh','$ketern')";
		if (mysqli_query($koneksi, $query)) {					
		}		
	}
	$sql2 = "DELETE FROM t_reseller_temp";
	if (mysqli_query($koneksi, $sql2)) {
		echo "<script>alert('data tersimpan');window.location.href='input-reseller';</script>";
	}
	else {
		echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
	}
?>