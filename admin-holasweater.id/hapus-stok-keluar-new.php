<?php
	include "koneksi.php";
	session_start();
	date_default_timezone_set("Asia/Hong_Kong");
	$kode_trx = $_GET["kode_transaksi"];

	if ($_SESSION["status"] != "login") {
		echo "<script>alert('Anda belum login.....');window.location.href='index?pesan=belum_login';</script>";
	} elseif ($_SESSION["level"] != "OWNER" and $_SESSION["level"] != "OWNER" and $_SESSION["level"] != "OWNER") {
		echo "<script>alert('Anda tidak memiliki akses.....');window.location.href='javascript:history.go(-1)';</script>";
	}
	else{
		$sql = mysqli_query($koneksi, "select * from t_stok_keluar_retur WHERE KODE_TRANSAKSI_AUTO='$kode_trx'");
		while ($data = mysqli_fetch_array($sql)) {
			$tgl          = $data["TGL"];
			$waktu        = $data["WAKTU"];
			$oleh         = $data["OLEH"];
			$keterangan   = $data["KETERANGAN"];
			$kode_barang  = $data["KODE_BARANG"];
			$kuantitas  = $data["QTY"];
			
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
			echo "<script>alert('data terhapus dan stok kembali');window.location.href='javascript:history.go(-1)';</script>";
		} else {
			echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
		}
	}
?>