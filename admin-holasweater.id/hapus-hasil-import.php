<?php
	include "koneksi.php";		
	session_start();		   		   		  
	if ($_SESSION['status']!="login") {
		echo "<script>alert('Anda belum login.....');window.location.href='index.php?pesan=belum_login';</script>";
	}
	else if(($_SESSION['level']!="OWNER")AND($_SESSION['level']!="OWNER")) {
		echo "<script>alert('Anda tidak memiliki akses.....');window.location.href='javascript:history.go(-1)';</script>";
	}
	else {
		$hapus_excel = mysqli_query($koneksi,"DELETE FROM t_stok_excel");
		if ($hapus_excel) {			
			
			$selamat = 'Sukses menghapus hasil import...';
			echo "<script>alert('".$selamat."');window.location.href='barang-masuk-new2';</script>";
		}
		else{
			echo mysql_error();
		}		  
	}	   
?>