<?php
	include 'koneksi.php';
	?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Tambah Log Inventory - S W E A T E R I N . M E</title>
		<link rel="shortcut icon" href="img/tokonline.png">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/freelancer.min.css">
		<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
		<script src="js/jquery-1.11.2.min.js"></script>
		<script src="js/jquery.mask.min.js"></script>
		<script src="js/terbilang.js"></script>
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
		<script type="text/javascript">
			function cek_inventory(){			   
				var nama_barang = $("#nama_barangz").val();
				if (nama_barang == "0"){
					alert('Pilih Barang!!!');
					$("#nama_barangz").focus();
					 $('#qtyz').val("");	
					 $('#detail_barangz').val("");	
				}
				else{
					$.ajax({
						url: 'list-inventory.php',
						method: 'GET',
						data     : 'nama_barang='+nama_barang,
						}).success(function (data) {
							 var json = data,
							 obj = JSON.parse(json);
							 $('#qtyz').val(obj.qty);	
							 var kode_barang = obj.kode_barang;
							 var spesifikasi = obj.spesifikasi;
							 var satuan = obj.satuan;
							 var detail = "("+kode_barang+")"+nama_barang+"-"+spesifikasi+"("+satuan+")";
							 $('#detail_barangz').val(detail);	
							 $("#maskelz").focus();
							var qty = $("#qtyz").val();
						}).autocomplete({
						//source: "list-namabarang.php",
					});
				}
			}
		</script>
		<script type="text/javascript">
			function cek_inventory2(){
			var nama_barang = document.getElementById('nama_barangz').value;					
			
				$.ajax({
				  type: "GET",
				  url: 'list-inventory.php',
				  data: {nama_barang:nama_barang},
				  success: function(value){
					var json = data,
					obj = JSON.parse(json);			
					$('#qtyz').val(obj.qty);	
				  }
				});
			}
		</script>
	</head>
	<body>
		<?php 
			error_reporting(0);
			session_start();					
			if($_SESSION['status']!="login"){
				echo "<script>alert('Anda belum login.....');window.location.href='index?pesan=belum_login';</script>";                    
			}
			else if ($_SESSION['level']!="OWNER" AND $_SESSION['level']!="SPV GUDANG" AND $_SESSION['level']!="GUDANG"){
				echo "<script>alert('Anda tidak memiliki akses.....');window.location.href='javascript:history.go(-1)';</script>";
			}
			?>
		<div class="bg">
			<h1 align='center' style="background-color:#71b8e4;color:#FFFFFe">TAMBAH LOG INVENTORY</h1>
			<h3 align='center' style="background-color:#1d7bb6;color:#FFFFee">- S W E A T E R I N . M E -</h3>
			<div class='container'>
				<a style="background-color:#71b8e4;color:#FFFFFe" href="form-log-inventory.php"> [ Kembali ke Data Log Inventory ]</a><br>
				<br>
				<?php 
					include 'koneksi.php';
					
					//	$jumkeluar = mysqli_query($koneksi,"select COUNT(`kode_log_inv`) FROM tbl_pengeluaran");
					
					// mengambil data barang);
					$data_log_inv = mysqli_query($koneksi,"select max(ID) as ID from t_log_inventory");
					 while($d = mysqli_fetch_array($data_log_inv)){
						$jumloginv        = $d['ID'];					
					 }
					if ($jumloginv == 0) {
						$kode_log_inv = "INV-0000001";
					}
					else{
						$jumloginv++;			
						if (strlen($jumloginv)== 1){
							$kode_log_inv = "INV-000000".$jumloginv;				
						}
						else if (strlen($jumloginv)== 2){
							$kode_log_inv = "INV-00000".$jumloginv;
						}
						else if (strlen($jumloginv)== 3){
							$kode_log_inv = "INV-0000".$jumloginv;
						}
						else if (strlen($jumloginv)== 4){
							$kode_log_inv = "INV-000".$jumloginv;
						}
						else if (strlen($jumloginv)== 5){
							$kode_log_inv = "INV-00".$jumloginv;
						}
						else if (strlen($jumloginv)== 6){
							$kode_log_inv = "INV-0".$jumloginv;
						}
						else if (strlen($jumloginv)== 7){
							$kode_log_inv = "INV-".$jumloginv;
						}
					}
					?>         
				<form method="post" action="simpan-log-inventory.php" onsubmit="return sebelum()">
					<div class="table-responsive">
						<table class="table" border="0" cellpadding="2" cellspacing="2" align=center>
							<tr>
								<th>Kode Inventory</th>
								<td colspan="2"><input  class="form-control form-control-sm" readonly maxlength="30" type="text" name="kode_log_inv" value="<?php echo $kode_log_inv ?>"></th>
							</tr>
							<tr>
								<th>Jenis Inventory</th>
								<th colspan="2">
									<select autofocus name="jenisx_inv" id="jenisx_inv" onchange="selectnya()" class="form-control form-control-sm">
										<option value="Barang Keluar" selected>Barang Keluar</option>
										<option value="Barang Masuk">Barang Masuk</option>
									</select>								
								</th>
							</tr>
							<tr>
								<th>Nama Barang</th>
								<td colspan="2">
									<select class="form-control form-control-sm" name="nama_barangz" id="nama_barangz"  onchange="cek_inventory()">
										<option value="0" selected>Pilih Barang</option>
										<?php
											include "koneksi.php";
											$data = mysqli_query($koneksi,"select NAMA_BARANG,KODE_BARANG,SPESIFIKASI,SATUAN,QTY from t_inventory order by NAMA_BARANG ASC");
											while($d = mysqli_fetch_array($data)){
												$nambarx = $d['NAMA_BARANG'];												
												echo '<option value="'.$nambarx.'">'.$nambarx.'</option>';
											}							
											?>
									</select>
								</td>
							</tr>
							<tr>
								<th>Detail Barang</th>
								<td colspan="2"><input placeholder="Belum Pilih Barang" type="text" readonly id="detail_barangz" class="form-control form-control-sm" name="detail_barangz"></td>
							</tr>
							<tr>
								<th>Qty Sekarang</th>
								<td colspan="2"><input placeholder="0" type="text" readonly id="qtyz" class="form-control form-control-sm" name="qtyz"></td>
							</tr>
							<tr>
								<th>Jumlah yg Masuk/Keluar</th>
								<td colspan="2"><input placeholder="0" type="text" id="maskelz" class="form-control form-control-sm mata-uang" name="maskelz" value="1" onkeyup="inputTerbilang();"></td>
							</tr>
							<tr>
								<th>Sumber(dari/tujuan)</th>
								<td colspan="2"><input placeholder="Stok, Keperluan apa dll..." class="form-control form-control-sm" id="sumberz" maxlength="30" type="text" name="sumberz"></th>
							</tr>							
							<tr align='center'>
								<br>
								<td colspan="2"><button type="submit" value="simpan" class="btn btn-info btn-lg btn-block">Simpan</button></th>
								<td colspan="2"><button onclick="autofocuss()" type="reset" class="btn btn-danger btn-lg btn-block">Batal</button>
									</th>
							</tr>
						</table>
					</div>
				</form>
			</div>
			<!--<script src="js/jquery-1.11.2.min.js"></script>-->
			<script src="js/jquery.mask.min.js"></script>
			<script src="js/terbilang.js"></script>
			<script>
				function autofocuss() {
					document.getElementById("kategorix").focus();
				}
				 
			</script>
			<script>
				function autofocus2() {
					document.getElementById("tgl_transaksi").focus();
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
		<script type="text/javascript">
			function selectnya(){
			 document.getElementById("nama_barangz").focus();
			}			   
		</script>		
		<script>
			function sebelum() {         	
			  var nama_barang = document.getElementById("nama_barangz").value; 
			  var maskel = document.getElementById("maskelz").value; 	 
			  var sumber = document.getElementById("sumberz").value; 
			  if(nama_barang=="0"){
				  alert('Pilih Nama Barang!!!');	
				  document.getElementById("nama_barangz").focus();
				  return false;
			  }
			  else if(maskel=="0"){
				  alert('Masukkan Jumlah Barang Masuk/Keluar!!!');	
				  document.getElementById("maskelz").focus();
				  return false;
			  }
			  else if(sumber==""){
				  alert('Masukkan sumber(dari/tujuan) Inventory');	
				  document.getElementById("sumberz").focus();
				  return false;
			  }
			else{
					return confirm('Yakin ingin simpan?');         	 
				}
			}			
		</script>
	</body>
</html>