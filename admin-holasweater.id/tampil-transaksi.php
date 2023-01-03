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
						alert('Kode Promo tidak Valid');		
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
			  var totharga = document.getElementById("totalhargaces2fix").textContent; 
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
			height: 500px;
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
	</head>
	<body>
		<div class="ex3">
		<form method="post" action="simpan-trsk.php" autocomplete="off" onsubmit="return confirm('Yakin ingin simpan?');">	
			<div class="table-responsive">
			<div class="form-group">
				<div class="container">
					<table border="0" class="table" cellpadding="2" cellspacing="2" align=center>
						<thead align="center">
							<tr align='center' class="table-info">
								<th width="1%">No</th>
								<th width="15%">Kode Barang</th>
								<th>Harga Satuan</th>
								<th width="8%">Qty</th>
								<th>Total</th>
								<th>Kode Diskon</th>
								<th>Diskon per Item</th>
								<th>Total Diskon</th>
								<th>Total Bersih</th>
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
							$kod_trs = $_POST['kode_transaksi'];
							$totdiskon2 = 0;							
							$diskon2nya2=0;
							$data = mysqli_query($koneksi,"select * from t_transaksi_temp where OLEH='".$oleh."' AND KODE_TRANSAKSI='".$kod_trs."' order by ID DESC");
							while($d = mysqli_fetch_array($data)){
							//$qty=number_format($d['QTY'],0,",",".");
							    $qty=$d['QTY'];                                     
							    $qtyno=$d['QTY'];                                     
							$kod_bar = $d['KODE_BARANG'];
							$kodisk2 = $d['KODE_DISKON'];
							$diskonnya = $d['DISKON'];
							$totdiskon = $d['DISKON2'];
							$total2 = $d['TOTAL2'];
							$satuan=number_format($d['HARGA'],0,",",".");
							$diskonnyatamp=number_format($d['DISKON'],0,",",".");
							$totdiskontamp=number_format($d['DISKON2'],0,",",".");
							$tambah=number_format($d['HARGA_TAMBAHAN'],0,",",".");
							$total=number_format($d['TOTAL'],0,",",".");
							$total2tamp=number_format($d['TOTAL2'],0,",",".");
							$harga3=$harga3+$d['TOTAL'];
							$harga4=$harga4+$d['TOTAL2'];
							$totpcs = $totpcs+$qtyno;
							?>
						<tr align="center">
							<td><?php echo $no++; ?></td>
							<td><?php echo $kod_bar; ?></td>
							<td><?php echo "Rp".$satuan; ?></td>
							<td><input style="text-align:center;" name="qty_<?php echo $kod_bar;?>" id="qty" onchange="edit_qty('<?php echo $kod_bar;?>', this.value);" value="<?php echo $qty; ?>" type="text" onclick="totalx()" class="form-control form-control-sm mata-uang" onkeyup="inputTerbilang();" maxlength="4"></td>
							<td><?php echo "Rp".$total;  ?></td>
							<td><input type="text" placeholder="Scan Kode Promo" id="kodisk2" class="form-control form-control-sm" maxlength="30" onchange="isi_promo2('<?php echo $kod_bar; ?>','<?php echo $qty; ?>', this.value);" value="<?php echo $kodisk2; ?>" name="kodisk_<?php echo $kod_bar;?>" >
								<input hidden readonly="readonly" class="form-control form-control-sm" type="text" name="nomdiskon2" id="nomdiskon2" value="<?php echo $diskonnya; ?>">
							</td>
							<td><?php echo "Rp".$diskonnyatamp;  ?></td>
							<td><?php echo "Rp".$totdiskontamp;  ?></td>
							<td><?php echo "Rp".$total2tamp;  ?></td>
							<td>
								<!--<a href='update-transaksi-detail.php?kode_barang=<?php echo $kod_bar."&qty=".$qty; ?>' id="edit_<?php echo $kod_bar;?>" title="Edit Item" onclick="return confirm('Are you sure you want to update qty?')"><img src="img/edit.png" height="50%" ></a>
									<a href='hapus-transaksi-detail.php?kode_barang=<?php echo $kod_bar; ?>' title="Delete Item" onclick="return confirm('Are you sure you want to delete?')"><img src="img/delete.png" height="50%" ></a>-->
								<a class="btn btn-danger" onclick="delete_data('<?php echo $kod_bar; ?>')" title="Delete Item"><img src="img/delete.png" height="50%" ></a>
							</td>
						</tr>
						<?php 
							$aray++;
							$diskonnya2 = $diskonnya2 + $diskonnya;
							$totdiskon2 = $totdiskon2 + $totdiskon;
							$total_bersihnya = $harga3 - $totdiskon2;
							                    }
							                    $harga5=number_format($harga3,0,",",".");	
							                    $totdiskon2tamp=number_format($totdiskon2,0,",",".");	
							                    $total_bersihnyatamp=number_format($total_bersihnya,0,",",".");	
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
					<table border="0" class="table" cellpadding="2" cellspacing="2" align=center>
						<div class="form-group">
							<tr>
								<td colspan="4" align="right"></td>
								<td><label hidden name="totalhargaces" id="totalhargaces"><?php echo $harga3; ?></label></td>
								<td width="2%"></td>
								<td>
									<h6 align='right'><?php echo "Total Harga Barang= Rp".$harga5; ?></h6>
								</td>
							</tr>
							<tr>
								<td colspan="4" align="right"></td>
								<td><label hidden name="nomdiskon3" id="nomdiskon3"><?php echo $totdiskon2; ?></label></td>
								<td width="2%"></td>
								<td>
									<h6 align='right'><?php echo "Total Diskon= Rp".$totdiskon2tamp; ?></h6>
								</td>
							</tr>
							<tr>
								<td colspan="4" align="right"></td>
								<td><label hidden name="totalhargaces" id="totalhargaces"><?php echo $harga3; ?></label></td>
								<td width="2%"></td>
								<td>
									<h6 align='right'><?php echo "Total Bersih= Rp".$total_bersihnyatamp; ?></h6>
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
							<tr>
								<td colspan="7" align="right">
									<h5 align="right"><label name="totalhargaces2" id="totalhargaces2"><?php echo "Total Harga= Rp".$total_bersihnyatamp; ?></label></h5>
									<label hidden name="totalhargaces2fix"id="totalhargaces2fix"></label>				
								</td>
							<tr hidden>
								<td colspan="6"	 align="right">
									<h6>Kode Transaksi</h6>
								</td>
								<td align="left"><input value="<?php echo $kod_trs; ?>" type="text" placeholder="Input/Scan Kode Transaksi" onkeyup="cek_kodetransaksi();" id="kode_transaksi" maxlength="8" name="kode_transaksi" class="form-control form-control-sm">
									<input hidden type="text" placeholder="kode..." readonly="readonly" id="kode_transaksi2" maxlength="8" name="kode_transaksi2" class="form-control form-control-sm">
								</td>
							</tr>
							<tr hidden>
								<td colspan="5"	 align="right">
									<h6>Jumlah Pembayaran</h6>
								</td>
								<td align="right"><label>Rp</label></td>
								<td align="left"><input type="text" value="0" id="jumlah_pembayaran" maxlength="8" onkeyup="inputTerbilang();" name="jumlah_pembayaran" class="form-control form-control-sm mata-uang">
								</td>
							</tr>
							<tr>
								<td colspan="7">
									<button width="100%" type="submit" value="simpan" class="btn btn-info btn-lg btn-block">Proses</button>												
								</td>
							</tr>
					</table>
					</div>
				</div>
		</form>
		</div>
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