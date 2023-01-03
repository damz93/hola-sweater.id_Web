<?php
	session_start();		
	if($_SESSION['status']!="login"){
		echo "<script>alert('Anda belum login.....');window.location.href='index?pesan=belum_login';</script>";                    
	}			
	else{
		$username = $_SESSION['username'];
		$tgl_hari_inii = date('Y-m-d');
		//$tgl_lengk = date('l, d-m-Y');
		$tgl_lengk =  date('l, d F Y');
		$tahun = date('Y');
		$bulan = date('m');
	}
	?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="css/journ_bootstrap.min.css">
		<title>LAPORAN - HOLASWEATER.ID</title>
		<link rel="shortcut icon" href="img/hola_ic.png">
		<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
		<script src="js/bootstrap-datepicker.js"></script>
		
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="css/datepicker.css">
		<link rel="stylesheet" href="css/css-terpakai.css">		
		<style>
			.contentx {
			padding-top: 15px;
			padding-right: 30px;
			padding-bottom: 10px;
			padding-left: 40px;
			height: 420px;
			overflow-y: scroll;
			display: none;
			background-color: #f1f1f1;
			}
			
			
			.active, .collapsible:hover {
			background-color: #555;
			color: #284d58;
			}
			.collapsible:after {
	//		content: '\002B';
			color: #284d58;
			font-weight: bold;
			float: right;
			margin-left: 5px;
			}
			.active:after {
		//	content: "\2212";
			color: #284d58;
			}
			.collapsible {
			background-color: #d5d5d5;
			font-color: #3a3838;
			cursor: pointer;
			padding: 10px;
			width: 100%;
			text-align: right;
			border: none;
			outline: none;
			font-size: 12px;
			}
			.active, .collapsible:hover {
			background-color: #e8e8e8;
			border: none;
			outline: none;
			border-size: 0px;
			}
		</style>
	</head>
	<body>
		<div class="sidebar">
			<img align="center" style="display: block; margin: auto;height:50px;" src="http://holasweater.id/admin-holasweater.id/img/hola_trs.png" alt="logo">
			<br>
			<a class="nav-link" href="menu-utama"><b>Home</b></a>
			<a class="nav-link" href="barang-masuk-new"><b>Stok dan Barang Masuk</b></a>
			<a class="nav-link" href="barang-keluar-new"><b>Barang Keluar</b></a>
			<a class="nav-link" href="pemasukan-new"><b>Pemasukan</b></a>
			<a class="nav-link" href="pengeluaran-new"><b>Pengeluaran</b></a>
			<a class="active" href="laporan-new"><b>Summary & Report</b></a>
			<a class="nav-link" href="pengaturan-new"><b>Preferences</b></a>
			<div class="user" align="center" hidden>
				<table style="padding-bottom:30px" class="responsive" style="width:100%;" border="0" cellpadding="2" cellspacing="2" align="center">
					<tr>
						<td style="width:20%;" align="center">
							<img src="http://holasweater.id/admin-holasweater.id/img/user_.png" class="responsive" style="height:60px;display: block; margin: auto;">
						</td>
					</tr>
					<tr>
						<td align="center">
							<h5 style="color:#3a3838">
								<b><?php echo $_SESSION['nama_lengkap']; ?></b>
							</h5>
							<h6 style="color:#3a3838">
								<?php echo $_SESSION['level']; ?>
							</h6>
						</td>
					</tr>
					<tr>
						<td align="center">	<button type="button" class="btn btn-primary btn-block btn-sm"><a href="logout" style="color:#FFFFFe">Logout</button></a>
						</td>
					</tr>
				</table>
			</div>
		</div>
		<div class="content">
		 <?php
	$kode_aktifnya='';
