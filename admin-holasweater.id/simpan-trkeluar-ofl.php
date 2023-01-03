<?php
	include 'koneksi.php';
	session_start();
	date_default_timezone_set('Asia/Hong_Kong');
	$olehh = $_POST['oleh_ofl'];	
	$detail = "-";
	$olehyy        = $_SESSION['username'];	
		
			$data_tr = mysqli_query($koneksi,"SELECT ID,KODE_TRANSAKSI_AUTO FROM t_stok_keluar ORDER BY ID DESC LIMIT 1");
		
			 while($d = mysqli_fetch_array($data_tr)){
				//$jumtranskX        = $d['ID'];				
				$jumtranskX        = substr($d['KODE_TRANSAKSI_AUTO'],6);		
			 }
			     
			     if ($jumtranskX == 0) {
			     	$kode_pengeluaran = "OUTS-0000000001";
			     }
			     else{
			     	$jumtranskX++;
				if (strlen($jumtranskX)== 1){
			     		$kode_pengeluaran = "OUTS-000000000".$jumtranskX;
			     	}
			     	else if (strlen($jumtranskX)== 2){
			     		$kode_pengeluaran = "OUTS-00000000".$jumtranskX;
			     	}
			     	else if (strlen($jumtranskX)== 3){
			     		$kode_pengeluaran = "OUTS-0000000".$jumtranskX;
			     	}
			     	else if (strlen($jumtranskX)== 4){
			     		$kode_pengeluaran = "OUTS-000000".$jumtranskX;
			     	}
			     	else if (strlen($jumtranskX)== 5){
			     		$kode_pengeluaran = "OUTS-00000".$jumtranskX;
			     	}
			     	else if (strlen($jumtranskX)== 6){
			     		$kode_pengeluaran = "OUTS-0000".$jumtranskX;
			     	}
			     	else if (strlen($jumtranskX)== 7){
			     		$kode_pengeluaran = "OUTS-000".$jumtranskX;
			     	}
			     	else if (strlen($jumtranskX)== 8){
			     		$kode_pengeluaran = "OUTS-00".$jumtranskX;
			     	}
			     	else if (strlen($jumtranskX)== 9){
			     		$kode_pengeluaran = "OUTS-0".$jumtranskX;
			     	}
			     	else if (strlen($jumtranskX)== 10){
			     		$kode_pengeluaran = "OUTS-".$jumtranskX;
			     	}
			     }


	$sql = mysqli_query($koneksi, "select * from t_stok_keluar_temp WHERE OLEH='" . $olehyy . "'");	
	while ($data = mysqli_fetch_array($sql)) {
			//$kode_penjualan2 = $kode_penjualan;
			$tgl             = $data['TGL'];
			$waktu           = $data['WAKTU'];			
			$oleh         = $data['OLEH'];
			$keterangan   = $data['KETERANGAN'];
			$kode_barang  = $data['KODE_BARANG'];
			$jenis_barang = $data['JENIS_BARANG'];
			$sizee        = $data['SIZE_'];
			$warna        = $data['WARNA'];
			$kuantitas    = $data['QTY'];
			$pelanggan    = $data['PELANGGAN'];
			
				$query = "INSERT INTO t_stok_keluar(OLEH2,PELANGGAN,KODE_TRANSAKSI_AUTO,KODE_TRANSAKSI,KODE_BARANG,JENIS_BARANG,SIZE_,WARNA,QTY,TGL,WAKTU,OLEH,KETERANGAN)VALUES('$olehh','$pelanggan','$kode_pengeluaran','$detail','$kode_barang','$jenis_barang','$sizee','$warna','$kuantitas','$tgl','$waktu','$oleh','$keterangan')";
			if (mysqli_query($koneksi, $query)) {	
			}
			$stok = mysqli_query($koneksi, "SELECT QTY FROM t_stok WHERE KODE_BARANG='" . $kode_barang . "'");
			while ($data2 = mysqli_fetch_array($stok)) {
				$stok2 = $data2['QTY'];
			}
			$sisa_stok = (int) $stok2 - (int) $kuantitas;
			$queryupd  = "UPDATE t_stok SET QTY=" . $sisa_stok . " WHERE KODE_BARANG='" . $kode_barang . "'";
			if (mysqli_query($koneksi, $queryupd)) {
				
			}						
	}	
	$sql2 = "DELETE FROM t_stok_keluar_temp where OLEH='" . $olehyy . "'";
	if (mysqli_query($koneksi, $sql2)) {
		echo "<script>alert('data tersimpan');window.location.href='barang-keluar-new';</script>";
	} else {
		echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
	}
?>