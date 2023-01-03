<?php
	include 'koneksi.php';
	session_start();
	date_default_timezone_set('Asia/Hong_Kong');
	$kode_trx = $_GET["kode_transaksi"];
	$waktu_skg2 = date("d/m/Y h:i:s a");
	$tgl = date("Y/m/d");
	$oleh = $_SESSION['username'];
	$keterangan = "ditambah oleh ".$oleh." pada tgl dan jam ".$waktu_skg2;
	 error_reporting(0);			
			if($_SESSION['status']!="login"){
				echo "<script>alert('Anda belum login.....');window.location.href='index?pesan=belum_login';</script>";                    
			}
			 else if ($_SESSION['level']!="OWNER" AND $_SESSION['level']!="WAREHOUSE" AND $_SESSION['level']!="OWNER"){
				echo "<script>alert('Anda tidak memiliki akses.....');window.location.href='javascript:history.go(-1)';</script>";		
			}
			else{
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


	$sql = mysqli_query($koneksi, "select * from t_stok_keluar_retur WHERE KODE_TRANSAKSI_AUTO='$kode_trx'");
		while ($data = mysqli_fetch_array($sql)) {
			$kode_barang  = $data["KODE_BARANG"];
			$kuantitas  = $data["QTY"];
			$jenis_barang  = $data["JENIS_BARANG"];
			$kategori  = $data["KODE_TRANSAKSI"];
			$terima  = $data["OLEH2"];
			$warna  = $data["WARNA"];
			$sizee  = $data["SIZE_"];			
			
			$query_ins="INSERT INTO t_stok_masuk(KODE_TRANSAKSI,TERIMA_DARI,KATEGORI,KODE_BARANG,JENIS_BARANG,TGL,WAKTU,KETERANGAN,OLEH,QTY,WARNA,SIZE_)VALUES('$kode_masuk','$terima','$kategori','$kode_barang','$jenis_barang','$tgl','$waktu_skg2','$keterangan','$oleh','$kuantitas','$warna','$sizee')";
			if (mysqli_query($koneksi, $query_ins)) {				
			}		
			$stok = mysqli_query($koneksi, "SELECT QTY FROM t_stok WHERE KODE_BARANG='$kode_barang'");
				while ($data2 = mysqli_fetch_array($stok)) {
					$stok2 = $data2["QTY"];
				}
				$sisa_stok = (int) $stok2 + (int) $kuantitas;
				$queryupd  = "UPDATE t_stok SET QTY=" . $sisa_stok . " WHERE KODE_BARANG='$kode_barang'";
				if (mysqli_query($koneksi, $queryupd)) {
				}
			
		}
		$sql2 = "DELETE FROM t_stok_keluar_retur where KODE_TRANSAKSI_AUTO='" . $kode_trx . "'";
		if (mysqli_query($koneksi, $sql2)) {
			echo "<script>alert('data barang kembali ke stok');window.location.href='javascript:history.go(-1)';</script>";
		} else {
			echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
		}

	}
?>