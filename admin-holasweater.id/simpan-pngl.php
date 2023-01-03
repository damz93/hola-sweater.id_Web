<?php
	error_reporting(0);
	include 'koneksi.php';
	session_start();
	$payment         = $_POST['payment'];
	$devisix      = $_POST['devisix'];
	$norek = $_POST['norek'];	
	$permintaan = $_POST['permintaan'];	
	$sql = mysqli_query($koneksi, "select * from t_pengeluaran_temp");
	while ($data = mysqli_fetch_array($sql)) {		
		$kod_pen             = $data['KODE_PENGELUARAN'];
		$keperluan           = $data['KATEGORI'];
		$notes            = $data['NOTES'];
		$per_item      = $data['PER_ITEM'];
		$banyakx     = $data['BANYAKNYA'];
		$nominal    = $data['NOMINAL'];
		$tgl           = $data['TGL'];
		$waktu           = $data['WAKTU'];
		$oleh          = $data['OLEH'];
		$ketern         = $data['KETERANGAN'];
		$query           = "INSERT INTO t_pengeluaran(PERMINTAAN,KODE_PENGELUARAN,KATEGORI,DIVISI,NOTES,PER_ITEM,BANYAKNYA,NOMINAL,PAYMENT,NOREK,TGL,WAKTU,OLEH,KETERANGAN)VALUES('$permintaan','$kod_pen','$keperluan','$devisix','$notes','$per_item','$banyakx','$nominal','$payment','$norek','$tgl','$waktu','$oleh','$ketern')";
		if (mysqli_query($koneksi, $query)) {					
		}		
	}
	$sql2 = "DELETE FROM t_pengeluaran_temp";
	if (mysqli_query($koneksi, $sql2)) {
		echo "<script>alert('data tersimpan');window.location.href='input-pengeluaran';</script>";
	}
	else {
		echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
	}
?>