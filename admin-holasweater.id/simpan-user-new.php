<?php
include 'koneksi.php';
date_default_timezone_set('Asia/Hong_Kong');
session_start();
// menyimpan data kedalam variabel
$waktu_skg2 = date("d/m/Y h:i:s a");
$waktu_skg = date("Y/m/d");
$oleh = $_SESSION['username'];
$ketern = "ditambahkan oleh ".$oleh." pada tgl dan jam ".$waktu_skg2;

$user_id = $_POST['user_id'];
$nama_lengkap = $_POST['nama_lengkap'];
$nicname = $_POST['nicname'];
$tgl_lahir = $_POST['tgl_lahir'];
$wassap = $_POST['wassap'];
$alamat = $_POST['alamat'];
$jabatan = $_POST['jabatan'];
$password = $_POST['password'];
// query SQL untuk insert data
$query="INSERT INTO t_user(NICKNM,TGL_LAHIR,WA_,ALAMAT,AKTIF,USERNAME,NAMA,PASSWORD,TGL,KETERANGAN,WAKTU,OLEH,LEVEL)VALUES('$nicname','$tgl_lahir','$wassap','$alamat','YA','$user_id','$nama_lengkap','$password','$waktu_skg','$ketern','$waktu_skg2','$oleh','$jabatan')";
//mysqli_query($koneksi,$query);
	$cekdulu= "select * from t_user where USERNAME='$username'";
	$prosescek= mysqli_query($koneksi, $cekdulu);
	if (mysqli_num_rows($prosescek)>0) {    
		echo "<script>alert('Username sudah ada.');window.location.href='javascript:history.go(-1)';</script>";
	}
	else {
		if (mysqli_query($koneksi, $query)) {
			echo "<script>alert('data tersimpan');window.location.href='javascript:history.go(-1)';</script>";		
		} else {
			echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
		}
	}
?>