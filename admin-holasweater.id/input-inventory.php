<?php
	include 'koneksi.php';
	?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Tambah Inventory - S W E A T E R I N . M E</title>
		<link rel="shortcut icon" href="img/tokonline.png">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/freelancer.min.css">
		<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
		<script data-ad-client="ca-pub-5256228815542923" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		<style>
			body, html {
			height: 100%;
			margin: 0;
			}
			.bg {
			/* The image used */
			background-image: url("img/bg_.png");
			/* Full height */
			height: 100%; 
			/* Center and scale the image nicely */
			background-position: center;
			background-repeat: no-repeat;
			background-size: cover;
			}
		</style>
	</head>
	<body>
		<div class="bg">
		<?php 	  
			error_reporting(0);
			    session_start();					
			    if($_SESSION['status']!="login"){
			    	echo "<script>alert('Anda belum login.....');window.location.href='index.php?pesan=belum_login';</script>";                    
			    }
			else if ($_SESSION['level']!="OWNER" AND $_SESSION['level']!="SPV GUDANG" AND $_SESSION['level']!="GUDANG"){
				echo "<script>alert('Anda tidak memiliki akses.....');window.location.href='javascript:history.go(-1)';</script>";
			}
			?>
		<h1 align='center' style="background-color:#71b8e4;color:#FFFFFe">TAMBAH INVENTORY</h1>
		<h3 align='center' style="background-color:#1d7bb6;color:#FFFFee">- S W E A T E R I N . M E -</h3>
		<div class='container'>
			<a style="background-color:#71b8e4;color:#FFFFFe" href="form-inventory"> [ Kembali ke Data Inventory ]</a><br>
			<br>
			<form method="post" action="simpan-inventory.php" onsubmit="return confirm('Yakin ingin simpan?');">
				<div class="table-responsive">
					<table class="table" border="0" cellpadding="2" cellspacing="2" align=center>
						<tr>
							<th>Kode Barang</th>
							<th><input class="form-control form-control-sm" placeholder="KODE BARANG" maxlength="30" type="text" name="KODE_BARANG" id="KODE_BARANG" autofocus></th>
						</tr>
						<tr>
							<th>Nama Barang</th>
							<th><input class="form-control form-control-sm" placeholder="NAMA BARANG" maxlength="30" type="text" name="NAMA_BARANG"></th>
						</tr>
						<tr>
							<th>Spesifikasi</th>
							<th><input class="form-control form-control-sm" placeholder="WARNA, UKURAN DLL" maxlength="20" type="text" name="SPESIFIKASI"></th>
						</tr>
						<tr>
							<th>Satuan</th>
							<th><input class="form-control form-control-sm" placeholder="PCS, PACK DLL" maxlength="30" type="text" name="SATUAN"></th>
						</tr>
						<tr>
							<th>Qty</th>
							<th><input placeholder="0" maxlength="30" type="text" onkeyup="inputTerbilang();" class="form-control form-control-sm mata-uang" name="QTY"></th>
						</tr>
						<tr align='center'>
							<br>
							<th><button type="submit" value="simpan" class="btn btn-info btn-lg btn-block">Simpan</button></th>
							<td><button onclick="autofocuss()" type="reset" class="btn btn-danger btn-lg btn-block">Batal</button>
								</th>
						</tr>
					</table>
				</div>
			</form>
			<script src="js/jquery-1.11.2.min.js"></script>
			<script src="js/jquery.mask.min.js"></script>
			<script src="js/terbilang.js"></script>
			<script>
				function autofocuss() {
					document.getElementById("KODE_BARANG").focus();
				}
				 
			</script>
			<script>
				function inputTerbilang() {
				  //membuat inputan otomatis jadi mata uang
				  $('.mata-uang').mask('0.000.000.000', {reverse: true});
				
				  //mengambil data uang yang akan dirubah jadi terbilang
				   var input = document.getElementById("terbilang-input").value.replace(/\./g, "");
				
				   //menampilkan hasil dari terbilang
				   document.getElementById("terbilang-output").value = terbilang(input).replace(/  +/g, ' ');
				} 
			</script>			
		</div>
	</body>
</html>