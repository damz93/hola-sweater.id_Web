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
		<title>Input Transaksi - T O K O N L I N E</title>
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
			var kuannn = $('#qty').val(); 		
			var kuant = (obj.qty);					
		//	var diskon = $('#diskon').val(); 
			//var potongan = $('#potongan').val(); 
			var totaltanpa = Number(harga) * Number(kuannn);
		//	potongan = Number(potongan)*Number(kuannn);
			//var hasil = Number(totaltanpa) - (Number(totaltanpa)*(Number(diskon)/100)) - Number(potongan);
			var hasil = Number(totaltanpa);
			//document.getElementById('kuantitasxx').innerHTML = 'Stok: '+(kuannn);					
			document.getElementById('kuantitasxx').innerHTML = kuant;		
			$('#total').val(hasil); 
			var anuh = $('#total').val();
			//alert(anuh);
			
			if (anuh.length == 1){
				//alert('Barang yang discan belum diinput');
				document.getElementById("kode_barang").focus();
			}
			else{
				//alert('OK!');
				document.getElementById("tambahan").focus();
			}
			//document.getElementById("kuantitas").focus();
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
				var jenis_barang = $('#jenis_barang').val();
				var harga_satuan = $('#harga_satuan').val();
				var tambahan = $('#tambahan').val();
				var qty = $('#qty').val();
				var total = $('#total').val();
				var size = $('#size').val();
				var warna = $('#warna').val();		
				
				var stokk = $('#kuantitasxx').text();	
				if (kode_barang=="") {
					alert('Scan Kode Barang/Isi manual terlebih dahulug');
				}
				else if (Number(qty)>Number(stokk)){
					alert('Stok tidak cukup, perhatikan inputan kuantitas');
					document.getElementById("qty").focus();
					return false;
				}
				else if (Number(stokk)==0){
				alert('Stok barang kosong');
				}
				
				else{
					alert('Data tersimpan di list');            		
					$.ajax({
					  method: "POST",
					  url: "simpan-transaksi.php",
					  data: { kode_barang : kode_barang, jenis_barang : jenis_barang, harga_satuan : harga_satuan, tambahan : tambahan, qty : qty, total : total, size : size, warna : warna,type:"insert"},
					  success	: function(data){
								//	$('#divxx').load('tampil_jual.php').fadeIn("slow");
									document.getElementById("myForm").reset();									
								},
								error: function(response){
									console.log(response.responseText);
								}
					});	
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
			width:35%;				
			height:650px;
			padding: 0px;
			float:left;
			}
			#kanan
			{
			width:65%;
			height:650px;
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
			width:500px;
			height: 650px;
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
			if($_SESSION['status']!="login"){
				echo "<script>alert('Anda Harus Login untuk mengakses halaman ini');window.location.href='index.php?pesan=belum_login';</script>";
				//header("location:index.php?pesan=belum_login");
			}
			?>
		<h1 align='center' style="background-color:#71b8e4;color:#FFFFFe">DATA TRANSAKSI</h1>
		<h3 align='center' style="background-color:#1d7bb6;color:#FFFFee">- T O K O N L I N E -</h3>
		<br>
		<a style="background-color:#71b8e4;color:#FFFFFe" href="form-transaksi.php"> Kembali ke Data Transaksi </a><br>
		<div id="kiri">			
			<br>	 			
			<form method="post" id="myForm">
			<div class="exxxxx3">
				<div class="table-responsive">
						<div class="form-group">
							<div class="container">
								<div class="form-group">
									<table border="0" class="table" cellpadding="2" cellspacing="2" align="left">
										<tr>
											<th>Kode Barang</th>
											<td>
												<input autofocus onchange="isi_otomatis()" placeholder="Kode Barang"  type="text" id="kode_barang" class="form-control form-control-sm">
											</td>
										</tr>
										<!--					
											<tr>
											    <th>Jenis Kostum</th>
											    <th>
											        <select name="jenisx" id="jenisx" onchange="selectnya()" class="form-control form-control-sm">
											            <option value="BORDIR">Bordir</option>
											            <option value="SABLON" selected>Sablon</option>
											        </select>
											        <script type="text/javascript">
											            document.getElementById('jenisx').value = "<?php if ($_POST['jenisx']==''){ echo 'BORDIR';} else {echo $_POST['jenisx'];}?>";
											        </script>
											    </th>
											</tr>-->
										<tr>
											<th>Jenis Barang</th>
											<td>
												<input placeholder="Jenis Barang" readonly="readonly" id="jenis_barang" class="form-control form-control-sm">
											</td>
										</tr>
										<tr>
											<th>Warna</th>
											<td>
												<input placeholder="Warna" readonly="readonly" id="warna" class="form-control form-control-sm">
											</td>
										</tr>
										<tr>
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
											<th><label>Biaya Tambahan</label></th>
											<td><input value="0" type="text" id="tambahan" onchange="totalnya();" class="form-control form-control-sm mata-uang" onkeyup="inputTerbilang(); "></td>
										</tr>
										<tr>
											<th><label>Qty</label></th>
											<td><input value="1" type="text" onchange="totalnya();" id="qty" class="form-control form-control-sm mata-uang" onkeyup="inputTerbilang();">
											<label id="kuantitasxx" name="kuantitasxx" title="Jumlah STOK"></label></td>
										</tr>
										<tr>
											<th><label>Total</label></th>
											<td><input value="0" type="text" readonly="readonly" id="total" class="form-control form-control-sm"></td>
										</tr>
										<tr align='center'>
											<th align='right' colspan="2">
												<button  onclick="autofocuss()" value="simpan" name="input" id="input" class="btn btn-info btn-lg btn-block">Input</button>		
												<button onclick="autofocuss()" type="reset" class="btn btn-danger btn-lg btn-block">Batal</button>					   
											</th>
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
					document.getElementById("jenisx").focus();
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
					//var diskon = document.getElementById('diskon').value;				
					var tambahan = document.getElementById('tambahan').value;				
					//var potongan = document.getElementById('potongan').value;				
					//var total_tanpadisk = parseInt(harga_biasa) * parseInt(kuantitas);
					var total_tanpadisk = Number(harga_biasa) * Number(kuantitas) + Number(tambahan);
				//	var diskon2 = parseInt(diskon) * parseInt(total_tanpadisk);
			//		potongan = Number(potongan)*Number(kuantitas);
					//var hasil = total_tanpadisk - (total_tanpadisk*(parseInt(diskon)/100)) - parseInt(potongan);
					var hasil = total_tanpadisk;
					//var hasil = total_tanpadisk - (total_tanpadisk*(parseInt(diskon)/100));
				//				var hasil = total_tanpadisk - parseInt(potongan) - parseInt(diskon2);
					document.getElementById("total").value = hasil;
				//	alert('Anda menekan tombol TAB');							
				 }		
				 
			</script>
		</div>
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