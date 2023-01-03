<?php
	include 'koneksi.php';
	date_default_timezone_set('Asia/Hong_Kong');
	session_start();
	// menyimpan data kedalam variabel
	$waktu_skg2  = date("d/m/Y h:i:s");
	$tgl         = date("Y/m/d");
	$oleh        = $_SESSION['username'];
	$keterangan  = "ditambah oleh " . $oleh . " pada tgl dan jam " . $waktu_skg2;
	$nama_barang = $_POST['nama_barangz'];
	$jummaskel   = $_POST['maskelz'];
	$jummaskel   = str_replace(".", "", $jummaskel);
	$kode_log    = $_POST['kode_log_inv'];
	$jenis       = $_POST['jenisx_inv'];
	$sumber      = $_POST['sumberz'];

	$selectbarang = mysqli_query($koneksi, "select * from t_inventory where NAMA_BARANG='$nama_barang'");
	while ($d = mysqli_fetch_array($selectbarang)) {
		$kode_barang = $d['KODE_BARANG'];
		$spesifikasi = $d['SPESIFIKASI'];
		$satuan      = $d['SATUAN'];
		$qtyskg      = $d['QTY'];
	}
	if ($jenis == 'Barang Masuk') {
		$qtytotal = (int) $qtyskg + (int) $jummaskel;
	} else if ($jenis == 'Barang Keluar') {
		$qtytotal = (int) $qtyskg - (int) $jummaskel;
	}
	$queryupd = "UPDATE t_inventory SET QTY=" . $qtytotal . ",TGL='$tgl' WHERE NAMA_BARANG='$nama_barang'";
	if (mysqli_query($koneksi, $queryupd)) {
		
	}


	// query SQL untuk insert data
	$query = "INSERT INTO t_log_inventory(KODE_LOG,KODE_BARANG,NAMA_BARANG,SPESIFIKASI,SATUAN,QTY,INFO,SUMBER,TGL,WAKTU,KETERANGAN,OLEH)VALUES('$kode_log','$kode_barang','$nama_barang','$spesifikasi','$satuan','$jummaskel','$jenis','$sumber','$tgl','$waktu_skg2','$keterangan','$oleh')";
	if (mysqli_query($koneksi, $query)) {
		echo "<script>alert('data tersimpan');window.location.href='form-log-inventory.php';</script>";
	} else {
		echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
	}

?>