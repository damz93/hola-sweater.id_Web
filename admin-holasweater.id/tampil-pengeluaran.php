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
		<script>
			function sebelum() {                        
			  var resi = document.getElementById("kode_order").value; 
			  if(resi==""){
			      alert('Masukkan Kode Resi');    
			      document.getElementById("kode_order").focus();
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
			width: 1024px;
			height: 500px;
			overflow: auto;
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
			  var keperluan=d;        
			  if (confirm("Are you sure you want to delete this Item?")) {            
			      $.ajax({
			        type: "get",
			        url: "hapus-pengeluaran-detail.php",
			        data: {keperluan:keperluan},
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
		<form method="post" action="simpan-pngl.php" autocomplete="off" onsubmit="return confirm('Yakin ingin simpan?');">	
			<div class="table-responsive">
				<div class="container">
					<br>
					<div class="ex3">
						<table border="0" class="table" cellpadding="2" cellspacing="2" align=center>
							<div class="form-group">
								<thead align="center">
									<tr align='center' class="table-info">
										<th width="1%">No</th>
										<th>Keperluan</th>
										<th>Biaya Per Item</th>
										<th>Banyaknya</th>
										<th>Total</th>
										<th>Deskripsi</th>
										<th width="3%">Aksi</th>
									</tr>
								</thead>
								<?php
									session_start();
									$oleh   = $_SESSION['username'];
									$kod_trs = $_POST['kode_transaksi'];
									$no     = 1;
									$juml_pengeluaran =0;
									$totpcs = 0;
									 // $data   = mysqli_query($koneksi, "select * from t_pengeluaran_temp where OLEH='".$oleh."' AND KODE_PENGELUARAN='".$kod_trs."' ORDER BY ID DESC");
									$data   = mysqli_query($koneksi, "select * from t_pengeluaran_temp ORDER BY ID DESC");
									while ($d = mysqli_fetch_array($data)) {
									$juml_pengeluaran = $juml_pengeluaran + $d['NOMINAL'];
									    $juml_pengeluarantamp = "Rp".number_format($juml_pengeluaran, 0, ",", ".");
									    $nominal            = "Rp".number_format($d['NOMINAL'], 0, ",", ".");
									    $keperluan         = $d['KATEGORI'];
									    $kode_transaksi         = $d['KODE_PENGELUARAN'];
									    $keterangan = $d['NOTES'];
									    $peritem         = $d['PER_ITEM'];
										$peritemtamp = "Rp".number_format($peritem, 0, ",", ".");										
									    $banyaknya         = $d['BANYAKNYA'];
										$banyaknyatamp = number_format($banyaknya, 0, ",", ".");
										
									    $totpcs++;
									?>
								<tr align="center">
									<td><?php
										echo $no++;
										?></td>
									<td><?php
										echo $keperluan;
										?></td>
									<td align="right"><?php
										echo $peritemtamp;
										?></td>
									<td><?php
										echo $banyaknyatamp;
										?></td>
									<td align="right"><?php
										echo $nominal;
										?></td>
									<td><?php
										echo $keterangan;
										?></td>
									<td>
										<a class="btn btn-danger" onclick="delete_data('<?php echo $keperluan; ?>')" title="Delete Item"><img src="img/delete.png" height="50%" ></a>
									</td>
								</tr>
								<?php
									}
									
									?>
								<tr>
									<td colspan="7">
										<p align='right'>
											<?php
												echo $juml_pengeluarantamp . " (Total Pengeluaran)<br>";												
												echo $totpcs . " (Banyaknya Transaksi)";
												?>
										</p>
									</td>
								</tr>
								<tr>
									<td colspan="5"	 align="right">
										<h6>Permintaan Oleh</h6>
									</td>
									<td colspan="2">
										<input value="Permintaan Oleh" type="text" placeholder="Permintaan Oleh" id="permintaan" maxlength="30" name="permintaan" class="form-control form-control-sm">									
									</td>
								</tr>
								<tr>
									<td colspan="5"	 align="right">
										<h6>Divisi</h6>
									</td>
									<td colspan="2">
										<select name="devisix" id="devisix" onchange="select_aft_dev()" class="form-control form-control-sm">
											<option value="KONVEKSI" <?php if($_POST['devisix'] == 'KONVEKSI') {echo 'selected=selected'; } ?> >Konveksi</option>
											<option value="MARKETING" <?php if($_POST['devisix'] == 'MARKETING') {echo 'selected=selected'; } ?> >Marketing</option>
											<option value="TOKO OFFLINE" <?php if($_POST['devisix'] == 'TOKO OFFLINE') {echo "selected=selected"; } ?> >Toko Offline</option>
											<option value="WAREHOUSE" <?php if($_POST['devisix'] == 'WAREHOUSE') {echo 'selected=selected'; } ?> >Warehouse</option>
											<option value="LAIN-LAIN" <?php if($_POST['devisix'] == 'LAIN-LAIN') {echo 'selected=selected'; } ?> >Lain-lain</option>
										</select>
									</td>
								</tr>
								<tr>
									<td colspan="5"	 align="right">
										<h6>Payment Method</h6>
									</td>
									<td colspan="2">
										<select name="payment" id="payment" onchange="select_aft_pay()" class="form-control form-control-sm">
											<option value="CASH" <?php if($_POST['payment'] == 'CASH') {echo 'selected=selected'; } ?> >Cash</option>
											<option value="TRANSFER" <?php if($_POST['payment'] == 'TRANSFER') {echo 'selected=selected'; } ?> >Transfer</option>
										</select>
									</td>
								</tr>
								<tr>
									<td colspan="5"	 align="right">
										<h6>No.Rek / Nama</h6>
									</td>
									<td colspan="2">
										<input value="Nomor Rekening/Nama" type="text" placeholder="Nomor Rekening/Nama" id="norek" maxlength="30" name="norek" class="form-control form-control-sm">									
									</td>
								</tr>
							</div>
							<tr align='right'>
								<td colspan="7">
									<button width="100%" type="submit" value="simpan" class="btn btn-info btn-lg btn-block">Proses</button>                                                
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</form>
	</body>
	</body>
</html>