?>	
		
		<h2 style="color:#284d58">Summary & Report</h2>
		<div class="tab">
			<button class="tablinks" id="btn_l_stok" onclick="kategori_pengeluaran(event, 'l_stok')">
			<b>Stok</b>
			<button class="tablinks" id="btn_l_pemasukan" onclick="kategori_pengeluaran(event, 'l_pemasukan')">
			<b>Pemasukan</b>		
			</button>
			<button class="tablinks" id="btn_l_pengeluaran" onclick="kategori_pengeluaran(event, 'l_pengeluaran')">
			<b>Pengeluaran</b>
			</button>
			<button class="tablinks" id="btn_l_summary" onclick="kategori_pengeluaran(event, 'l_summary')">
			<b>Summary</b>
			</button>
		</div>
		
		
		<div style="display: block;" id="l_pemasukan" class="tabcontent">
		<!--DEDY ALIM MUZAWWIR DI SINI LAPORAN Pemasukan-->
			<br>
			<h4 style="color:#284d58">Laporan Pemasukan</h3>
			<br>
			<div class="table-responsive">
			<table style="width:100%" border="0" align="left" cellpadding="0" cellspacing="0">
						<tr>
						<form action="laporan-pemasukan-new" onsubmit="return cek_dulu_dana_masuk();" method="post" autocomplete="off" target="_blank">
							<td align="left">
								<b>Tanggal Awal</b>
								<input style="width:100%" class="form-control form-control-sm datepicker" type="text" placeholder="yyyy-mm-dd"  id="id_cek_tanggal_dana_masuk1" name="cek_tanggal_dana_masuk1">
								<b>Hingga Tanggal</b>
								<input style="width:100%" class="form-control form-control-sm datepicker" type="text" placeholder="yyyy-mm-dd"  id="id_cek_tanggal_dana_masuk2" name="cek_tanggal_dana_masuk2">								
								<b>Pilih Kategori(Sumber Pemasukan)</b><br>
								<select style="color:#393939;font-weight:bold;width:100%" class="form-control form-control-sm" name="tujuan_dana_masuk" id="tujuan_dana_masuk">
									<option value="SEMUA" selected>Semua</option>
									<option value="TIKTOK SHOP">Tiktok Shop</option>
									<option value="TIKTOK SHOP AFILIATE">Tiktok Shop Afiliate</option>
									<option value="SHOPEE">Shopee</option>
									<option value="RESELLER">Reseller</option>
									<option value="OFFLINE STORE">Offline Store</option>
								</select>
								</br>
								<button align="center" style="width:100%" type="submit" class="btn btn-primary btn-sm" name="cetak_dana_masuk">Cetak </button>
							</td>
						</form>
						</tr>
			</table>
		</div>		
		</div>		
		<div style="display: block;" id="l_summary" class="tabcontent">
			<br>
			<h4 style="color:#284d58">Summary Pemasukan dan Pengeluaran</h3>
			<br><div class="table-responsive">
			<table style="width:100%" border="0" align="left" cellpadding="0" cellspacing="0">
						<tr>
						<form action="laporan-summary-new" onsubmit="return cek_dulu_summary();" method="post" autocomplete="off" target="_blank">
							<td align="left">
								<b>Tanggal Awal</b>
								<input style="width:100%" class="form-control form-control-sm datepicker" type="text" placeholder="yyyy-mm-dd"  id="id_cek_tanggal_summary1" name="cek_tanggal_summary1">
								<b>Hingga Tanggal</b>
								<input style="width:100%" class="form-control form-control-sm datepicker" type="text" placeholder="yyyy-mm-dd"  id="id_cek_tanggal_summary2" name="cek_tanggal_summary2">
								
								</br>
								<button align="center" style="width:100%" type="submit" class="btn btn-primary btn-sm" name="cetak_summary">Cetak </button>
							</td>
							
						</form>
						</tr>
			</table>
		</div>
		</div>
		<div style="display: block;" id="l_pengeluaran" class="tabcontent">
		
		<!--DEDY ALIM MUZAWWIR DI SINI LAPORAN Pengeluaran-->
			<br>
			<h4 style="color:#284d58">Laporan Pengeluaran</h3>
			<br><div class="table-responsive">
			<table style="width:100%" border="0" align="left" cellpadding="0" cellspacing="0">
						<tr>
						<form action="laporan-pengeluaran-new" onsubmit="return cek_dulu_dana_keluar();" method="post" autocomplete="off" target="_blank">
							<td align="left" style="width:100%">
								<b>Tanggal Awal</b>
								<input style="width:100%" class="form-control form-control-sm datepicker" type="text" placeholder="yyyy-mm-dd"  id="id_cek_tanggal_dana_keluar1" name="cek_tanggal_dana_keluar1">
								<b>Hingga Tanggal</b>
								<input style="width:100%" class="form-control form-control-sm datepicker" type="text" placeholder="yyyy-mm-dd"  id="id_cek_tanggal_dana_keluar2" name="cek_tanggal_dana_keluar2">								
								<b>Pilih Kategori(Divisi)</b><br>
								<select style="color:#393939;font-weight:bold;width:100%" class="form-control form-control-sm" name="tujuan_dana_keluar2" id="tujuan_dana_keluar2">
									<option value="SEMUA">Semua</option>
									<option value="OFFLINE STORE">Offline Store</option>
									<option value="MARKETING">Marketing</option>
									<option value="TIKTOK LIVE">Tiktok Live</option>
									<option value="AFILIATE">Afiliate</option>
									<option value="WAREHOUSE">Warehouse</option>
									<option value="KONVEKSI">Konveksi</option>
									<option value="PURCHASING UMUM">Puchasing UMUM</option>
								</select>
								<select hidden style="color:#393939;font-weight:bold;width:100%" class="form-control form-control-sm" name="tujuan_dana_keluar" id="tujuan_dana_keluar">
									<option value="SEMUA" selected>Semua</option>
									<option value="IKLAN DAN PEMASARAN">Iklan dan Pemasaran</option>
									<option value="GAJI/ TUNJANGAN KARYAWAN">Gaji/ Tunjangan Karyawan</option>
									<option value="BAHAN BAKU">Bahan Baku</option>
									<option value="BIAYA SEWA/ KONTRAK">Biaya Sewa/ Kontrak</option>
									<option value="PENGADAAN ALAT">Pengadaan Alat</option>
									<option value="MAINTENANCE DAN PENGEMBANGAN">Maintenance dan Pengembangan</option>
									<option value="AKOMODASI DAN PERJALANAN">Akomodasi dan Perjalanan</option>
									<option value="OPERASIONAL">Operasional</option>
								</select>
								</br>
								<button align="center" style="width:100%" type="submit" class="btn btn-primary btn-sm" name="cetak_dana_keluar">Cetak </button>
							</td>
							
						</form>
						</tr>
			</table>
		</div>		
		</div>		
		<div style="display: block;" id="l_stok" class="tabcontent">
			<!--DEDY ALIM MUZAWWIR DI SINI LAPORAN Stok-->
			<br>
			<h4 style="color:#284d58">Laporan STOK</h3>
			<br>
				<div class="table-responsive">
					<table style="width:100%" border="0" align="left" cellpadding="0" cellspacing="0">
						<tr>
						<form action="laporan-stok-new" onsubmit="return cek_dulu1();" method="post" autocomplete="off" target="_blank">
							<td align="left" style="width:50%">
								<h4 style="color:#284d58">Barang Keluar</h4>
								<b>Tanggal Awal</b>
								<input style="width:90%" class="form-control form-control-sm datepicker" type="text" placeholder="yyyy-mm-dd"  id="id_cek_tanggal_keluar1" name="cek_tanggal_keluar1">
								<b>Hingga Tanggal</b>
								<input style="width:90%" class="form-control form-control-sm datepicker" type="text" placeholder="yyyy-mm-dd"  id="id_cek_tanggal_keluar2" name="cek_tanggal_keluar2">
								<b>Pilih Kategori(Tujuan)</b><br>
								<select style="color:#393939;font-weight:bold;width:90%" class="form-control form-control-sm" name="tujuan_keluar" id="tujuan_keluar">
									<option value="SEMUA" selected>Semua</option>
									<option value="ONLINE STORE">Online Store</option>
									<option value="OFFLINE STORE">Offline Store</option>
									<option value="LAINNYA">Lainnya</option>
								</select>
								</br>
								<button align="center" style="width:50%" type="submit" class="btn btn-primary btn-sm" name="cetak_barang_keluar">Cetak </button>
							</td>
						</form>
						<form action="laporan-stok-new.php" onsubmit="return cek_dulu2();" method="post" autocomplete="off" target="_blank">
							<td align="left" style="width:50%">
								<h4 style="color:#284d58">Barang Masuk</h4>
								<b>Tanggal Awal</b>
								<input style="width:90%" class="form-control form-control-sm datepicker" type="text" placeholder="yyyy-mm-dd"  id="id_cek_tanggal_masuk1" name="cek_tanggal_masuk1">
								<b>Hingga Tanggal</b>
								<input style="width:90%" class="form-control form-control-sm datepicker" type="text" placeholder="yyyy-mm-dd"  id="id_cek_tanggal_masuk2" name="cek_tanggal_masuk2">
								<b>Pilih Kategori(Terima Dari)</b><br>
								<select style="color:#393939;font-weight:bold;width:90%" class="form-control form-control-sm" name="tujuan_masuk" id="tujuan_masuk">
									<option value="SEMUA" selected>Semua</option>
									<option value="PRODUKSI">Produksi</option>
									<option value="MARKETING">Marketing</option>
								</select>
								</br>
								<button align="center" style="width:50%" type="submit" class="btn btn-primary btn-sm" name="cetak_barang_masuk">Cetak </button>
							</td>
						</form>
						</tr>
					</table>
			</div>
			
		</div>
		
		
		
		<input hidden type="text" id="tempat_cek" maxlength="12" value="<?php echo $kode_aktifnya; ?>" name="tempat_cek" class="form-control form-control-sm" readonly=readonly>
		<script type="text/javascript">
			function kategori_pengeluaran(evt, cityName) {
			  var i, tabcontent, tablinks;
			  tabcontent = document.getElementsByClassName("tabcontent");
			  for (i = 0; i < tabcontent.length; i++) {
			    tabcontent[i].style.display = "none";
			  }
			  tablinks = document.getElementsByClassName("tablinks");
			  for (i = 0; i < tablinks.length; i++) {
			    tablinks[i].className = tablinks[i].className.replace(" active", "");
			  }
			  document.getElementById(cityName).style.display = "block";
			  evt.currentTarget.className += " active";
			}
			//document.getElementById("btn_lain").click();
		</script>
		
		
		<script type="text/javascript">
		  var kode_aktif = $('#tempat_cek').val();
			  if (kode_aktif=="KELUAR"){
				  document.getElementById("btn_l_pengeluaran").click();
				  document.getElementById("id_cek_tanggal_dana_keluar1").focus();			  
			  }
			  else if (kode_aktif=="MASUK"){
				  document.getElementById("btn_l_pemasukan").click();		  
				  document.getElementById("id_cek_tanggal_dana_masuk1").focus();	
				
			  }
			  else if (kode_aktif=="SUMMARY"){				  
				  document.getElementById("btn_l_summary").click();
				  document.getElementById("id_cek_tanggal_summary1").focus();	
			  }
			  else{
				  document.getElementById("btn_l_stok").click();
				  document.getElementById("id_cek_tanggal_keluar1").focus();	
			  }
			  function kategori(){
				  alert('c');
			  }
		</script>
		
	
		<script type="text/javascript">
			$(function() {
			  $(".tgl_transaksi").datepicker({
			    format: 'yyyy/mm/dd',
			    autoclose: true,
			    minViewMode: 3,
			    todayHighlight: true,
			  });
			});
		</script>
		<script type="text/javascript">
			$(function() {
			  $(".datepicker").datepicker({
			    format: 'yyyy-mm-dd',
			    autoclose: true,
			    todayHighlight: true,
			  });
			});
		</script>
		<script>
			function cek_dulu1(){	
				var tgl_kel1 = document.getElementById('id_cek_tanggal_keluar1').value;
				var tgl_kel2 = document.getElementById('id_cek_tanggal_keluar2').value;				
				
					if (tgl_kel1 ==''){
						alert('Pilih Tanggal Awal (Barang Keluar)...');
						document.getElementById('id_cek_tanggal_keluar1').focus();
						return false;				
					}
					else if (tgl_kel2 ==''){
						alert('Pilih Tanggal Akhir (Barang Keluar)...');
						document.getElementById('id_cek_tanggal_keluar2').focus();
						return false;				
					}
					else{
						return confirm('Pilih OK untuk mencetak - keluar...');
						//return false;								
						//return confirm('Yakin ingin simpan?');         
					}							
			}			
			function cek_dulu2(){	
				var tgl_mas1 = document.getElementById('id_cek_tanggal_masuk1').value;
				var tgl_mas2 = document.getElementById('id_cek_tanggal_masuk2').value;			
				
					if (tgl_mas1 ==''){
						alert('Pilih Tanggal Awal (Barang Masuk)...');
						document.getElementById('id_cek_tanggal_masuk1').focus();
						return false;				
					}
					else if (tgl_mas2 ==''){
						alert('Pilih Tanggal Akhir (Barang Masuk)...');
						document.getElementById('id_cek_tanggal_masuk2').focus();
						return false;				
					}
					else{
						return confirm('Pilih OK untuk mencetak - masuk...');						
						//return confirm('Yakin ingin simpan?');         
					}							
			}				
			function cek_dulu_summary(){	
				var tgl_sum1 = document.getElementById('id_cek_tanggal_summary1').value;
				var tgl_sum2 = document.getElementById('id_cek_tanggal_summary2').value;			
				
					if (tgl_sum1 ==''){
						alert('Pilih Tanggal Awal (Summary)...');
						document.getElementById('id_cek_tanggal_summary1').focus();
						return false;				
					}
					else if (tgl_sum2 ==''){
						alert('Pilih Tanggal Akhir (Summary)...');
						document.getElementById('id_cek_tanggal_summary2').focus();
						return false;				
					}
					else{
						return confirm('Pilih OK untuk mencetak - summary...');						
						//return confirm('Yakin ingin simpan?');         
					}							
			}		
			function cek_dulu_dana_keluar(){	
				var tgl_dankel1 = document.getElementById('id_cek_tanggal_dana_keluar1').value;
				var tgl_dankel2 = document.getElementById('id_cek_tanggal_dana_keluar2').value;			
				
					if (tgl_dankel1 ==''){
						alert('Pilih Tanggal Awal (Pengeluaran)...');
						document.getElementById('id_cek_tanggal_dana_keluar1').focus();
						return false;				
					}
					else if (tgl_dankel2 ==''){
						alert('Pilih Tanggal Akhir (Pengeluaran)...');
						document.getElementById('id_cek_tanggal_dana_keluar2').focus();
						return false;				
					}
					else{
						return confirm('Pilih OK untuk mencetak - pengeluaran...');						
						//return confirm('Yakin ingin simpan?');         
					}							
			}					
			function cek_dulu_dana_masuk(){	
				var tgl_danmas1 = document.getElementById('id_cek_tanggal_dana_masuk1').value;
				var tgl_danmas2 = document.getElementById('id_cek_tanggal_dana_masuk2').value;			
				
					if (tgl_danmas1 ==''){
						alert('Pilih Tanggal Awal (Pemasukan)...');
						document.getElementById('id_cek_tanggal_dana_masuk1').focus();
						return false;				
					}
					else if (tgl_danmas2 ==''){
						alert('Pilih Tanggal Akhir (Pemasukan)...');
						document.getElementById('id_cek_tanggal_dana_masuk2').focus();
						return false;				
					}
					else{
						return confirm('Pilih OK untuk mencetak - pemasukan...');						
						//return confirm('Yakin ingin simpan?');         
					}							
			}		
		</script>		
	
		<script>
			var coll = document.getElementsByClassName("collapsible");
			var i;
			for (i = 0; i < coll.length; i++) {
			  coll[i].addEventListener("click", function() {
				this.classList.toggle("active");
				var content = this.nextElementSibling;
				if (content.style.display === "block") {
				  content.style.display = "none";
				} else {
				  content.style.display = "block";
				}
			  });
			}
		</script>		
		</div>
		<div class="navbar_bot">
			<?php include "bantuan/footer.php" ?>
		</div>
	</body>
</html>