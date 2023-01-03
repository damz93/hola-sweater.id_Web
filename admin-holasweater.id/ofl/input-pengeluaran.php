<?php
	include 'koneksi.php';
	// membuat data jurusan menjadi dinamis dalam bentuk array
	//$jurusan    = array('TEKNIK INFORMATIKA','TEKNIK ELEKTRO','REKAMEDIS');
	// membuat function untuk set aktif radio button
	/*function active_radio_button($value,$input){
	    // apabilan value dari radio sama dengan yang di input
	    $result =  $value==$input?'checked':'';
	    return $result;
	}*/
	?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Tambah Pengeluaran - S W E A T E R I N . M E</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link rel="shortcut icon" href="img/tokonline.png">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
		<script src="js/bootstrap-datepicker.js"></script>
		<link rel="stylesheet" href="css/datepicker.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
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
			$(document).ready(function(){
				$('#input').on('click',function(){
				var kategori = $('#kategoriy').val();
				if (kategori!=""){
					$.ajax({
					  method: "POST",
					  url: "simpan-kategori-pengeluaran.php",
					  data: { kategori : kategori,type:"insert"},
					  success	: function(data){
									//document.getElementById("myForm").reset();									
									location.reload(true);		
									alert('Data tersimpan');            	
								},
								error: function(response){
									console.log(response.responseText);
								}
					});							
				}				
				else{
					alert('Kategori Kosong...');
					document.getElementById("kategoriy").focus();
				}	
			  });
			});
		</script>
		<script type="text/javascript">
			function cek_kat(){        			   		   
				var kategori = $('#kategoriy').val();
				//alert(a);   
				$.ajax({
				url: 'list-kat-pengeluaran.php',
				method: 'GET',
				data: { kategori : kategori},
				success	: function(data){
								//document.getElementById("myForm").reset();									
					var json = data,
					obj = JSON.parse(json);
					$('#kategoriy2').val(obj.kategori);	     
					 var kod1 = $('#kategoriy').val(); 
				 var kod2 = $('#kategoriy2').val(); 
				 if (kod1 == kod2){
					 alert('Kategori sudah ada....');                    
					 document.getElementById("kategoriy").focus();    
					 document.getElementById("kategoriy").value = "Kategori sudah ada...."; 
				 }
				},
				error: function(response){
					console.log(response.responseText);
				}
				});	
			}			 
		</script>
		<script type="text/javascript">
			function cek_kataaa(){        			   		   
			var kategori = $('#kategoriy').val();
			//alert(a);   
			$.ajax({
			url: 'list-kat-pengeluaran.php',
			method: 'GET',
			data     : 'kategori='+kategori,
			}).success(function (data) {
			  var json = data,
			  obj = JSON.parse(json);
			  $('#kategoriy2').val(obj.kode_order);
			 
			 var kod1 = $('#kategoriy').val(); 
			 var kod2 = $('#kategoriy2').val(); 
			 if (kod1 == kod2){
				 alert('Kode Order sudah ada....');                    
				 document.getElementById("kategoriy").focus();    
				 document.getElementById("kategoriy").value = "Kode transaksi sudah ada...."; 
			 }
			 }).autocomplete({
			 //source: "list-namabarang.php",
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
			else if (($_SESSION['level']!="OWNER")AND($_SESSION['level']!="BENDAHARA")){
				echo "<script>alert('Anda tidak memiliki akses.....');window.location.href='javascript:history.go(-1)';</script>";
			}
			?>
		<div class="bg">
		<h1 align='center' style="background-color:#71b8e4;color:#FFFFFe">TAMBAH PENGELUARAN</h1>
		<h3 align='center' style="background-color:#1d7bb6;color:#FFFFee">- S W E A T E R I N . M E -</h3>
		<div class='container'>
			<a style="background-color:#71b8e4;color:#FFFFFe" href="form-pengeluaran.php"> [ Kembali ke Data Pengeluaran ]</a><br>
			<br>
			<?php 
				include 'koneksi.php';
				
				//	$jumkeluar = mysqli_query($koneksi,"select COUNT(`KODE_PENGELUARAN`) FROM tbl_pengeluaran");
				
				// mengambil data barang);
				$data_pengeluaran = mysqli_query($koneksi,"select max(ID) as ID from t_pengeluaran");
				 while($d = mysqli_fetch_array($data_pengeluaran)){
					$jumkeluar        = $d['ID'];					
				 }
				if ($jumkeluar == 0) {
					$kode_pengeluaran = "SPDING-0000001";
				}
				else{
					$jumkeluar++;			
					if (strlen($jumkeluar)== 1){
						$kode_pengeluaran = "SPDING-000000".$jumkeluar;				
					}
					else if (strlen($jumkeluar)== 2){
						$kode_pengeluaran = "SPDING-00000".$jumkeluar;
					}
					else if (strlen($jumkeluar)== 3){
						$kode_pengeluaran = "SPDING-0000".$jumkeluar;
					}
					else if (strlen($jumkeluar)== 4){
						$kode_pengeluaran = "SPDING-000".$jumkeluar;
					}
					else if (strlen($jumkeluar)== 5){
						$kode_pengeluaran = "SPDING-00".$jumkeluar;
					}
					else if (strlen($jumkeluar)== 6){
						$kode_pengeluaran = "SPDING-0".$jumkeluar;
					}
					else if (strlen($jumkeluar)== 7){
						$kode_pengeluaran = "SPDING-".$jumkeluar;
					}
				}
				?>         
			<form method="post" action="simpan-pengeluaran.php" onsubmit="return confirm('Yakin ingin simpan?');">
				<div class="table-responsive">
					<table class="table" border="0" cellpadding="2" cellspacing="2" align=center>
						<tr>
							<th>Kode Pengeluaran</th>
							<td width="5%"></td>
							<td colspan="2"><input  class="form-control form-control-sm" readonly maxlength="30" type="text" name="KODE_PENGELUARAN" value="<?php echo $kode_pengeluaran ?>"></th>
						</tr>
						<tr>
							<th>Kategori</th>
							<td width="5%"></td>
							<td>
								<!--<select  class="form-control form-control-sm" name="KATEGORIX" id="kategorix"  onchange="autofocus2()" autofocus>
									<option value="Ongkir">Ongkir</option>
									<option value="Operasional">Operasional</option>
									<option value="Utang">Utang</option>
									<option value="Lain-lain">Lain-lain</option>
									</select>-->
								<select  class="form-control form-control-sm" name="KATEGORIX" id="kategorix"  onchange="autofocus2()" autofocus>                        
								<?php
									include "koneksi.php";
									$data = mysqli_query($koneksi,"select KATEGORI from t_kategori_pengeluaran order by KATEGORI ASC");
									while($d = mysqli_fetch_array($data)){
										$kat = $d['KATEGORI'];
										echo '<option value="'.$kat.'">'.$kat.'</option>';
									}							
									?>
								</select>						
							</td>
							<td width="10%" align="left"> <a href="#"><img src="img/plus.png" width="40" height="40" data-toggle="modal" data-target="#contact-modal"></a></td>
						</tr>
						<tr>
							<th>Tanggal Transaksi</th>
							<td width="5%"></td>
							<td colspan="2"><input placeholder="Tanggal Transaksi(dd/MM/yyyy)" class="form-control form-control-sm datepicker" maxlength="30" type="text" name="tgl_transaksi" id="tgl_transaksi">  </td>
						</tr>
						<tr>
							<th>Keterangan</th>
							<td width="5%"></td>
							<td colspan="2"><input  class="form-control form-control-sm" id="keterangan"  placeholder="Keterangan" maxlength="30" type="text" name="KETERANGAN"></th>
						</tr>
						<tr>
							<th>Nominal</th>
							<td width="5%" align="right"><label>Rp</label></td>
							<td colspan="2"><input type="text" placeholder="0" id="nominal" class="form-control form-control-sm mata-uang" onkeyup="inputTerbilang();" name="NOMINAL" ></th>
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
			function select(){			   
			document.getElementById("jenisx").focus();							
			}
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
		<div id="contact-modal" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h3>Tambah Kategori Pengeluaran</h3>
					</div>
					<table id="tabel1" class="table table-striped" border="1" cellpadding="0" cellspacing="1">
						<tr align='center' class="table-info">
							<td align='center'>NO.</th>
							<td align='center'>KATEGORI</th>
							<td align='center'>AKSI</th>
						</tr>
						<?php
							include "koneksi.php";
							$no=1;
							$data = mysqli_query($koneksi,"select ID,KATEGORI from t_kategori_pengeluaran order by KATEGORI ASC");
								while($d = mysqli_fetch_array($data)){
							$id = $d['ID'];
								
							?>
						<tr align="center">
							<td><?php echo $no++; ?></td>
							<td align="left"><?php echo $d['KATEGORI']; ?></td>
							<td align="center"> <a href='hapus-kategori-pengeluaran?id=<?php echo $id; ?>' title="Delete Pengeluaran" onclick="return confirm('Are you sure you want to delete?')"><img src="img/delete.png" height="100%" ></a><?php } ?></td>
						</tr>
					</table>
					<form id="contactForm" name="contact" role="form">
						<div class="modal-body">
							<div class="form-group">
								<label for="name">Kategori</label>
								<input type="text" name="kategoriy" id="kategoriy" onchange="cek_kat();" class="form-control">                        
								<input hidden readonly="readonly" type="text" value="0" id="kategoriy2" name="kategoriy2">
							</div>
						</div>
						<div class="modal-footer">					
							<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
							<button  value="simpan" name="input" id="input" class="btn btn-success">Tambah</button>	
						</div>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>