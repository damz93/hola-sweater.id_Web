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
	$jenis_barang = $_POST['JENIS_BARANG'];
	$sizee = $_POST['SIZE'];
	$keternnn = $_POST['KETERANGAN'];
	$warna = $_POST['WARNA'];
	$qty = $_POST['QTY'];
	$qty = str_replace(".","",$qty);
	$harga = $_POST['HARGA'];
	$harga = str_replace(".","",$harga);
	// query SQL untuk insert data
	$query="INSERT INTO t_stok(NOTES,KODE_BARANG,JENIS_BARANG,TGL,WAKTU,KETERANGAN,OLEH,QTY,WARNA,SIZE_,HARGA)VALUES('$keternnn','$kode_barang','$jenis_barang','$tgl','$waktu_skg2','$keterangan','$oleh','$qty','$warna','$sizee','$harga')";
	//mysqli_query($koneksi,$query);
	$cekdulu= "select * from t_stok where KODE_BARANG='$kode_barang'";
	$prosescek= mysqli_query($koneksi, $cekdulu);
	if (mysqli_num_rows($prosescek)>0) {
		//echo "<script>alert('Kode Barang sudah ada.');history.go(-1) </script>";
		echo "<script>alert('Kode Barang sudah ada.');history.go(-1) </script>";
	}
	else {
		if (mysqli_query($koneksi, $query)) {
			echo "<script>alert('data tersimpan');window.location.href='form-stok.php';</script>";
		} else {
			echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
		}
	}
?>