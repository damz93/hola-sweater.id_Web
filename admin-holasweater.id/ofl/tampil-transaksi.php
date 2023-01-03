<?php
	//error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
	error_reporting(0);
	  include 'koneksi.php';
	  ?>
<html>
	<head>
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
			function isi_promo(){			   
			var kode_promo = $("#kodisk").val();
			$.ajax({
			url: 'list-promo.php',
			method: 'GET',
			data     : 'kode_promo='+kode_promo,
			}).success(function (data) {
			 var json = data,
			 obj = JSON.parse(json);
			 $('#nomdiskon').val(obj.nominal);
			 $('#harga_satuan').val(obj.nominal);
			var diskon = $('#nomdiskon').val(); 
			var ongkirr = $('#ongkir').val(); 
			if (kode_promo == ""){
				//alert('HAH KOSONG');	
				$('#nomdiskon').val("0");	
				document.getElementById("kodisk").focus();	
			}
			else if (diskon == ""){	
				$('#nomdiskon').val("0");	
				alert('Kode Promo tidak Valid');		
				document.getElementById("kodisk").focus();				
				
			}
			else{
				document.getElementById("jumlah_pembayaran").focus();				
				 var ongkirr = ongkirr.replace(".","");
				 if (ongkirr ==""){
					document.getElementById("ongkir").value = "0";
					ongkirr = 0;
				 }		 
				 var total_barang = document.getElementById('totalhargaces').innerHTML;
				 var total = parseInt(total_barang)+parseInt(ongkirr)-parseInt(diskon);
				 document.getElementById("totalhargaces2fix").innerHTML = total;
				 var hemm = total.toFixed().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
				 document.getElementById("totalhargaces2").innerHTML = "Total Harga= Rp"+hemm;		 	
				
			}
			}).autocomplete({
			//source: "list-namabarang.php",
			});
			}
		</script> 
		<script type="text/javascript">
			function isi_promo2(a, b, aak){			   
			//var kode_promo = $("#kodisk2").val();
			//var kode_promo = c;	
				var kode_barang=a;		
				var qty = b;		
				var kode_promo = aak;					
			$.ajax({
				url: 'list-promo.php',
				method: 'GET',
				data     : 'kode_promo='+kode_promo,
				}).success(function (data) {
					 var json = data,
					 obj = JSON.parse(json);
					 $('#nomdiskon2').val(obj.nominal);
					var diskon = $('#nomdiskon2').val(); 
					if (kode_promo == ""){					
						$('#nomdiskon').val("0");	
						document.getElementById("kodisk2").focus();	
					}
					else if (diskon == ""){	
						$('#nomdiskon2').val("0");	
						$('#kodisk2').val("0");	
						alert('Kode Diskon tidak valid');		
						document.getElementById("kodisk2").focus();									
					}
					else{
						//alert('YUK,... GASKEUN...');
						update_data(kode_barang, qty, kode_promo);
					}
					}).autocomplete({
					//source: "list-namabarang.php",
				});
			}
		</script>
		<script type="text/javascript">
			function update_data(c, d, e){
			var kode_barang=c;		
			var qty = d;		
			var kodprom = e;					
			$.ajax({
			  type: "get",
			  url: "update-transaksi-detail2.php",
			  data: {kode_barang:kode_barang, qty:qty, kodprom:kodprom},
			  success: function(value){
				//$("#data_table").html(value);
				 location.reload(true);
				//document.getElementById("form_tampil").reset();		
			  }
			});
			}
		</script>
		<script type="text/javascript">
			function edit_qty(c, d){
			var kode_barang=c;		
			var qty = d;					
			$.ajax({
			  type: "get",
			  url: "update-transaksi-detail.php",
			  data: {kode_barang:kode_barang, qty:qty},
			  success: function(value){
				//$("#data_table").html(value);
				 location.reload(true);
				//document.getElementById("form_tampil").reset();		
			  }
			});
			}
		</script>
		<script type="text/javascript">
			function edit_qtyy(c, d, e){
			var kode_barang=c;		
			var qty = d;			
			var tambahan =e;
			$.ajax({
			  type: "get",
			  url: "update-transaksi-detail.php",
			  data: {kode_barang:kode_barang, qty:qty, tambahan:tambahan},
			  success: function(value){
				//$("#data_table").html(value);
				 location.reload(true);
				//document.getElementById("form_tampil").reset();		
			  }
			});
			}
		</script>
		<script type="text/javascript">
			function cek_kodetransaksi(){			   
			var kode_transaksi = $("#kode_transaksi").val();
			$.ajax({
			url: 'list-kode-transaksi.php',
			method: 'GET',
			data     : 'kode_transaksi='+kode_transaksi,
			}).success(function (data) {
			 var json = data,
			 obj = JSON.parse(json);
			 $('#kode_transaksi2').val(obj.kode_transaksi);
			 
			var kod1 = $('#kode_transaksi').val(); 
			var kod2 = $('#kode_transaksi2').val(); 
			if (kod1 == kod2){
				alert('Kode transaksi sudah ada....');					
				document.getElementById("kode_transaksi").focus();	
				document.getElementById("kode_transaksi2").value = "Kode transaksi sudah ada...."; 
			}
			}).autocomplete({
			//source: "list-namabarang.php",
			});
			}
		</script>
		<script>
			function aa() {
				//<form method="post" action="simpan_barang.php" onsubmit="return confirm('Yakin ingin simpan?');">
				//var str = document.getElementById("demo").innerHTML; 
			  //var res = str.replace("Microsoft", "W3Schools");
			  //document.getElementById("demo").innerHTML = res;
			  //var totharga = document.forms["myff2"]["totalhargaces"].value;
			  var totharga = document.getElementById("total_bersih").textContent; 
			  var totbay = document.getElementById("jumlah_pembayaran").value; 
			  //var totharga = document.forms["myff2"]["totalhargaces"].value;
			  //var totbay = document.forms["myff2"]["jumlah_pembayaran"].value;
			  //var totbay = document.forms["myff2"]["jumlah_pembayaran"].value;  
			  //alert('total bayar---------: '+ totbay);	
			  if(totbay==""){
				  alert('Masukkan jumlah pembayaran');	
				  document.getElementById("jumlah_pembayaran").focus();
				  return false;
			  }
				else{
					var totbay2 = totbay.replace(".","");  
					var totbay2 = totbay2.replace(".","");  
				  if (parseInt(totbay2)<parseInt(totharga)) {		
					alert("Jumlah pembayaran kurang");
					document.getElementById("jumlah_pembayaran").focus();
					return false;
				  }
				  else{
					  return confirm('Yakin ingin simpan?');
				  }//action="cetak_jual.php"
				}
			}
			
		</script> 
		<script>
			function sebelum() {         	
			  var kode_transaksi = document.getElementById("kode_transaksi").value; 
			  if(kode_transaksi==""){
				  alert('Masukkan Kode Transaksi');	
				  document.getElementById("kode_transaksi").focus();
				  return false;
			  }
				else{
			return confirm('Yakin ingin simpan?');         	 
				}
			}
			
		</script>
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
			div.ex3 {  
			width: 1120px;
			height: 180px;
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
		<script type="text/javascript">
			function delete_data(d){
			var kode_barang=d;		
			if (confirm("Are you sure you want to delete this Item?")) {			
			$.ajax({
			  type: "get",
			  url: "hapus-transaksi-detail.php",
			  data: {kode_barang:kode_barang},
			  success: function(value){
				//$("#data_table").html(value);
				 location.reload(true);
				//document.getElementById("form_tampil").reset();		
			  }
			});
			}
			else{
			return false;
			}
			}
		</script>
		<script type="text/javascript">
			function delete_dataa(d,e){
			var kode_barang=d;		
			var tambahan=e;		
			if (confirm("Are you sure you want to delete this Item?")) {			
			$.ajax({
			  type: "get",
			  url: "hapus-transaksi-detail.php",
			  data: {kode_barang:kode_barang, tambahan:tambahan},
			  success: function(value){
				//$("#data_table").html(value);
				 location.reload(true);
				//document.getElementById("form_tampil").reset();		
			  }
			});
			}
			else{
			return false;
			}
			}
		</script>
	</head>
	<body>
		<!--<form method="post" action="cetak-transaksi.php" autocomplete="off" onsubmit="return confirm('Yakin ingin simpan?');">	-->
		<form method="post" onsubmit="return aa()" name="myForm" action="cetak-transaksi.php">
			<div class="table-responsive">
			<div class="form-group">
				<div class="container">
				
				<div class="ex3">
					<table border="0" class="table" cellpadding="2" cellspacing="2" align=center>
						<thead align="center">
							<tr align='center' class="table-info">
								<th width="1%">No</th>
								<th width="15%">Kode Barang</th>
								<th>Harga Satuan</th>
								<th width="8%">Qty</th>
								<th>Biaya Costum</th>
								<th hidden>Kode Diskon</th>
								<th>Diskon</th>
								<th hidden>Total Diskon</th>
								<th>Jumlah</th>
								<th width="3%">Aksi</th>
							</tr>
						</thead>
						<?php 
							session_start();
							$oleh = $_SESSION['username'];
							$no=1;
							$harga3=0;
							$harga4=0;							
							$totpcs=0;
							$aray = 0;
							$total_harga_barang = 0;
							$total_biaya_costum = 0;
							$total_diskon = 0;
							$total_keselurahan =0;
							$diskonxx2=0;
							$totdiskon2 = 0;							
							$diskon2nya2=0;
							$data = mysqli_query($koneksi,"select * from t_transaksi_temp where OLEH='".$oleh."' order by ID DESC");
							while($d = mysqli_fetch_array($data)){
							//$qty=number_format($d['QTY'],0,",",".");
							    $qty=$d['QTY'];                                     
							    $qtyno=$d['QTY'];                                     
							$kod_bar = $d['KODE_BARANG'];
							$kodisk2 = $d['KODE_DISKON'];
							$diskonnya = $d['DISKON'];
							$diskonxx = $d['POTONGAN'];
							$totdiskon = $d['DISKON2'];
							$total2 = $d['TOTAL2'];
							$total_harga_barang = $total_harga_barang + $d['TOTAL'];
							$total_biaya_costum = $total_biaya_costum + $d['HARGA_TAMBAHAN'];
							$total_diskon = $total_diskon + $d['POTONGAN'];
							$satuan=number_format($d['HARGA'],0,",",".");
							$diskonnyatamp=number_format($d['POTONGAN'],0,",",".");
							$totdiskontamp=number_format($d['DISKON2'],0,",",".");
							$tambah=number_format($d['HARGA_TAMBAHAN'],0,",",".");
							
							$total=number_format($d['TOTAL'],0,",",".");
							$total2tamp=number_format($d['TOTAL2'],0,",",".");
							$harga3=$harga3+$d['TOTAL'];
							$harga4=$harga4+$d['TOTAL2'];
							$totpcs = $totpcs+$qtyno;
							$tamb_cost = $total2 - ($qty * $d['HARGA']) + $d['DISKON'];
							$tambahan = $d['HARGA_TAMBAHAN'];
							
							$tamb_costtamp=number_format($tamb_cost,0,",",".");
							$tambahantamp=number_format($tambahan,0,",",".");
							?>
						<tr align="center">
							<td><?php echo $no++; ?></td>
							<td><?php echo $kod_bar; ?></td>
							<td><?php echo "Rp".$satuan; ?></td>
							<td><input style="text-align:center;" name="qty_<?php echo $kod_bar;?>" id="qty" onchange="edit_qtyy('<?php echo $kod_bar;?>', this.value,'<?php echo $tambahan;?>');" value="<?php echo $qty; ?>" type="text" onclick="totalx()" class="form-control form-control-sm mata-uang" onkeyup="inputTerbilang();" maxlength="4"></td>
												
							<td><?php echo "Rp".$tambahantamp; ?></td>
							<td hidden><input type="text" placeholder="Scan Kode Promo" id="kodisk2" class="form-control form-control-sm" maxlength="30" onchange="isi_promo2('<?php echo $kod_bar; ?>','<?php echo $qty; ?>', this.value);" value="<?php echo $kodisk2; ?>" name="kodisk_<?php echo $kod_bar;?>" >
								<input hidden readonly="readonly" class="form-control form-control-sm" type="text" name="nomdiskon2" id="nomdiskon2" value="<?php echo $diskonnya; ?>">
							</td>
							<td><?php echo "Rp".$diskonnyatamp;  ?></td>
							<td hidden><?php echo "Rp".$totdiskontamp;  ?></td>
							<td><?php echo "Rp".$total2tamp;  ?></td>
							<td>
								<!--<a href='update-transaksi-detail.php?kode_barang=<?php echo $kod_bar."&qty=".$qty; ?>' id="edit_<?php echo $kod_bar;?>" title="Edit Item" onclick="return confirm('Are you sure you want to update qty?')"><img src="img/edit.png" height="50%" ></a>
									<a href='hapus-transaksi-detail.php?kode_barang=<?php echo $kod_bar; ?>' title="Delete Item" onclick="return confirm('Are you sure you want to delete?')"><img src="img/delete.png" height="50%" ></a>-->
								<a class="btn btn-danger" onclick="delete_dataa('<?php echo $kod_bar; ?>','<?php echo $tambahan; ?>')" title="Delete Item"><img src="img/delete.png" height="50%" ></a>
							</td>
						</tr>
						<?php 
							$aray++;
							$diskonnya2 = $diskonnya2 + $diskonnya;
							$totdiskon2 = $totdiskon2 + $totdiskon;
							$total_bersihnya = $harga3 - $totdiskon2;
							$diskonxx2 = $diskonxx + $diskonxx2;
							                    }
							                    $harga5=number_format($harga3,0,",",".");	
							                    $totdiskon2tamp=number_format($totdiskon2,0,",",".");	
							                    $diskonxx2tamp=number_format($diskonxx2,0,",",".");	
							                    $total_bersihnyatamp=number_format($total_bersihnya,0,",",".");	
												
												$total_harga_barang = $total_harga_barang + $d['TOTAL'];
							                    $total_harga_barangtamp=number_format($total_harga_barang,0,",",".");	
												$total_biaya_costum = $total_biaya_costum + $d['HARGA_TAMBAHAN'];
							                    $total_biaya_costumtamp=number_format($total_biaya_costum,0,",",".");	
												$total_diskon = $total_diskon + $d['POTONGAN'];
							                    $total_diskontamp=number_format($total_diskon,0,",",".");	
												$total_bersih = $total_harga_barang + $total_biaya_costum - $total_diskon;
							                    $total_bersihtamp=number_format($total_bersih,0,",",".");	
												
												
							$totpcs_tamp=number_format($totpcs,0,",",".");							   
							                    ?>
						<tr>
							<td colspan="10">
								<p align='right'>
									<?php echo $totpcs_tamp."(qty)"; ?>
								</p>
							</td>
						</tr>
					</table>
					</div>
					<table border="0" class="table" cellpadding="2" cellspacing="2" align=center>
						<div class="form-group">
							<tr>
								<td colspan="4" align="right"></td>
								<td><label hidden name="total_harga_barang" id="total_harga_barang"><?php echo $total_harga_barang; ?></label></td>
								<td width="2%"></td>
								<td>
									<h6 align='right'><?php echo "Total Harga Barang= Rp".$total_harga_barangtamp; ?></h6>
								</td>
							</tr>
							<tr>
								<td colspan="4" align="right"></td>
								<td><label hidden name="total_biaya_costum" id="total_biaya_costum"><?php echo $total_biaya_costum; ?></label></td>
								<td width="2%"></td>
								<td>
									<h6 align='right'><?php echo "Total Biaya Tambahan= Rp".$total_biaya_costumtamp; ?></h6>
								</td>
							</tr>
							
							<tr>
								<td colspan="4" align="right"></td>
								<td><label hidden name="total_diskon" id="total_diskon"><?php echo $total_diskon; ?></label></td>
								<td width="2%"></td>
								<td>
									<h6 align='right'><?php echo "Total Diskon= Rp".$total_diskontamp; ?></h6>
								</td>
							</tr>
							<tr>
								<td colspan="4" align="right"></td>
								<td><label hidden name="total_bersih" id="total_bersih"><?php echo $total_bersih; ?></label></td>
								<td width="2%"></td>
								<td>
									<h6 align='right'><?php echo "Total Harga= Rp".$total_bersihtamp; ?></h6>
								</td>
							</tr>
							<tr hidden>
								<td colspan="5" align="right">
									<h6>Ongkos Kirim </h6>
								</td>
								<td align="right"><label>Rp</label></td>
								<td align="left"><input type="text" value="0" id="ongkir" class="form-control form-control-sm mata-uang" maxlength="7" onchange="totalx();" onkeyup="totalx();" name="ongkir"></td>
							</tr>
							<tr hidden>
								<td colspan="6" align="right">
									<h6>Kode Promo</h6>
								</td>
								<td align="left">
									<input type="text" placeholder="Scan Kode Promo" id="kodisk" class="form-control form-control-sm" maxlength="30" onkeyup="isi_promo()" name="kodisk">Nominal
									<input readonly="readonly" class="form-control form-control-sm" type="text" name="nomdiskon" id="nomdiskon" value="<?php echo $diskonnya; ?>">
								</td>
							</tr>
							<tr hidden>
								<td colspan="7" align="right">
									<h5 align="right"><label name="totalhargaces2" id="totalhargaces2"><?php echo "Total Harga= Rp".$total_bersihnyatamp; ?></label></h5>
									<label hidden name="totalhargaces2fix"id="totalhargaces2fix"></label>				
								</td>
							<tr hidden>
								<td colspan="6"	 align="right">
									<h6>Kode Transaksi</h6>
								</td>
								<td align="left"><input type="text" placeholder="Input/Scan Kode Transaksi" value="0" onkeyup="cek_kodetransaksi();" id="kode_transaksi" maxlength="8" name="kode_transaksi" class="form-control form-control-sm">
									<input hidden type="text" placeholder="kode..." readonly="readonly" id="kode_transaksi2" maxlength="8" name="kode_transaksi2" class="form-control form-control-sm">
								</td>
							</tr>
							<tr>
								<td colspan="5"	 align="right">
									<h6>Jumlah Pembayaran</h6>
								</td>
								<td align="right"><label>Rp</label></td>
								<td align="left"><input type="text" value="0" id="jumlah_pembayaran" maxlength="8" onkeyup="total_kembali();" name="jumlah_pembayaran" class="form-control form-control-lg mata-uang">
								</td>
							</tr>
							<tr>
								<td colspan="2"	 align="right">
									<h6>Kembali</h6>
								</td>
								<td colspan="4" align="right">
									<h4 align="left"><label name="kembalian" id="kembalian">Rp0</label></h4></td>
								</td>
								<td>
									<button width="100%" type="submit" value="simpan" class="btn btn-info btn-lg btn-block">Proses</button>
								</td>
							</tr>			
						</div>
					</table>
				</div>
			</div>
		</div>
		</form>
		<script type="text/javascript">
			function totalx(){		  
			 $('.mata-uang').mask('0.000.000.000', {reverse: true});
			
			  //mengambil data uang yang akan dirubah jadi terbilang
			   //var input = document.getElementById("terbilang-input").value.replace(/\./g, "");
			
			   //menampilkan hasil dari terbilang
			   //document.getElementById("terbilang-output").value = terbilang(input).replace(/  +/g, ' ');
			   
			var total_barang = document.getElementById('totalhargaces').innerHTML;
			var ongkirr = document.getElementById('ongkir').value;
			var diskon = document.getElementById('nomdiskon3').innerHTML;
			var ongkirr = ongkirr.replace(".","");
			if (ongkirr ==""){
				document.getElementById("ongkir").value = "0";
				ongkirr = 0;
			}		 
			var total = parseInt(total_barang)+parseInt(ongkirr)-parseInt(diskon);
			//var hemm = total.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
			//x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
			document.getElementById("totalhargaces2fix").innerHTML = total;
			var hemm = total.toFixed().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
			document.getElementById("totalhargaces2").innerHTML = "Total Harga= Rp"+hemm;		 	
			//  document.getElementById("totalhargaces").innerHTML = ";		 	                 
			}		         
		</script>
		<script type="text/javascript">
			function total_kembali(){		  
				 $('.mata-uang').mask('0.000.000.000', {reverse: true});
				
				  //mengambil data uang yang akan dirubah jadi terbilang
				   //var input = document.getElementById("terbilang-input").value.replace(/\./g, "");
				
				   //menampilkan hasil dari terbilang
				   //document.getElementById("terbilang-output").value = terbilang(input).replace(/  +/g, ' ');
				 //alert('jalanji'); 
				
				var total_bersih = document.getElementById('total_bersih').innerHTML;
				var total_bayarx = document.getElementById('jumlah_pembayaran').value;				
				//var total_bayar = $('#jumlah_pembayaran').val(); 				
				var total_bayar = total_bayarx.replace(".","");
				total_bayar = total_bayar.replace(".","");
				total_bayar = total_bayar.replace(".","");
				if (total_bayar == ""){
					document.getElementById('jumlah_pembayaran').value="0";
					total_bayar=0;
					//alert('0');
				}
				
					var kembali = parseInt(total_bayar) - parseInt(total_bersih);
					var hemm = kembali.toFixed().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
					document.getElementById("kembalian").innerHTML = "Rp"+hemm;				
				
			}		         
		</script>
		<script>
			function editurl(kod_bar, qty) {
			   var link = document.getElementById("edit_"+kod_bar);
			  // link.setAttribute("href","update-transaksi-detail.php?kode_barang="+kod_bar+"&qty="+qty);	  
			var linkkk = "update-transaksi-detail.php?kode_barang="+kod_bar+"&qty="+qty;
			window.location.href = linkkk;
			}
		</script>
	</body>
</html>