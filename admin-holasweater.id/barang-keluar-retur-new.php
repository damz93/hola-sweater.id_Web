 <?php
	session_start();	
	include 'koneksi.php';
	$kode_transaksi = $_GET['kode_transaksi'];
	$waktu = date("d/m/Y h:i:s a");
	$oleh = $_SESSION['username'];
	$tgl = date("Y/m/d");
	$keterangan = "ditambahkan oleh ".$oleh." pada tgl dan jam ".$waktu;
	if($_SESSION['status']!="login"){
		echo "<script>alert('Anda belum login.....');window.location.href='index?pesan=belum_login';</script>";                    
	}
	else if ($_SESSION['level']!="OWNER" AND $_SESSION['level']!="WAREHOUSE" AND $_SESSION['level']!="OWNER"){
		echo "<script>alert('Anda tidak memiliki akses.....');window.location.href='javascript:history.go(-1)';</script>";
	}
	else{
		$sql = mysqli_query($koneksi, "select * from t_stok_keluar WHERE KODE_TRANSAKSI_AUTO='" . $kode_transaksi . "'");	
		while ($data = mysqli_fetch_array($sql)) {
				$kode_barang  = $data['KODE_BARANG'];
				$detail = $data['KODE_TRANSAKSI'];
				$jenis_barang = $data['JENIS_BARANG'];
				$sizee        = $data['SIZE_'];
				$warna        = $data['WARNA'];
				$kuantitas    = $data['QTY'];
				$pelanggan    = $data['PELANGGAN'];
				$olehh  = $data['OLEH2'];							
					
			$query = "INSERT INTO t_stok_keluar_retur(OLEH2,PELANGGAN,KODE_TRANSAKSI_AUTO,KODE_TRANSAKSI,KODE_BARANG,JENIS_BARANG,SIZE_,WARNA,QTY,TGL,WAKTU,OLEH,KETERANGAN)VALUES('$olehh','$pelanggan','$kode_transaksi','$detail','$kode_barang','$jenis_barang','$sizee','$warna','$kuantitas','$tgl','$waktu','$oleh','$keterangan')";	
				
				if (mysqli_query($koneksi, $query)) {	
				}				
		}	
		$sql2 = "DELETE FROM t_stok_keluar where KODE_TRANSAKSI_AUTO='" . $kode_transaksi . "'";
		if (mysqli_query($koneksi, $sql2)) {
			echo "<script>alert('data tersimpan');window.location.href='barang-keluar-new';</script>";
		} else {
			echo "Error: " . $sql2 . "<br>" . mysqli_error($koneksi);
		}
	}
?>