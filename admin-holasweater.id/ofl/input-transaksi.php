<?php               
	//error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
	error_reporting(0);
	session_start();
	include 'koneksi.php';
	$barang=mysqli_query($koneksi, "SELECT * FROM t_transaksi_temp");
	$jsArray = "var NAMA = new Array();\n"; 
	?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Input Transaksi - S W E A T E R I N . M E</title>
		<link rel="shortcut icon" href="img/tokonline.png">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/freelancer.min.css">
		<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
		<script data-ad-client="ca-pub-5256228815542923" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>		
		<script type="text/javascript">
			function isi_otomatis(){			   
			var kode_barang = $("#kode_barang").val();
			$.ajax({
			url: 'list-ceknama.php',
			method: 'GET',
			data     : 'kode_barang='+kode_barang,
			}).success(function (data) {
				 var json = data,
				 obj = JSON.parse(json);
				 $('#jenis_barang').val(obj.jenis_barang);
				 $('#warna').val(obj.warna);
				$('#size').val(obj.size);
				$('#harga_satuan').val(obj.harga);
				$('#qty').val("1");
				var harga = $('#harga_satuan').val();
				var potongan = $('#potonganxx').val();
				var tambahan = $('#tambahan').val();
				var kuannn = $('#qty').val();
				var jenis = $('#jenis_barang').val();
				var kuant = (obj.qty);		
				var warna = $('#warna').val();
				var size = $('#size').val();
				var hargcost = $('#tambahan').val();
				var semua = jenis+'-'+warna+'('+size+')';
				$('#semua').val(semua); 
				
				//var totaltanpa = (Number(harga) * Number(kuannn)) + (Number(tambahan)*Number(kuannn)) - Number(potongan);			
				var totaltanpa = (Number(harga) * Number(kuannn));			
				var tot_tambahan = Number(kuannn) * Number(hargcost);
				document.getElementById("tambahan").value = tot_tambahan;
				var hasil = Number(totaltanpa);
				document.getElementById('kuantitasxx').innerHTML = kuant;				
				
				$('#total').val(hasil); 
				//var anuh = $('#total').val();
				var anuh = $('#warna').val();
				//alert(anuh);
				
			if (anuh.length == 0){
			//	alert('Kode Barang yang discan belum diinput');
				document.getElementById("kode_barang").focus();
			}
			else{
				document.getElementById("qty").focus();	
			}
			}).autocomplete({
			source: "list-namabarang.php",
			});
			}
		</script>
		<script type="text/javascript">
			function isi_promox(){			   
			var kode_promo = $("#kodiskxx").val();
			$.ajax({
			url: 'list-promo.php',
			method: 'GET',
			data     : 'kode_promo='+kode_promo,
			}).success(function (data) {
			 var json = data,
			 obj = JSON.parse(json);
			 $('#potonganxx').val(obj.nominal);
			var diskon = $('#potonganxx').val(); 			
			if (diskon == ""){	
				$('#potonganxx').val("0");	
				alert('Kode Promo tidak Valid');		
				document.getElementById("kodiskxx").focus();							
			}
			else{		
				 
			}
				var harga = $('#harga_satuan').val();
				var tambahan = $('#tambahan').val();
				var potongan = $('#potonganxx').val();
				var kuannn = $('#qty').val(); 				
				var totaltanpa = (Number(harga) * Number(kuannn)) + (Number(tambahan)*Number(kuannn)) - Number(potongan);
				var hasil = Number(totaltanpa);
				$('#total').val(hasil); 
			}).autocomplete({
			//source: "list-namabarang.php",
			});
			}
		</script> 
		<script type="text/javascript">
			function cek_costum(){			   
			var kode_costum = $("#kode_costum").val();
			$.ajax({
			url: 'list-costum.php',
			method: 'GET',
			data     : 'kode_costum='+kode_costum,
			}).success(function (data) {
			 var json = data,
			 obj = JSON.parse(json);
			 //$('#kode_costum').val(obj.kode_costum);
			 $('#jenis_costum').val(obj.jenis_costum);
			$('#tambahan').val(obj.harga);
			$('#harga_costumm').val(obj.harga);
			var harga = $('#harga_satuan').val();
			var tambahan = $('#tambahan').val();
			var potongan = $('#potonganxx').val();
			var kuannn = $('#qty').val(); 	
			//	var diskon = $('#diskon').val(); 
			//var potongan = $('#potongan').val(); 
						
					var hargcost = document.getElementById('harga_costumm').value;		
					var tot_tambahan = Number(kuannn) * Number(hargcost);
					document.getElementById("tambahan").value = tot_tambahan;
			
			
			var totaltanpa = (Number(harga) * Number(kuannn)) + (Number(tambahan)*Number(kuannn)) - Number(potongan);
			//	potongan = Number(potongan)*Number(kuannn);
			//var hasil = Number(totaltanpa) - (Number(totaltanpa)*(Number(diskon)/100)) - Number(potongan);
			var hasil = Number(totaltanpa);
			$('#total').val(hasil); 
			}).autocomplete({
			source: "list-namabarang.php",
			});
			}
		</script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#input').on('click',function(){
				$('#divxx').load('tampil-transaksi.php').fadeIn("slow");
				var kode_barang = $('#kode_barang').val();
				//var jenis_barang = $('#jenis_barang').val();
				//var harga_satuan = $('#harga_satuan').val();
				var kode_costum = $('#kode_costum').val();
				var kode_diskon = $('#kodiskxx').val();
				var potongan = $('#potonganxx').val();
				//alert(kode_costum);
				//var tambahan = $('#tambahan').val();
				var qty = $('#qty').val();
				var qty = qty.replace(".","");	
				var total = $('#total').val();
				//var size = $('#size').val();
				//var warna = $('#warna').val();						
				//var stokk = $('#kuantitasxx').text();	
				//alert (kode_costum);
				
				//var anuh = $('#warna').val();
				if (kode_barang.length!=0){
					$.ajax({
					  method: "POST",
					  url: "simpan-transaksi.php",
					  data: { kode_diskon : kode_diskon,potongan : potongan,kode_barang : kode_barang, kode_costum : kode_costum, qty : qty,type:"insert"},					  
					  success	: function(data){
								//	$('#divxx').load('tampil_jual.php').fadeIn("slow");
									document.getElementById("myForm").reset();									
								},
								error: function(response){
									console.log(response.responseText);
								}
					});	
				//	alert('Data tersimpan di list');            		
				}				
				else{
					alert('Kode Barang belum diinput');
					//$('#kode_barang').val("");
				}	
				location.reload(true);	
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
			width:25%;				
			height:500px;
			padding: 0px;
			float:left;
			}
			#kanan
			{
			width:75%;
			height:500px;
			padding: 0px;
			float:right;
			}
		</style>
		<style>
			div.ex1 {
			background-color: lightblue;
			width: 110px;
			height: 110px;
			overflow: scroll;
			}
			div.ex2 {
			background-color: lightblue;
			width: 110px;
			height: 110px;
			overflow: hidden;
			}
			div.ex3aaa {  
			width: 5%;
			height: 100px;
			overflow: auto;
			}
			div.exxxxx3 {  
			width:312px;
			height: 500px;
			overflow-x: hidden;
			overflow-y: hidden;			
			}			
			div.ex3xx {  
			width: 350px;
			height: 420px;
			overflow-x: hidden;
			overflow-y: scroll;	
			}
			div.ex4 {
			background-color: lightblue;
			width: 110px;
			height: 110px;
			overflow: visible;
			}
		</style>
	</head>
	<body>
		<div class="bg">
		<?php 
			error_reporting(0);
			    session_start();	
			if($_SESSION['status']!="login"){
				echo "<script>alert('Anda belum login.....');window.location.href='index?pesan=belum_login';</script>";                    
			}
			else if ($_SESSION['level']!="OWNER" AND $_SESSION['level']!="KASIR" AND $_SESSION['level']!="SPV KASIR"){
				echo "<script>alert('Anda tidak memiliki akses.....');window.location.href='javascript:history.go(-1)';</script>";
			}
			?>
		<h2 align='center' style="background-color:#71b8e4;color:#FFFFFe">DATA TRANSAKSI</h2>
		<h4 align='center' style="background-color:#1d7bb6;color:#FFFFee">- S W E A T E R I N . M E -</h4>
		<br>
		<a style="background-color:#71b8e4;color:#FFFFFe" href="form-transaksi.php"> Kembali ke Data Transaksi </a><br>
		<div id="kiri">	
			<form method="post" id="myForm">
				<div class="table-responsive">
					<div class="form-group">
						<div class="container">
								<div class="ex3xx">
							<table border="0" class="table" cellpadding="2" cellspacing="2" align="left">
									<tr>
										<td colspan=2>
											<input autofocus onkeyup="isi_otomatis()" placeholder="Scan Kode Barang"  type="text" id="kode_barang" class="form-control form-control-lg">
										</td>
									</tr>
									<tr>
										<td colspan=2>
											<input placeholder="Jenis Barang" readonly="readonly" id="semua" class="form-control form-control-sm">
										</td>
									</tr>
									<tr hidden>
										<th>Jenis Barang</th>
										<td>
											<input placeholder="Jenis Barang" readonly="readonly" id="jenis_barang" class="form-control form-control-sm">
										</td>
									<tr hidden>
										<th>Warna</th>
										<td>
											<input placeholder="Warna" readonly="readonly" id="warna" class="form-control form-control-sm">
										</td>
									</tr>
									<tr hidden>
										<th>Size</th>
										<td>
											<input placeholder="Size" readonly="readonly" id="size" class="form-control form-control-sm">
										</td>
									</tr>
									<tr>
										<th>
											<label>Harga Satuan</label>
										</th>
										<td>
											<input value="0" type="text" class="form-control form-control-sm" id="harga_satuan" readonly="readonly">
										</td>
									</tr>
									<tr>
										<th><label>Qty</label></th>
										<td><input value="1" type="text" onchange="totalnya();" id="qty" class="form-control form-control-sm mata-uang" onkeyup="inputTerbilang();">
											<label id="kuantitasxx" name="kuantitasxx" title="Jumlah STOK"></label>
										</td>
									</tr>
									<tr>
										<th><label>Costum</label></th>
										<td><input placeholder="Masukkan Kode Costum" type="text" id="kode_costum" name="kode_costum" class="form-control" onkeyup="cek_costum();"></td>
									</tr>
									<tr>
										<td colspan=2>											
											<input value="Jenis Costum" type="text" id="jenis_costum" name="jenis_costum" class="form-control form-control-sm" readonly="readonly">
										</td>
									</tr>
									<tr hidden>
										<th><label>Jenis Kostum</label></th>
										<td><input value="0" type="text" id="jenis_costum" name="jenis_costum" class="form-control" readonly="readonly"></td>
									</tr>
									<tr>
										<th>Harga Costum</th>
										<td><input value="0" type="text" id="tambahan" class="form-control form-control-sm" readonly="readonly">
											<input value="0" id="harga_costumm" name="harga_costumm" title="Harga Costum per Item" class="form-control form-control-sm" readonly="readonly">
										</td>
									</tr>
									<tr>
										<th><label>Diskon</label></th>
										<td><input type="text" placeholder="Masukkan Kode Promo" onchange="isi_promox()" id="kodiskxx" name="kodiskxx" class="form-control"></td>
									</tr>
									<tr>
										<th>Potongan</th>
										<td><input value="0" type="text" id="potonganxx" class="form-control form-control-sm" readonly="readonly"></td>
									</tr>
									<tr>
										<th><label>Total</label></th>
										<td><input value="0" type="text" readonly="readonly" id="total" class="form-control form-control-sm"></td>
									</tr>
								<br>
								</table>
								</div>
								<br>
								<br>
								<table>
									<tr align='center' width="50%">
										<td width="50%">
											<button onclick="autofocuss()" type="reset" class="btn btn-danger btn-lg btn-block">Batal</button>					   
										</td>
										<td width="50%">
											<button  onclick="autofocuss()" value="simpan" name="input" id="input" class="btn btn-info btn-lg btn-block">Input</button>		
										</td>
									</tr>		
							</table>
						</div>
					</div>
				</div>
			</form>
		</div>
		<script>
			function autofocuss() {
				document.getElementById("kode_barang").focus();
			}
			 
		</script>
		<script type="text/javascript">
			function total_diskon(){		  
				var harga_biasa = document.getElementById('harga_biasa').value;
				var harga_biasa = harga_biasa.replace(".","");			
				var kuantitas = document.getElementById('kuantitas').value;
				var tambahan = document.getElementById('tambahan').value;
				var diskon = document.getElementById('diskon').value;				
				var potongan = document.getElementById('potongan').value;				
				var total_tanpadisk = parseInt(harga_biasa)*parseInt(kuantitas);
				var diskon2 = parseInt(diskon) * parseInt(total_tanpadisk);
				potongan = Number(potongan)*Number(kuantitas);
				//var hasil = total_tanpadisk - (total_tanpadisk*(parseInt(diskon)/100)) - parseInt(potongan);
				var hasil = total_tanpadisk - (total_tanpadisk*(parseInt(diskon)/100)) - parseInt(potongan);
				//var hasil = total_tanpadisk - (total_tanpadisk*(parseInt(diskon)/100));
			//				var hasil = total_tanpadisk - parseInt(potongan) - parseInt(diskon2);
				document.getElementById("totalx").value = hasil;
			//	alert('Anda menekan tombol TAB');							
			 }			   
			 function totalnya(){		  
				var harga_biasa = document.getElementById('harga_satuan').value;
			//	var harga_biasa = harga_biasa.replace(".","");			
				var kuantitas = document.getElementById('qty').value;
				var kuantitas = kuantitas.replace(".","");	
				//var diskon = document.getElementById('diskon').value;				
				var potongan = document.getElementById('potonganxx').value;				
				var tambahan = document.getElementById('tambahan').value;				
				//var potongan = document.getElementById('potongan').value;				
				//var total_tanpadisk = parseInt(harga_biasa) * parseInt(kuantitas);					
				
				
				var hargcost = document.getElementById('harga_costumm').value;		
				var tot_tambahan = Number(kuantitas) * Number(hargcost);
				document.getElementById("tambahan").value = tot_tambahan;
				
				var total_tanpadisk = (Number(harga) * Number(kuantitas)) + (Number(tambahan)*Number(kuantitas)) - Number(potongan);
				//var hargcost = document.getElementById('harga_costumm').value;
			//	var diskon2 = parseInt(diskon) * parseInt(total_tanpadisk);
			//		potongan = Number(potongan)*Number(kuantitas);
				//var hasil = total_tanpadisk - (total_tanpadisk*(parseInt(diskon)/100)) - parseInt(potongan);
				var hasil = total_tanpadisk;
				//var hasil = total_tanpadisk - (total_tanpadisk*(parseInt(diskon)/100));
			//				var hasil = total_tanpadisk - parseInt(potongan) - parseInt(diskon2);
				document.getElementById("total").value = hasil;
				alert('MANTAP');							
			 }		
			 
		</script>
		<div id="kanan">
			<div><?php include"tampil-transaksi.php"; ?>
			</div>
		</div>
		<script src="js/jquery-1.11.2.min.js"></script>
		<script src="js/jquery.mask.min.js"></script>
		<script src="js/terbilang.js"></script>
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
			function selectnya(){
			 document.getElementById("opsi_kostum").focus();
			}			   
		</script>		
		<script type="text/javascript">
			function select(){			   
			document.getElementById("jenisx").focus();							
			}
		</script>
	</body>
</html>