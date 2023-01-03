<?php
	include "koneksi.php";
	include "excel_reader2.php";
	//require('spreadsheet-reader-master/php-excel-reader/excel_reader2.php');
	require "spreadsheet-reader-master/SpreadsheetReader.php";
	$all_kode_barang = '';	
	date_default_timezone_set('Asia/Hong_Kong');
	session_start();
	$target = basename($_FILES["berkas_massal"]["name"]);
	move_uploaded_file($_FILES["berkas_massal"]["tmp_name"], $target);

	$Reader = new SpreadsheetReader($target);

	// beri permisi agar file xls dapat di baca
	chmod($_FILES["berkas_massal"]["name"], 0777);


		$data_tr = mysqli_query($koneksi,"SELECT ID,KODE_TRANSAKSI FROM t_stok_masuk ORDER BY ID DESC LIMIT 1");
			 while($d = mysqli_fetch_array($data_tr)){
				//$jumtranskX        = $d['ID'];				
				$jumtranskX        = substr($d['KODE_TRANSAKSI'],5);		
			 }
			     
			     if ($jumtranskX == 0) {
			     	$kode_masuk = "INS-0000000001";
			     }
			     else{
			     	$jumtranskX++;
				if (strlen($jumtranskX)== 1){
			     		$kode_masuk = "INS-000000000".$jumtranskX;
			     	}
			     	else if (strlen($jumtranskX)== 2){
			     		$kode_masuk = "INS-00000000".$jumtranskX;
			     	}
			     	else if (strlen($jumtranskX)== 3){
			     		$kode_masuk = "INS-0000000".$jumtranskX;
			     	}
			     	else if (strlen($jumtranskX)== 4){
			     		$kode_masuk = "INS-000000".$jumtranskX;
			     	}
			     	else if (strlen($jumtranskX)== 5){
			     		$kode_masuk = "INS-00000".$jumtranskX;
			     	}
			     	else if (strlen($jumtranskX)== 6){
			     		$kode_masuk = "INS-0000".$jumtranskX;
			     	}
			     	else if (strlen($jumtranskX)== 7){
			     		$kode_masuk = "INS-000".$jumtranskX;
			     	}
			     	else if (strlen($jumtranskX)== 8){
			     		$kode_masuk = "INS-00".$jumtranskX;
			     	}
			     	else if (strlen($jumtranskX)== 9){
			     		$kode_masuk = "INS-0".$jumtranskX;
			     	}
			     	else if (strlen($jumtranskX)== 10){
			     		$kode_masuk = "INS-".$jumtranskX;
			     	}
			     }

	// mengambil isi file xls
	$berhasil = 0;
	mysqli_query($koneksi, "DELETE FROM t_stok_excel");
	foreach ($Reader as $Key => $Row) {
		// import data excel mulai baris ke-2 (karena ada header pada baris 1)
		if ($Key < 1) {
			continue;
		}
		$query = mysqli_query(
			$koneksi,
			"INSERT into t_stok_excel(KODE_BARANG,JENIS_BARANG,WARNA,SIZE_,QTY,HARGA,NOTES)values('" .$Row[0] ."','" .$Row[1] ."','" .$Row[2] ."','" .$Row[3] ."','" .$Row[4] ."','" .$Row[5] ."','" .$Row[6] ."')"
		);
		$berhasil++;
	}
	if ($query) {
		date_default_timezone_set('Asia/Hong_Kong');
		//session_start();
		$waktu_skg2 = date("d/m/Y h:i:s a");
		$waktu_skg = date("Y/m/d");
		$oleh = $_SESSION['username'];
		
		$data_excel = mysqli_query($koneksi, "select * from t_stok_excel");
		while ($d = mysqli_fetch_array($data_excel)) {
			$kode_barang = $d["KODE_BARANG"];
			$jenis_barang = $d["JENIS_BARANG"];
			$warna = $d["WARNA"];
			$size = $d["SIZE_"];
			$qty = $d["QTY"];
			$notes = $d["NOTES"];
			$harga = $d["HARGA"];
			$kategori = "UPLOAD MASSAL";
			$terima = "PRODUKSI";
			
			
			$cek_stok ="select * from t_stok where KODE_BARANG='" . $kode_barang . "'";
			$prosescek = mysqli_query($koneksi, $cek_stok);
			if (mysqli_num_rows($prosescek) > 0) {
				$olehx = "dieditt oleh ".$oleh." pada tgl dan jam ".$waktu_skg2;
				$queryupd="UPDATE t_stok SET NOTES='$notes',TGL='$waktu_skg',WAKTU='$waktu_skg2',OLEH='$oleh',KETERANGAN='$olehx',JENIS_BARANG='$jenis_barang',WARNA='$warna',SIZE_='$size',QTY='$qty',HARGA='$harga' where KODE_BARANG='$kode_barang'";
				
				if (mysqli_query($koneksi, $queryupd)) {
					$all_kode_barang = $all_kode_barang.'-'.$kode_barang.'(update)';
						mysqli_query($koneksi,"DELETE FROM t_stok WHERE KODE_BARANG=''");
						mysqli_query($koneksi,"DELETE FROM t_stok_excel WHERE KODE_BARANG=''");
				}
			} else {
				$olehx = "ditambah oleh ".$oleh." pada tgl dan jam ".$waktu_skg2;
				$querysimp="INSERT INTO t_stok(TGL,WAKTU,OLEH,KETERANGAN,JENIS_BARANG,WARNA,SIZE_,QTY,HARGA,KODE_BARANG,NOTES)VALUES('$waktu_skg','$waktu_skg2','$oleh','$olehx','$jenis_barang','$warna','$size','$qty','$harga','$kode_barang','$notes')";
				if (mysqli_query($koneksi, $querysimp)) {
					$all_kode_barang = $all_kode_barang.'-'.$kode_barang.'(tambah)';
						mysqli_query($koneksi,"DELETE FROM t_stok WHERE KODE_BARANG=''");
						mysqli_query($koneksi,"DELETE FROM t_stok_excel WHERE KODE_BARANG=''");
				}
			}
			$querysimp_hist="INSERT INTO t_stok_masuk(KODE_TRANSAKSI,TGL,WAKTU,OLEH,KETERANGAN,JENIS_BARANG,WARNA,SIZE_,QTY,HARGA,KODE_BARANG,KATEGORI,TERIMA_DARI)VALUES('$kode_masuk','$waktu_skg','$waktu_skg2','$oleh','$olehx','$jenis_barang','$warna','$size','$qty','$harga','$kode_barang','$kategori','$terima')";
				if (mysqli_query($koneksi, $querysimp_hist)) {
				}
		}
		
		$oleh = $_SESSION['username'];
		$keterangan = $oleh." - UPLOAD STOK >>".$all_kode_barang;
		$queryx="INSERT INTO tbl_log(TANDA,KETERANGAN,OLEH)VALUES('UPLOAD','$keterangan','$oleh')";
		if (mysqli_query($koneksi, $queryx)) {			
		}
		$selamat = "Data terupload (" . $berhasil . " data)";
		echo "<script>alert('" .
			$selamat .
			"');window.location.href='javascript:history.go(-1)';</script>";
	} else {
		echo mysql_error();
	}
?>