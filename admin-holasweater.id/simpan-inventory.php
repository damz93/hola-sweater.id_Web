<?php
	include 'koneksi.php';
	date_default_timezone_set('Asia/Hong_Kong');
	session_start();
	// menyimpan data kedalam variabel
	$waktu_skg2 = date("d/m/Y h:i:s");
	$tgl = date("Y/m/d");
	$oleh = $_SESSION['username'];
	$keterangan = "ditambah oleh ".$oleh." pada tgl dan jam ".$waktu_skg2;
	$kode_barang = $_POST['KODE_BARANG'];
	$nama_barang = $_POST['NAMA_BARANG'];
	$spesf = $_POST['SPESIFIKASI'];
	$satuan = $_POST['SATUAN'];
	$qty = $_POST['QTY'];
	$qty = str_replace(".","",$qty);
	// query SQL untuk insert data
	$query="INSERT INTO t_inventory(KODE_BARANG,NAMA_BARANG,TGL,WAKTU,KETERANGAN,OLEH,QTY,SPESIFIKASI,SATUAN)VALUES('$kode_barang','$nama_barang','$tgl','$waktu_skg2','$keterangan','$oleh','$qty','$spesf','$satuan')";
	//mysqli_query($koneksi,$query);
	$cekdulu= "select * from t_inventory where KODE_BARANG='$kode_barang'";
	$cekdulu2= "select * from t_inventory where NAMA='$nama_barang'";
	$prosescek= mysqli_query($koneksi, $cekdulu);
	$prosescek2= mysqli_query($koneksi, $cekdulu2);
	if (mysqli_num_rows($prosescek)>0) {
		//echo "<script>alert('Kode Barang sudah ada.');history.go(-1) </script>";
		echo "<script>alert('Kode Barang sudah ada.');history.go(-1) </script>";
	}
	else if (mysqli_num_rows($prosescek2)>0) {
		echo "<script>alert('Nama Barang sudah ada.');history.go(-1) </script>";		
	}
	else {
		if (mysqli_query($koneksi, $query)) {
			echo "<script>alert('data tersimpan');window.location.href='form-inventory.php';</script>";
		} else {
			echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
		}
	}
?>