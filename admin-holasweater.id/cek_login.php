<?php 
	//error_reporting(0);
   // mengaktifkan session php
   session_start();
   
   // menghubungkan dengan koneksi
   include 'koneksi.php';
   
   // menangkap data yang dikirim dari form
   $username = $_POST['username'];
   $password = $_POST['password'];
   $level = $_POST['level'];
   $lev = $level;
   
   // menyeleksi data admin dengan username dan password yang sesuai
   $data = mysqli_query($koneksi,"SELECT * FROM t_user WHERE USERNAME = '$username' and PASSWORD = '$password'");
   $data2 = mysqli_query($koneksi,"SELECT * FROM t_user WHERE USERNAME = '$username' and PASSWORD = '$password' and AKTIF='Ya' and LEVEL='$level'");
   
   
   while($d = mysqli_fetch_array($data2)){
	   $nama_lengk = $d['NAMA'];
	   
   }
   
   // menghitung jumlah data yang ditemukan
   $cek = mysqli_num_rows($data);
   $cek2 = mysqli_num_rows($data2);
   
   if (empty($username)||(empty($password))){
   	echo "<script>alert('Username dan Password harus diisi');window.location.href='index.php?pesan=gagal';</script>";
   }
   else{
   	if($cek > 0){
   	    if ($cek2 > 0) {
   		    $_SESSION['username'] = $username;   		    
   		    $_SESSION['level'] = $level;   		    
			$_SESSION['nama_lengkap'] = $nama_lengk;   		
   		    $_SESSION['status'] = "login";
			if ($lev == "ADMIN") {
				$welcome = "Selamat datang ".$username."(Admin)";					
				echo "<script>alert('".$welcome."');window.location.href='menu-utama';</script>";
			}
			else if ($lev == "ACCOUNTING") {
				$welcome = "Selamat datang ".$username."(Accounting)";
				echo "<script>alert('".$welcome."');window.location.href='menu-utama';</script>";
			}
			else if ($lev == "OFFLINE STORE") {
				$welcome = "Selamat datang ".$username."(Offline Store)";
				echo "<script>alert('".$welcome."');window.location.href='menu-utama';</script>";
			}
			else if ($lev == "ONLINE STORE") {
				$welcome = "Selamat datang ".$username."(Online Store)";
				echo "<script>alert('".$welcome."');window.location.href='menu-utama';</script>";
			}
			else if ($lev == "WAREHOUSE") {
				$welcome = "Selamat datang ".$username."(Warehouse)";
				echo "<script>alert('".$welcome."');window.location.href='menu-utama';</script>";
			}
			else if ($lev == "WEB DEVELOPER") {
				$welcome = "Selamat datang ".$username."(Web Developer)";
				echo "<script>alert('".$welcome."');window.location.href='menu-utama';</script>";
			}
			else if ($lev == "OWNER") {
				$welcome = "Selamat datang ".$username."(CEO)"; 					
				echo "<script>alert('".$welcome."');window.location.href='menu-utama';</script>";
			}
			else if ($lev == "STAFF") {
				$welcome = "Selamat datang ".$username."(Staff)"; 					
				echo "<script>alert('".$welcome."');window.location.href='menu-utama';</script>";
			}
			else if ($lev == "PURCHASING") {
				$welcome = "Selamat datang ".$username."(Purchasing)"; 					
				echo "<script>alert('".$welcome."');window.location.href='menu-utama';</script>";
			}
   	    }
   	    else{
   	        echo "<script>alert('Maaf, Anda tidak punya akses...');window.location.href='index?pesan=gagal';</script>";
   	    }
   	
   	}else{
   		echo "<script>alert('Username dan Password Salah...');window.location.href='index?pesan=gagal';</script>";
   	}
   }
?>