<?php
	include 'koneksi.php';
	date_default_timezone_set('Asia/Hong_Kong');
	session_start();
	// menyimpan data kedalam variabel
	$waktu_skg2 = date("d/m/Y h:i:s a");
	$waktu_skg = date("Y/m/d");
	$oleh = $_SESSION['username'];
	$ketern = "ditambahkan oleh ".$oleh." pada tgl dan jam ".$waktu_skg2;

	$target = $_POST['TARGET'];
	$target = str_replace(".","",$target); 
	$kata = $_POST['KATA'];

	$query="INSERT INTO t_home(TARGET,KATA,TGL,KETERANGAN,WAKTU,OLEH)VALUES('$target','$kata','$waktu_skg','$ketern','$waktu_skg2','$oleh')";
		if($_SESSION['status']!="login"){
			echo "<script>alert('Anda belum login.....');window.location.href='index?pesan=belum_login';</script>";                    
		}
		else if ($_SESSION['level']!="OWNER" AND $_SESSION['level']!="OWNER" AND $_SESSION['level']!="OWNER"){
			echo "<script>alert('Anda tidak memiliki akses.....');window.location.href='javascript:history.go(-1)';</script>";
		}
		else{
			if (mysqli_query($koneksi, $query)) {
				echo "<script>alert('data tersimpan');window.location.href='javascript:history.go(-1)';</script>";		
			} else {
				echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
			}	
		}
?>