<?php               
	//error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
		error_reporting(0);
	session_start();
	include 'koneksi.php';
	$barang=mysqli_query($koneksi, "SELECT * FROM t_stok");
	$jsArray = "var NAMA = new Array();\n"; 
	?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Input Reseller - S W E A T E R I N . M E</title>
		<link rel="shortcut icon" href="img/tokonline.png">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/freelancer.min.css">
		<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
		<script type="text/javascript">
			function qtynya(){
				//	$("#inputa").click();
				 }
		</script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#inputa').on('click',function(){
				$('#divxx').load('tampil-reseller.php').fadeIn("slow");
				
				var kode_transaksi = $('#kode_transaksi').val()
				var jenis_barang = $('#jenis_barang').val();
				var deskripsi = $('#deskripsi').val()
				var per_item = $('#per_item').val()
				var banyaknya = $('#banyaknya').val()
				var nominal = $('#nominal').val()
				
				if(deskripsi==""){
					  alert('Deskripsi Kosong.. Mohon diisi.');	
					  document.getElementById("deskripsi").focus();
					  return false;
				  }
				else if(per_item==""){
					  alert('Biaya Per Item Kosong.. Mohon diisi.');	
					  document.getElementById("per_item").focus();
					  return false;
				  }
				else if(banyaknya==""){
					  alert('Banyaknya Kosong.. Mohon diisi.');	
					  document.getElementById("banyaknya").focus();
					  return false;
				  }
				else{					
					$.ajax({
					   method: "POST",
					  url: "simpan-reseller.php",
					  data: { kode_transaksi:kode_transaksi, per_item : per_item, banyaknya : banyaknya, jenis_barang : jenis_barang, deskripsi : deskripsi, nominal : nominal,type:"insert"},
					  success	: function(data){
									//$('#divxx').load('tampil-order.php').fadeIn("slow");
								//	document.getElementById("myFormaa").reset();		
								//	location.reload(true);									
								},
								error: function(response){
									console.log(response.responseText);
								}
					});	
					alert('Data tersimpan di list');          
					document.getElementById("keperluan").focus();														
				}					
			  });
			});
		</script>
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
		<style type="text/css">
			#kiri
			{
			width:30%;				
			height:100px;
			padding: 5px;
			float:left;
			}
			#kanan
			{
			width:70%;
			height:100px;
			padding: 10px;
			float:right;
			}
		</style>
		<script type="text/javascript">
			//		document.getElementById('sumber').value = "<?php echo $_POST['sumber'];?>";
				//	document.getElementById('kategorix').value = "<?php echo $_POST['kategorix'];?>";
				
				
		</script>
		<script>
			function sebelum() {         				
			  var keperluan = $('#keperluan').val();
			  var keterangan = $('#keterangan').val()
			  //var nominal = $('#nominal').val()
			  if(keperluan==""){
				  alert('Keperluan Kosong.. Mohon diisi.');	
				  document.getElementById("keperluan").focus();
				  return false;
			  }
			else if(keterangan==""){
				  alert('Keterangan Kosong.. Mohon diisi.');	
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
		<div class="bg">
	  <?php 
				error_reporting(0);
				session_start();	
				include 'koneksi.php';
			if($_SESSION['status']!="login"){
					echo "<script>alert('Anda belum login.....');window.location.href='index?pesan=belum_login';</script>";                    
			}
			else if ($_SESSION['level']!="OWNER" AND $_SESSION['level']!="SPV ADMIN" AND $_SESSION['level']!="ADMIN"){
					echo "<script>alert('Anda tidak memiliki akses.....');window.location.href='javascript:history.go(-1)';</script>";
			}
			else{
				$data_rsl = mysqli_query($koneksi,"SELECT ID,KODE_TRANSAKSI FROM t_reseller ORDER BY ID DESC LIMIT 1");
				 while($d = mysqli_fetch_array($data_rsl)){
					//$jumrsl        = $d['ID'];				
					$jumrsl        = substr($d['KODE_TRANSAKSI'],5);						
				 }
				 
				 
				if ($jumrsl == 0) {
					$kode_rsl = "RSL-0000000001";
				}
				else{
					$jumrsl++;			
					if (strlen($jumrsl)== 1){
						$kode_rsl = "RSL-000000000".$jumrsl;				
					}
					else if (strlen($jumrsl)== 2){
						$kode_rsl = "RSL-00000000".$jumrsl;
					}
					else if (strlen($jumrsl)== 3){
						$kode_rsl = "RSL-0000000".$jumrsl;
					}
					else if (strlen($jumrsl)== 4){
						$kode_rsl = "RSL-000000".$jumrsl;
					}
					else if (strlen($jumrsl)== 5){
						$kode_rsl = "RSL-00000".$jumrsl;
					}
					else if (strlen($jumrsl)== 6){
						$kode_rsl = "RSL-0000".$jumrsl;
					}
					else if (strlen($jumrsl)== 7){
						$kode_rsl = "RSL-000".$jumrsl;
					}
					else if (strlen($jumrsl)== 8){
						$kode_rsl = "RSL-00".$jumrsl;
					}
					else if (strlen($jumrsl)== 9){
						$kode_rsl = "RSL-0".$jumrsl;
					}
					else if (strlen($jumrsl)== 10){
						$kode_rsl = "RSL-".$jumrsl;
					}
				}
				
			}
	?>
		<h1 align='center' style="background-color:#71b8e4;color:#FFFFFe">INPUT RESELLER</h1>
		<h3 align='center' style="background-color:#1d7bb6;color:#FFFFee">- S W E A T E R I N -</h3>
		<br>
		<a style="background-color:#71b8e4;color:#FFFFFe" href="form-reseller"> Kembali ke Data Reseller </a><br>			
		<div id="kiri">
			<br>	 
			<form method="post" id="myFormaa" onsubmit="return sebelum()">
				<div class="exxxxx3">
					<div class="table-responsive">
						<div class="form-group">
							<div class="container">
								<div class="form-group">
									<table border="0" class="table" cellpadding="2" cellspacing="2" align="left">
										<tr>
											<th>
												<h6>Kode Transaksi</h6>
											</th>
											<td colspan="2"><input type="text" id="kode_transaksi" maxlength="12" value="<?php echo $kode_rsl; ?>" name="kode_transaksi" class="form-control form-control-sm" readonly=readonly>
											</td>											
										</tr>
										<tr>
											<th>Jenis Barang</th>
											<td colspan="2">
												<select name="jenis_barang" id="jenis_barang" onchange="select_aft_dev()" class="form-control form-control-sm">
													<option value="BASIC CROP" <?php if($_POST['jenis_barang'] == 'BASIC CROP') {echo 'selected=selected'; } ?> >Basic Crop</option>
													<option value="BASIC SWEATER" <?php if($_POST['jenis_barang'] == 'BASIC SWEATER') {echo 'selected=selected'; } ?> >Basic Sweater</option>
													<option value="HOODIE CROP" <?php if($_POST['jenis_barang'] == 'HOODIE CROP') {echo "selected=selected"; } ?> >Hoodie Crop</option>
													<option value="HOODIE JUMPER" <?php if($_POST['jenis_barang'] == 'HOODIE JUMPER') {echo 'selected=selected'; } ?> >Hoodie Jumper</option>
													<option value="HOODIE ZIPPER" <?php if($_POST['jenis_barang'] == 'HOODIE ZIPPER') {echo 'selected=selected'; } ?> >Hoodie Zipper</option>
												</select>
											</td>
										</tr>
										<tr>
											<th>Deskripsi</th>
											<td colspan="2"><textarea autofocus placeholder="Deskripsi" id="deskripsi" class="form-control form-control-sm"></textarea></td>
										</tr>
										<tr>
											<th><label>Biaya per Item</label></th>
											<td width="2%"><label>Rp</label></td>
											<td><input value="0" type="text" id="per_item" class="form-control form-control-sm mata-uang" onkeyup="total_biaya();"></td>
										</tr>
										<tr>
											<th><label>Banyaknya</label></th>
											<td colspan="2"><input value="1" type="text" id="banyaknya" class="form-control form-control-sm mata-uang" onkeyup="total_biaya();"></td>
										</tr>
										<tr>
											<th><label>Jumlah</label></th>
											<td width="2%"><label>Rp</label></td>
											<td><input readonly="readonly" value="0" type="text" id="nominal" class="form-control form-control-sm mata-uang"></td>
										</tr>
										<tr align='center'>
											<td align='right' colspan="3"><br>
												<button value="simpan" name="inputa" id="inputa" class="btn btn-info btn-lg btn-block">Input</button>		
												<button onclick="autofocuss()" type="reset" class="btn btn-danger btn-lg btn-block">Batal</button>					   
											</td>
										</tr>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
			<script>
				function autofocuss() {
					//document.getElementById("devisix").focus();
				}
				 
			</script>
			
			
			<script type="text/javascript">
			function total_biaya(){		  
				 $('.mata-uang').mask('0.000.000.000', {reverse: true});		
				
				var nominal = document.getElementById('nominal').value;
				var per_item = document.getElementById('per_item').value;
				var banyaknya = document.getElementById('banyaknya').value;
				  if (per_item == ""){
						document.getElementById('per_item').value="0";
						per_item=0;
				  }
				  if (banyaknya == ""){
						document.getElementById('banyaknya').value="1";
						banyaknya=1;
				  }
									
				var per_item = per_item.replace(".","");
				per_item = per_item.replace(".","");
				per_item = per_item.replace(".","");
				var banyaknya = banyaknya.replace(".","");		
				banyaknya = banyaknya.replace(".","");				
				banyaknya = banyaknya.replace(".","");								
								
				
				
					var total = parseInt(per_item) * parseInt(banyaknya);
					//alert (total_tr);
					var totalnya = total.toFixed().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
					
					document.getElementById("nominal").value = totalnya;				
					//document.getElementById("nominal").innerHTML = "Rp"+totalnya;				
				
			}		         
		</script>
		</div>
		<div id="kanan">
			<div><?php include"tampil-reseller.php"; ?>
			</div>
		</div>
		<script src="js/jquery-1.11.2.min.js"></script>
		<script src="js/jquery.mask.min.js"></script>
		<script src="js/terbilang.js"></script>
		<script>
			function inputTerbilang() {
			  //membuat inputan otomatis jadi mata uang
			  $('.mata-uang').mask('0.000.000.000', {reverse: true});
			  var nominal = document.getElementById('nominal').value;
			  if (nominal == ""){
					document.getElementById('nominal').value="0";
					nominal=0;
			  }
			
			  //mengambil data uang yang akan dirubah jadi terbilang
			   var input = document.getElementById("terbilang-input").value.replace(/\./g, "");
			
			   //menampilkan hasil dari terbilang
			   document.getElementById("terbilang-output").value = terbilang(input).replace(/  +/g, ' ');
			} 
		</script>				
		<script type="text/javascript">
			function select_aft_dev(){
			 document.getElementById("keperluan").focus();
			}			   
		</script>		
		<script type="text/javascript">
			function select(){			   
			document.getElementById("jenisx").focus();							
			}
		</script>
	</body>
</html>