<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Tambah Pemasukan - S W E A T E R I N . M E</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link rel="shortcut icon" href="img/tokonline.png">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
      <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
      <script src="js/bootstrap-datepicker.js"></script>
      <link rel="stylesheet" href="css/datepicker.css">
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
		<script>
			function sebelum() {         	
			  var tgl_transaksi = document.getElementById("tgl_transaksi").value; 
			  var dari = document.getElementById("dari").value; 
			  var total_pembayaran = document.getElementById("total_pembayaran").value; 
			  var qty = document.getElementById("qty").value; 
			  var payment = document.getElementById("payment").value; 
			  var noref = document.getElementById("noref").value; 
			  var keterangan = document.getElementById("keterangan").value; 
			  if(tgl_transaksi==""){
				  alert('Pilih tgl transaksi');	
				  document.getElementById("tgl_transaksi").focus();
				  return false;
			  }
			  else if(dari==""){
				  alert('Input terima dari');	
				  document.getElementById("dari").focus();
				  return false;
			  }
			  else if(total_pembayaran=="0"){
				  alert('Input total pembayaran');	
				  document.getElementById("total_pembayaran").focus();
				  return false;
			  }
			  else if(total_pembayaran==""){
				  alert('Input total pembayaran');	
				  document.getElementById("total_pembayaran").focus();
				  return false;
			  }
			  else if(qty=="0"){
				  alert('Input qty');	
				  document.getElementById("qty").focus();
				  return false;
			  }
			  else if(noref==""){
				  alert('Input No Ref');	
				  document.getElementById("noref").focus();
				  return false;
			  }
			  else if(keterangan==""){
				  alert('Input keterangan');	
				  document.getElementById("keterangan").focus();
				  return false;
			  }
				else{
					return confirm('Yakin ingin simpan?');        	 
				}
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
				else if ($_SESSION['level']!="OWNER" AND $_SESSION['level']!="BENDAHARA" AND $_SESSION['level']!="OWNER" AND $_SESSION['level']!="OWNER" AND $_SESSION['level']!="OWNER" AND $_SESSION['level']!="BENDAHARA"){
					echo "<script>alert('Anda tidak memiliki akses.....');window.location.href='javascript:history.go(-1)';</script>";
				}
		?>
		<div class="bg">
		<h1 align='center' style="background-color:#71b8e4;color:#FFFFFe">TAMBAH PEMASUKAN</h1>
		<h3 align='center' style="background-color:#1d7bb6;color:#FFFFee">- S W E A T E R I N . M E -</h3>
		<div class='container'>
			<a style="background-color:#71b8e4;color:#FFFFFe" href="form-pemasukan"> [ Kembali ke Data Pemasukan ]</a><br>
			<br>
			<?php 
				include 'koneksi.php';
				
				//	$jummasuk = mysqli_query($koneksi,"select COUNT(`KODE_PENGELUARAN`) FROM tbl_pengeluaran");
				
				// mengambil data barang);
				$data_pemasukan = mysqli_query($koneksi,"select max(ID) as ID from t_pemasukan2");
				 while($d = mysqli_fetch_array($data_pemasukan)){
					$jummasuk        = $d['ID'];					
				 }
				if ($jummasuk == 0) {
					$kode_pemasukan = "INC-00000000001";
				}
				else{
					$jummasuk++;			
					if (strlen($jummasuk)== 1){
						$kode_pemasukan = "INC-00000000000".$jummasuk;				
					}
					else if (strlen($jummasuk)== 2){
						$kode_pemasukan = "INC-0000000000".$jummasuk;
					}
					else if (strlen($jummasuk)== 3){
						$kode_pemasukan = "INC-000000000".$jummasuk;
					}
					else if (strlen($jummasuk)== 4){
						$kode_pemasukan = "INC-00000000".$jummasuk;
					}
					else if (strlen($jummasuk)== 5){
						$kode_pemasukan = "INC-0000000".$jummasuk;
					}
					else if (strlen($jummasuk)== 6){
						$kode_pemasukan = "INC-000000".$jummasuk;
					}
					else if (strlen($jummasuk)== 7){
						$kode_pemasukan = "INC-00000".$jummasuk;
					}
					else if (strlen($jummasuk)== 8){
						$kode_pemasukan = "INC-0000".$jummasuk;
					}
					else if (strlen($jummasuk)== 9){
						$kode_pemasukan = "INC-000".$jummasuk;
					}
					else if (strlen($jummasuk)== 10){
						$kode_pemasukan = "INC-00".$jummasuk;
					}
					else if (strlen($jummasuk)== 11){
						$kode_pemasukan = "INC-0".$jummasuk;
					}
					else if (strlen($jummasuk)== 12){
						$kode_pemasukan = "INC-".$jummasuk;
					}
				}
				?>         
			<form method="post" action="simpan-pemasukan.php" onsubmit="return sebelum()">
			
			
				<div class="table-responsive">
					<table class="table" border="0" cellpadding="2" cellspacing="2" align=center>
						<tr>
							<th>Kode Pemasukan</th>
							<td width="5%"></td>
							<td colspan="2"><input  class="form-control form-control-sm" readonly maxlength="30" type="text" name="KODE_PEMASUKAN" value="<?php echo $kode_pemasukan ?>"></th>
						</tr>
						<tr>
							<th>Jenis Pemasukan</th>
							<td width="5%"></td>
							<td colspan="2">
								<select  class="form-control form-control-sm" name="JENIS" id="jenis"  onchange="autofocus2()" autofocus>
									<option value="OFFLINE STORE">Offline Store</option>
									<option value="RESELLER">Reseller</option>
									<option value="SHOPEE">Shopee</option>
									<option value="LAIN-LAIN">Lain-lain</option>
								</select>
							</td>		
							
						</tr>
						<tr>
							<td><br>
							</td>
						</tr>
						
						
						<tr>
							<th>Tanggal Transaksi</th>
							<td width="5%"></td>
							<td colspan="2"><input autofocus placeholder="Tanggal Transaksi(dd/MM/yyyy)" class="form-control form-control-sm datepicker" maxlength="30" type="text" name="tgl_transaksi" id="tgl_transaksi">  </td>
						</tr>
						<tr>
							<th>Terima Dari</th>
							<td width="5%"></td>
							<td colspan="2"><input  class="form-control form-control-sm" id="dari"  placeholder="Dari" maxlength="120" type="text" name="DARI"></th>
						</tr>
						
						<tr>
							<th>Total Pembayaran</th>
							<td width="5%" align="right"><label>Rp</label></td>
							<td colspan="2"><input type="text" value="0" id="total_pembayaran" class="form-control form-control-sm mata-uang" onkeyup="inputTerbilang();" name="TOTAL_PEMBAYARAN" ></th>
						</tr>
						<tr>
							<th>PCS Terjual</th>
							<td width="5%" align="right"></td>
							<td colspan="2"><input type="text" value="0" id="qty" class="form-control form-control-sm mata-uang" onkeyup="inputTerbilang();" name="QTY" ></th>
						</tr>
						<tr>
							<th>Jumlah Costum</th>
							<td width="5%" align="right"></td>
							<td colspan="2"><input type="text" value="0" id="costum" class="form-control form-control-sm mata-uang" onkeyup="inputTerbilang();" name="COSTUM" ></th>
						</tr>
						<tr>
							<td><br>
							</td>
						</tr>
						<tr hidden>
							<th>Payment Method</th>
							<td width="5%"></td>
							<td colspan="2"><input  class="form-control form-control-sm" id="payment4"  placeholder="Transfer, EDC, Tunai ...." maxlength="120" type="text" name="PAYMENT4"></th>
						</tr>
						<tr>
							<th>Payment Method</th>
							<td width="5%"></td>
							<td colspan="2">
								<select  class="form-control form-control-sm" name="PAYMENT" id="payment"  onchange="autofocus3()" autofocus>								
									<option value="EDC">EDC</option>
									<option value="TRANSFER" selected>Transfer</option>
									<option value="TUNAI">Tunai</option>
								</select></th>
						</tr>
						<tr>
							<th>No. Ref Pembayaran</th>
							<td width="5%"></td>
							<td colspan="2"><input  class="form-control form-control-sm" id="noref"  placeholder="No-Ref" maxlength="120" type="text" name="NOREF"></th>
						</tr>
						<tr>
							<th>Keterangan</th>
							<td width="5%"></td>
							<td colspan="2"><textarea rows="4" cols="50" class="form-control form-control-sm" id="keterangan"  placeholder="Keterangan" maxlength="300" type="text" name="KETERANGAN"></textarea></th>
						</tr>
						<tr align='center'>
							<br>
							<td colspan="2"><button type="submit" value="simpan" class="btn btn-info btn-lg btn-block">Simpan</button></th>
							<td colspan="2"><button onclick="autofocuss()" type="reset" class="btn btn-danger btn-lg btn-block">Batal</button>
						</tr>
						</tr>
					</table>
				</div>
			</form>
		</div>
		<!--<script src="js/jquery-1.11.2.min.js"></script>-->
		<script src="js/jquery.mask.min.js"></script>
		<script src="js/terbilang.js"></script>
		<script type="text/javascript">
			function total_transferx(){		  
				 $('.mata-uang').mask('0.000.000.000', {reverse: true});		
				//var input = document.getElementById("total_pemasukan").value.replace(/\./g, "");
			//	var input = document.getElementById("total_pengeluaran").value.replace(/\./g, "");
			
			   //menampilkan hasil dari terbilang
			   //document.getElementById("total_pemasukan").value = terbilang(input).replace(/  +/g, ' ');			
			   //document.getElementById("total_pengeluaran").value = terbilang(input).replace(/  +/g, ' ');			
			   
			//   alert('0');
				var total_masukx = document.getElementById('total_pemasukan').value;
				var total_keluarx = document.getElementById('total_pengeluaran').value;								
				var total_edcx = document.getElementById('total_edc').value;								
				var total_masuk = total_masukx.replace(".","");
				total_masuk = total_masuk.replace(".","");
				total_masuk = total_masuk.replace(".","");
				var total_keluar = total_keluarx.replace(".","");		
				total_keluar = total_keluar.replace(".","");				
				total_keluar = total_keluar.replace(".","");								
				var total_edc = total_edcx.replace(".","");		
				total_edc = total_edc.replace(".","");				
				total_edc = total_edc.replace(".","");				
				if (total_masuk == ""){
					document.getElementById('total_pemasukan').value="0";
					total_masuk=0;
				}
				else if (total_keluar == ""){
					document.getElementById('total_pengeluaran').value="0";
					total_keluar=0;
					//
				}
				else if (total_edc == ""){
					document.getElementById('total_edc').value="0";
					total_edc=0;
					//
				}
				
				
					var total = parseInt(total_masuk) - parseInt(total_keluar);
					//alert (total_tr);
					var totalnya = total.toFixed().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
					
					document.getElementById("total_transfer").value = totalnya;				
					document.getElementById("kembalian").innerHTML = "Rp"+totalnya;				
				
			}		         
		</script>
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
			function autofocus3() {
				document.getElementById("noref").focus();
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
		<script type="text/javascript">
			$(function(){
			    $(".tgl_transaksi").datepicker({
			        format: 'yyyy/mm/dd',
			        autoclose: true,
			minViewMode: 3,
			        todayHighlight: true,
			    });
			});
		</script>
		<script type="text/javascript">
			$(function(){
			    $(".datepicker").datepicker({
			        format: 'yyyy-mm-dd',
			        autoclose: true,
			        todayHighlight: true,
			    });
			});
		</script>
	</body>
</html>