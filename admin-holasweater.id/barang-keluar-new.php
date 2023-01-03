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
		<title>BARANG KELUAR - HOLASWEATER.ID</title>
		<link rel="shortcut icon" href="img/hola_ic.png">
		<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
		<script src="js/bootstrap-datepicker.js"></script>
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
			<a class="active" href="barang-keluar-new"><b>Barang Keluar</b></a>
			<a class="nav-link" href="pemasukan-new"><b>Pemasukan</b></a>
			<a class="nav-link" href="pengeluaran-new"><b>Pengeluaran</b></a>
			<a class="nav-link" href="laporan-new"><b>Summary & Report</b></a>
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
						<td align="center">	<button type="button" class="btn btn-primary btn-sm"><a href="logout" style="color:#FFFFFe">Logout</button></a>
						</td>
					</tr>
				</table>
			</div>
		</div>
		<div class="content">
			<?php 
			error_reporting(0);
			include 'koneksi.php';
			$tgl_hari_ini = date('d F Y');	
			$tgl_hari_inii = date("Y/m/d");
			$kode_aktifnya="";
			
				 $data_tr = mysqli_query($koneksi,"SELECT ID,KODE_TRANSAKSI_AUTO FROM t_stok_keluar ORDER BY ID DESC LIMIT 1");
			 while($d = mysqli_fetch_array($data_tr)){
				//$jumtranskX        = $d['ID'];				
				$jumtranskX        = substr($d['KODE_TRANSAKSI_AUTO'],6);		
			 }
			     
			     if ($jumtranskX == 0) {
			     	$kode_pengeluaran = "OUTS-0000000001";
			     }
			     else{
			     	$jumtranskX++;
				if (strlen($jumtranskX)== 1){
			     		$kode_pengeluaran = "OUTS-000000000".$jumtranskX;
			     	}
			     	else if (strlen($jumtranskX)== 2){
			     		$kode_pengeluaran = "OUTS-00000000".$jumtranskX;
			     	}
			     	else if (strlen($jumtranskX)== 3){
			     		$kode_pengeluaran = "OUTS-0000000".$jumtranskX;
			     	}
			     	else if (strlen($jumtranskX)== 4){
			     		$kode_pengeluaran = "OUTS-000000".$jumtranskX;
			     	}
			     	else if (strlen($jumtranskX)== 5){
			     		$kode_pengeluaran = "OUTS-00000".$jumtranskX;
			     	}
			     	else if (strlen($jumtranskX)== 6){
			     		$kode_pengeluaran = "OUTS-0000".$jumtranskX;
			     	}
			     	else if (strlen($jumtranskX)== 7){
			     		$kode_pengeluaran = "OUTS-000".$jumtranskX;
			     	}
			     	else if (strlen($jumtranskX)== 8){
			     		$kode_pengeluaran = "OUTS-00".$jumtranskX;
			     	}
			     	else if (strlen($jumtranskX)== 9){
			     		$kode_pengeluaran = "OUTS-0".$jumtranskX;
			     	}
			     	else if (strlen($jumtranskX)== 10){
			     		$kode_pengeluaran = "OUTS-".$jumtranskX;
			     	}
			     }
				 
				 
												
												
			?> 
		
		<h2 style="color:#284d58">Barang Keluar</h2>
		<div class="tab">
		<?php
			if ($_SESSION['level']!="OWNER" AND $_SESSION['level']!="WAREHOUSE" AND $_SESSION['level']!="OWNER"){
				//echo "<script>alert('Anda tidak memiliki akses.....');window.location.href='javascript:history.go(-1)';</script>";
				//echo "<script>alert('Anda tidak memiliki akses.....');</script>";
				  echo "<script>document.getElementById('btn_history').click();</script>";
			}
			else{
			?>
			<button class="tablinks" id="btn_offline" onclick="kategori_barang_keluar(event, 'offline')">
			<h5><b>Offline Store</b></h5>
			</button>
			<button class="tablinks" id="btn_online" onclick="kategori_barang_keluar(event, 'online')">
			<h5><b>Online Store</b></h5>
			</button>
			<button class="tablinks" id="btn_lain" onclick="kategori_barang_keluar(event, 'lainnya')">
			<h5><b>Lainnya</b></h5>
			<!--<button class="tablinks active" onclick="kategori_barang_keluar(event, 'history')">-->
			</button>
			<?php } ?>
			<button class="tablinks" id="btn_history" onclick="kategori_barang_keluar(event, 'history')">
			<h5><b>History Barang Keluar</b></h5>
			</button>
		</div>
		<div id="online" class="tabcontent">
			<h4 style="color:#284d58">Pilih Barang</h3>			
			<br>
			<br>		
				<div id="kiri">
					<form method="post" id="myForm_onl" autocomplete="off">
						<div class="table-responsive">
							<div class="form-group">
								<div class="exxxxx3">
									<table border="0" style="width:100%" class="table table-borderless" cellpadding="2" cellspacing="2" align="center">
										<tr>
											<td colspan="2">
												<input style="font-weight:bold;text-align:center" autofocus onkeyup="isi_otomatis_onl(this.value);" placeholder="Scan Barang" maxlength="20" type="text" id="kode_barang_onl" class="form-control form-control-sm">
											</td>
										</tr>
										<tr hidden>
											<td>
												<h6>Kode Pengeluaran</h6>
											</td>
											<td align="left"><input type="text" id="kode_transaksi_onl" maxlength="12" value="<?php echo $kode_pengeluaran; ?>" name="kode_transaksi_onl" class="form-control form-control-sm" readonly=readonly>
											</td>
										<tr>
										<tr hidden>
											<th><label>Jumlah Stok</label></th>
											<td><input readonly="readonly" type="text" id="kuantitasxx" class="form-control form-control-sm mata-uang" onkeyup="inputTerbilang();">
										</tr>
										<tr hidden>
											<td align="left"><input type="text" id="kode_aktif" maxlength="12" value="btn_onl" name="kode_aktif" class="form-control form-control-sm" readonly=readonly>											
											<td align="left"><input type="text" id="tujuan_onl" maxlength="12" value="ONLINE STORE" name="TUJUAN" class="form-control form-control-sm" readonly=readonly>											
										</tr>
										<tr>
											<td colspan="2"><textarea style="font-weight:bold;color:#fa8d70;font-size:10pt" readonly="readonly" rows="3" cols="4" class="form-control form-control-sm" id="keterangan_onl" placeholder="Detail Barang" maxlength="100" type="text" name="DETAIL"></textarea></td>
										</tr>
										<tr>
											<th><label>Qty</label></th>
											<td><input value="1" type="text" id="qty_onl" class="form-control form-control-sm mata-uang" onkeyup="inputTerbilang();">
										</tr>
										<tr align='center'>
											<th align='right' colspan="2">
												<!--<button onclick="autofocuss()" value="simpan" name="input_stok_keluar" id="input_stok_keluar" class="btn btn-secondary btn-lg btn-block">Tambahkan</button>		-->
												<button onclick="simpan_temp_onl()" value="simpan" name="input_stok_keluar" id="input_stok_keluar_onl" class="btn btn-secondary btn-sm btn-block">Tambahkan</button>		
											</th>
										</tr>
									</table>
								</div>
							</div>
						</div>
					</form>
				</div>
				<div id="kanan">
					<div class="ex3">
						<form method="post" onsubmit="return sebelum_onl()" id="form_tampil" name="myff2" action="simpan-trkeluar-onl">
							<div class="table-responsive">
								<div class="form-group">
									<div class="container">
										<table border="0" class="table table-borderless" style="background-color:#eaeaea" cellpadding="2" cellspacing="2" align=center>
											<?php
												$totpcs=0;
												$no=1;
												$oleh = $_SESSION['username'];
												$kod_trs = $_POST['kode_transaksi'];
												$data_temp = mysqli_query($koneksi,"select * from t_stok_keluar_temp where OLEH='".$oleh."'  AND PELANGGAN='ONLINE STORE' order by ID DESC");
												while($d = mysqli_fetch_array($data_temp)){
													$harga3=0;
													$qty=$d['QTY'];                                     
													$qtyno=$d['QTY'];                  
													//$kode_aktifnya = $d['PELANGGAN'];
													$kode_aktifnya = 'ONLINE STORE';
													$kod_bar = $d['KODE_BARANG'];
													$jenbar = $d['JENIS_BARANG'];
													$kode_transaksi = $d['KODE_TRANSAKSI'];
													$warna = $d['WARNA'];
													$size = $d['SIZE_'];
													$barang = $jenbar."<br>".$warna."<br>".$size;
													$satuan=number_format($d['HARGA'],0,",",".");
													$tambah=number_format($d['HARGA_TAMBAHAN'],0,",",".");
													$total=number_format($d['TOTAL'],0,",",".");
													$harga3=$harga3+$d['TOTAL'];
													$totpcs = $totpcs+$qtyno;
												
												?>
											<tr align="center" class="delete_mem<?php echo $kod_bar; ?>">
												<td><?php echo $no++; ?>.</td>
												<td align="left"><?php echo $barang; ?></td>
												<td width="5%"><?php echo $qty; ?>x</td>
												<td hidden>
													<input style="text-align:center;" name="qty_<?php echo $kod_bar;?>" id="qty" onchange="update_data('<?php echo $kod_bar;?>', this.value);" value="<?php echo $qty; ?>" type="text" onclick="totalx()" class="form-control form-control-sm mata-uang" onkeyup="inputTerbilang();" maxlength="5">
												</td>
												<td align="right">
													<a class="btn btn-dark" onclick="delete_data('<?php echo $kod_bar; ?>')" title="Delete Item"><img src="img/deletex.png" height="50%" ></a>
												</td>
											</tr>
											<?php 
												}
												$totpcs_tamp=number_format($totpcs,0,",",".");			
												$noooo = $no-1;
												 ?>
											<tr>
												<td colspan="4" hidden>
													<p align='right'>
														<?php echo $totpcs_tamp."(qty)"; ?>
													</p>
												</td>
											</tr>
											<!--	<table border="0" class="table table-borderless" style="background-color:#eaeaea" cellpadding="2" cellspacing="2" align=center>-->
											<tr hidden>
												<td>
													<h6 align='right'><?php echo "Jumlah Barang yang berbeda = ".$noooo; ?></h6>
												</td>
											</tr>
											<tr>
												<td colspan="4">
													<h6 align='center'><?php echo "Total Pengambilan : ".$totpcs_tamp; ?> pcs</h6>
												</td>
											</tr>
											<tr>
												<td></td>
												<td>
													No. Resi
												</td>
												<td width="5%">
													:
												</td>
												<td align="left">
													<input type="text" id="detail_onl" maxlength="40" placeholder="JPXXX" name="detail_onl" class="form-control form-control-sm">
												</td>
											</tr>
											<tr>
													<td></td>
													<td>
														Order Via
													</td>
													<td width="5%">
														:
													</td>
													<td align="left">
														<select style="color:#fa8d70;font-weight:bold;" class="form-control form-control-sm" name="oleh_onl" id="oleh_onl">
															<option value="SHOPEE">Shopee</option>
															<option value="TIKTOK">Tiktok</option>
															<option value="RESELLER">Reseller</option>
														</select>
													</td>
												</tr>											
											<tr>
												<td></td>
												<td colspan="2">
													<button width="100%" type="reset" value="reset" class="btn btn-secondary btn-sm btn-block">Cancel</button>
												</td>
												<td colspan="1">
													<button width="100%" type="submit" value="simpan" class="btn btn-primary btn-sm btn-block">Proses</button>  
												</td>
											</tr>
										</table>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>		
		</div>
		<div id="offline" class="tabcontent">			
			<h4 style="color:#284d58">Pengambilan Barang Harian</h3>			
			<br>
			<br>		
				<div id="kiri">
					<form method="post" id="myForm_ofl" autocomplete="off">
						<div class="table-responsive">
							<div class="form-group">
								<div class="exxxxx3">
									<table border="0" style="width:100%" class="table table-borderless" cellpadding="2" cellspacing="2" align="center">
										<tr>
											<td colspan="2">
												<input style="font-weight:bold;text-align:center" autofocus onkeyup="isi_otomatis_ofl(this.value);" placeholder="Scan Barang" maxlength="20" type="text" id="kode_barang_ofl" class="form-control form-control-sm">
											</td>
										</tr>
										<tr hidden>
											<td>
												<h6>Kode Pengeluaran</h6>
											</td>
											<td align="left"><input type="text" id="kode_transaksi_ofl" maxlength="12" value="<?php echo $kode_pengeluaran; ?>" name="kode_transaksi_ofl" class="form-control form-control-sm" readonly=readonly>
											</td>
										<tr>
										<tr hidden>
											<th><label>Jumlah Stok</label></th>
											<td><input readonly="readonly" type="text" id="kuantitasxx" class="form-control form-control-sm mata-uang" onkeyup="inputTerbilang();">
										</tr>
										<tr hidden>
											<td align="left"><input type="text" id="kode_aktif" maxlength="12" value="btn_ofl" name="kode_aktif" class="form-control form-control-sm" readonly=readonly>											
											<td align="left"><input type="text" id="tujuan_ofl" maxlength="12" value="OFFLINE STORE" name="TUJUAN" class="form-control form-control-sm" readonly=readonly>											
										</tr>
										<tr>
											<td colspan="2"><textarea style="font-weight:bold;color:#fa8d70;font-size:10pt" readonly="readonly" rows="3" cols="4" class="form-control form-control-sm" id="keterangan_ofl" placeholder="Detail Barang" maxlength="100" type="text" name="DETAIL"></textarea></td>
										</tr>
										<tr>
											<th><label>Qty</label></th>
											<td><input value="1" type="text" id="qty_ofl" class="form-control form-control-sm mata-uang" onkeyup="inputTerbilang();">
										</tr>
										<tr align='center'>
											<th align='right' colspan="2">
												<!--<button onclick="autofocuss()" value="simpan" name="input_stok_keluar" id="input_stok_keluar" class="btn btn-secondary btn-lg btn-block">Tambahkan</button>		-->
												<button onclick="simpan_temp_ofl()" value="simpan" name="input_stok_keluar" id="input_stok_keluar_ofl" class="btn btn-secondary btn-sm btn-block">Tambahkan</button>		
											</th>
										</tr>
									</table>
								</div>
							</div>
						</div>
					</form>
				</div>
				<div id="kanan">
					<div class="ex3">
						<form method="post" onsubmit="return sebelum_ofl()" id="form_tampil" name="myff2" action="simpan-trkeluar-ofl">
							<div class="table-responsive">
								<div class="form-group">
									<div class="container">
										<table border="0" class="table table-borderless" style="background-color:#eaeaea" cellpadding="2" cellspacing="2" align=center>
											<?php
												$totpcs=0;
												$no=1;
												$oleh = $_SESSION['username'];
												$kod_trs = $_POST['kode_transaksi'];
												$data_temp = mysqli_query($koneksi,"select * from t_stok_keluar_temp where OLEH='".$oleh."'  AND PELANGGAN='OFFLINE STORE' order by ID DESC");
												while($d = mysqli_fetch_array($data_temp)){
													$harga3=0;
													$qty=$d['QTY'];                                     
													$qtyno=$d['QTY'];                  
													//$kode_aktifnya = $d['PELANGGAN'];
													$kode_aktifnya = 'OFFLINE STORE';
													$kod_bar = $d['KODE_BARANG'];
													$jenbar = $d['JENIS_BARANG'];
													$kode_transaksi = $d['KODE_TRANSAKSI'];
													$warna = $d['WARNA'];
													$size = $d['SIZE_'];
													$barang = $jenbar."<br>".$warna."<br>".$size;
													$satuan=number_format($d['HARGA'],0,",",".");
													$tambah=number_format($d['HARGA_TAMBAHAN'],0,",",".");
													$total=number_format($d['TOTAL'],0,",",".");
													$harga3=$harga3+$d['TOTAL'];
													$totpcs = $totpcs+$qtyno;
												
												?>
											<tr align="center" class="delete_mem<?php echo $kod_bar; ?>">
												<td><?php echo $no++; ?>.</td>
												<td align="left"><?php echo $barang; ?></td>
												<td width="5%"><?php echo $qty; ?>x</td>
												<td hidden>
													<input style="text-align:center;" name="qty_<?php echo $kod_bar;?>" id="qty" onchange="update_data('<?php echo $kod_bar;?>', this.value);" value="<?php echo $qty; ?>" type="text" onclick="totalx()" class="form-control form-control-sm mata-uang" onkeyup="inputTerbilang();" maxlength="5">
												</td>
												<td align="right">
													<a class="btn btn-dark" onclick="delete_data('<?php echo $kod_bar; ?>')" title="Delete Item"><img src="img/deletex.png" height="50%" ></a>
												</td>
											</tr>
											<?php 
												}
												$totpcs_tamp=number_format($totpcs,0,",",".");			
												$noooo = $no-1;
												 ?>
											<tr>
												<td colspan="4" hidden>
													<p align='right'>
														<?php echo $totpcs_tamp."(qty)"; ?>
													</p>
												</td>
											</tr>
											<!--	<table border="0" class="table table-borderless" style="background-color:#eaeaea" cellpadding="2" cellspacing="2" align=center>-->
											<tr hidden>
												<td>
													<h6 align='right'><?php echo "Jumlah Barang yang berbeda = ".$noooo; ?></h6>
												</td>
											</tr>
											<tr>
												<td colspan="4">
													<h6 align='center'><?php echo "Total Pengambilan : ".$totpcs_tamp; ?> pcs</h6>
												</td>
											</tr>
											<tr>
												<td></td>
												<td>
													Oleh
												</td>
												<td width="5%">
													:
												</td>
												<td align="left">
													<input type="text" id="oleh_ofl" maxlength="40" placeholder="Oleh..." name="oleh_ofl" class="form-control form-control-sm">
												</td>
											</tr>											
											<tr>
												<td></td>
												<td colspan="2">
													<button width="100%" type="reset" value="reset" class="btn btn-secondary btn-sm btn-block">Cancel</button>
												</td>
												<td colspan="1">
													<button width="100%" type="submit" value="simpan" class="btn btn-primary btn-sm btn-block">Proses</button>  
												</td>
											</tr>
										</table>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>			
		</div>
		<!--<div style="display: block;" id="history" class="tabcontent">-->
		<div id="history" class="tabcontent">
			<h4 style="color:#284d58">History Barang Keluar</h3>
			<br>
			<br>
				<div class="table-responsive">
					<table id="tabel1" class="table table-hover" border="0" cellpadding="0" cellspacing="1">
				<thead align="center">
					<tr style="background-color:#585657;color:#FFFFFF;" align='center'>
						<th>No.</th>
						<!--<th>KODE PENGELUARAN BARANG</th>
							<th>NO REFF</th>-->
						<th>Tanggal</th>
						<th>Tujuan</th>
						<th>Oleh</th>
						<th>Detail</th>
						<th>Jumlah Barang</th>
						<th>Action</th>
					</tr>
				</thead>
				<?php 
					include 'koneksi.php';
					$no=1;
					function formatTanggal($date){
					// ubah string menjadi format tanggal
					return date('d-M-Y', strtotime($date));
					}	
					$data = mysqli_query($koneksi, "select COALESCE(sum(QTY),0) AS JUMLAHH,KODE_TRANSAKSI,OLEH2,KODE_TRANSAKSI_AUTO,PELANGGAN,TGL,WAKTU,OLEH from t_stok_keluar GROUP BY KODE_TRANSAKSI_AUTO ORDER BY ID DESC");
					
					while($d = mysqli_fetch_array($data)){
					$kode_aktifnya = 'HISTORY';
					$tgl = formatTanggal($d['TGL']);  
					$date_ = date_create($d['TGL']);
					$tgl2 = date_format($date_,'d-m-Y');  
					
					$hari = date('l', strtotime($d['TGL']));
					$semua = $hari.", ".$tgl;
					$koder = $d['KODE_TRANSAKSI_AUTO'];				
					$kd = $d['KODE_TRANSAKSI'];				
					$kodexx = $d['KODE_TRANSAKSI'];				
					$qty = $d['JUMLAHH'];				
					$qty = number_format($qty,0,",",".");
					$plgn = $d['PELANGGAN'];				
					$oleh = $d['OLEH2'];
						?>
				<tr align="center">
					<td><?php echo $no++; ?></td>
					<!--<td><?php echo $koder; ?></td>
						<td><?php echo $kodexx; ?></td>-->
					<td><?php echo $tgl2; ?></td>
					<td align="left"><?php echo $plgn; ?></td>
					<td><?php echo $oleh; ?></td>
					<td><?php echo $kd; ?></td>
					<td><?php echo $qty; ?></td>
					<td><a href='barang-keluar-retur-new.php?kode_transaksi=<?php
						echo $koder;
						?>' title="Retur Barang" onclick="return confirm('Tekan OK untuk mengembalikan barang ke List Retur?')"><img src="img/retur.png" height="100%" ></a>|<a target="_BLANK" href='barang-keluar-detail-new?kode_transaksi=<?php
						echo $koder;
						?>' title="Detail Transaksi" onclick="return confirm('Pilih OK untuk melihat Detail?')"><img src="img/show.png" height="100%" ></a>|
						<a target="_BLANK" href='cetak-stok-keluar2?kode_transaksi=<?php
							echo $koder;
							?>' title="Cetak Nota Transaksi" onclick="return confirm('Are you sure you want to reprint?')"><img src="img/print.png" height="100%" ></a>|<a href='hapus-stok-keluar?kode_transaksi=<?php
							echo $koder;
							?>' title="Hapus Transaksi" onclick="return confirm('Are you sure you want to delete?')"><img src="img/delete.png" height="100%" ></a>
					</td>
				</tr>
				<?php 
					}
					?>
			</table>
			</div>
			<script type="text/javascript">
				$(document).ready(function() {
				    //$("#tabel1").tablesorter();
				    $("#tabel1").DataTable({
				        "paging": true,
				        "ordering": true,
				        "info": true,
				        // });
				        //$("#tabel1").DataTable({
				        "language": {
				            "decimal": "",
				            "emptyTable": "Tidak ada data yang tersedia di tabel",
				            "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ Inputan",
				            "infoEmpty": "Menampilkan 0 sampai 0 dari 0 Inputan",
				            "infoFiltered": "(difilter dari _MAX_ total Inputan)",
				            "infoPostFix": "",
				            "thousands": ".",
				            "lengthMenu": "Menampilkan _MENU_ Data Stok Keluar",
				            "loadingRecords": "memuat...",
				            "processing": "Sedang di proses...",
				            "search": "Pencarian:",
				            "zeroRecords": "Arsip tidak ditemukan",
				            "paginate": {
				                "first": "Pertama",
				                "last": "Terakhir",
				                "next": "Selanjutnya",
				                "previous": "Kembali"
				            },
				            "aria": {
				                "sortAscending": ": aktifkan urutan kolom ascending",
				                "sortDescending": ": aktifkan urutan kolom descending"
				            }
				        }
				    });
				});
			</script>
		</div>
		<div id="lainnya" class="tabcontent">
		
			<button type="button" class="collapsible"><b>List Retur dan Barang Pinjaman </b><img src="img/list2.png" height ="20" width="20" /></button>
			<div class="contentx">
				
				
				<table id="tabel2" class="table table-hover" border="0" cellpadding="0" cellspacing="1">
					<thead align="center">
						<tr style="background-color:#585657;color:#FFFFFF;" align='center'>
							<th>No.</th>
							<!--<th>KODE PENGELUARAN BARANG</th>
								<th>NO REFF</th>-->
							<th>Tanggal</th>
							<th>Tujuan</th>
							<th>Oleh</th>
							<th>Detail</th>
							<th>Jumlah Barang</th>
							<th>Action</th>
						</tr>
					</thead>
					<?php 
						include 'koneksi.php';
						$no=1;
						$data_retur = mysqli_query($koneksi, "select SUM(QTY) AS JUMLAHH,KODE_TRANSAKSI,OLEH2,KODE_TRANSAKSI_AUTO,PELANGGAN,TGL,WAKTU,OLEH from t_stok_keluar_retur GROUP BY KODE_TRANSAKSI_AUTO ORDER BY ID DESC");
						
						while($d = mysqli_fetch_array($data_retur)){
						$tgl = formatTanggal($d['TGL']);  
						$date_ = date_create($d['TGL']);
						$tgl2 = date_format($date_,'d-m-Y');  
						
						$hari = date('l', strtotime($d['TGL']));
						$semua = $hari.", ".$tgl;
						$koder = $d['KODE_TRANSAKSI_AUTO'];				
						$kd = $d['KODE_TRANSAKSI'];				
						$kodexx = $d['KODE_TRANSAKSI'];				
						$qty = $d['JUMLAHH'];				
						$qty = number_format($qty,0,",",".");
						$plgn = $d['PELANGGAN'];				
						$oleh = $d['OLEH2'];
							?>
					<tr align="center">
						<td><?php echo $no++; ?></td>
						<!--<td><?php echo $koder; ?></td>
							<td><?php echo $kodexx; ?></td>-->
						<td><?php echo $tgl2; ?></td>
						<td align="left"><?php echo $plgn; ?></td>
						<td align="left"><?php echo $oleh; ?></td>
						<td align="left"><?php echo $kd; ?></td>
						<td><?php echo $qty; ?></td>
						<td>
							<a target="_BLANK" href='barang-keluar-retur-detail?kode_transaksi=<?php echo $koder; ?>' title="Detail" onclick="return confirm('Want Show?')"><img src="img/show.png" height="100%" ></a>|
							<a href='cek-stok-keluar?kode_transaksi=<?php echo $koder; ?>' title="ACC" onclick="return confirm('Are you sure you want to acc?')"><img src="img/check.png" height="100%" ></a>|
							<a href='hapus-stok-keluar-new?kode_transaksi=<?php echo $koder; ?>' title="Delete Transaksi" onclick="return confirm('Are you sure you want to delete?')"><img src="img/delete.png" height="100%" ></a>
						</td>
					</tr>
					<?php 
						}
						?>
				</table>
				<script type="text/javascript">
					$(document).ready(function() {
						$("#tabel2").DataTable({
							"paging": true,
							"ordering": true,
							"info": true,
							// });
							//$("#tabel1").DataTable({
							"language": {
								"decimal": "",
								"emptyTable": "Tidak ada data yang tersedia di tabel",
								"info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ Inputan",
								"infoEmpty": "Menampilkan 0 sampai 0 dari 0 Inputan",
								"infoFiltered": "(difilter dari _MAX_ total Inputan)",
								"infoPostFix": "",
								"thousands": ".",
								"lengthMenu": "Menampilkan _MENU_ Data Barang Retur",
								"loadingRecords": "memuat...",
								"processing": "Sedang di proses...",
								"search": "Pencarian:",
								"zeroRecords": "Arsip tidak ditemukan",
								"paginate": {
									"first": "Pertama",
									"last": "Terakhir",
									"next": "Selanjutnya",
									"previous": "Kembali"
								},
								"aria": {
									"sortAscending": ": aktifkan urutan kolom ascending",
									"sortDescending": ": aktifkan urutan kolom descending"
								}
							}
						});
					});
				</script>
				
				
							
			</div>
			<br>
			<button id="btn_barkel" type="button" class="collapsible"><b>Input Barang Keluar Lainnya </b></h6><img src="img/list2.png" height ="20" width="20" /></button>
			<div class="contentx">
				<h4 style="color:#284d58">Barang Keluar Lainnya</h3>				
				<div id="kiri">
					<form method="post" id="myForm" autocomplete="off">					
						<div class="table-responsive">
							<div class="form-group">
								<div class="exxxxx3">
									<table border="0" style="width:100%" class="table table-borderless" cellpadding="2" cellspacing="2" align="center">
										<tr>
											<td colspan="2">
												<input style="font-weight:bold;text-align:center" autofocus onkeyup="isi_otomatis_lain(this.value);" placeholder="Scan Barang" maxlength="20" type="text" id="kode_barang_lain" class="form-control form-control-sm">
											</td>
										</tr>
										<tr hidden>								
											<td>
												<h6>Kode Pengeluaran</h6>
											 </td>
											 <td align="left"><input type="text" id="kode_transaksi_lain" maxlength="12" value="<?php echo $kode_pengeluaran; ?>" name="kode_transaksi_lain" class="form-control form-control-sm" readonly=readonly>
											 </td>
										  <tr>
										<tr hidden>
											<th><label>Jumlah Stok</label></th>
											<td><input readonly="readonly" type="text" id="kuantitasxx" class="form-control form-control-sm mata-uang" onkeyup="inputTerbilang();">
										</tr>
										<tr hidden>
											<td align="left"><input type="text" id="kode_aktif" maxlength="12" value="btn_lain" name="kode_aktif" class="form-control form-control-sm" readonly=readonly>											
											<td align="left"><input type="text" id="tujuan_lain" maxlength="12" value="LAINNYA" name="TUJUAN" class="form-control form-control-sm" readonly=readonly>											
										</tr>
										<tr>
											<td colspan="2"><textarea style="font-weight:bold;color:#fa8d70;font-size:10pt" readonly="readonly" rows="3" cols="4" class="form-control form-control-sm" id="keterangan_lain" placeholder="Detail Barang" maxlength="100" type="text" name="DETAIL"></textarea></td>
										</tr>
										<tr>
											<th><label>Qty</label></th>
											<td><input value="1" type="text" id="qty_lain" class="form-control form-control-sm mata-uang" onkeyup="inputTerbilang();">
										</tr>
										<tr align='center'>
											<th align='right' colspan="2">
												<!--<button onclick="autofocuss()" value="simpan" name="input_stok_keluar" id="input_stok_keluar" class="btn btn-secondary btn-lg btn-block">Tambahkan</button>		-->
												<button onclick="simpan_temp_lain()" value="simpan" name="input_stok_keluar" id="input_stok_keluar_lain" class="btn btn-secondary btn-sm btn-block">Tambahkan</button>		
															  
											</th>
										</tr>
									</table>
								</div>
							</div>
						</div>
					</form>
				</div>
				<div id="kanan">
					<div class="ex3">
						<form method="post" onsubmit="return sebelum_lain()" id="form_tampil" name="myff2" action="simpan-trkeluar-lain.php">
							<div class="table-responsive">
								<div class="form-group">
									<div class="container">
										<table border="0" class="table table-borderless" style="background-color:#eaeaea" cellpadding="2" cellspacing="2" align=center>
											<?php
												$totpcs=0;
												$no=1;
												$oleh = $_SESSION['username'];
												$kod_trs = $_POST['kode_transaksi'];
												//$data = mysqli_query($koneksi,"select * from t_stok_keluar_temp where OLEH='".$oleh."' order by WAKTU DESC");
												$data_temp = mysqli_query($koneksi,"select * from t_stok_keluar_temp where OLEH='".$oleh."'  AND PELANGGAN='LAINNYA' order by ID DESC");
												while($d = mysqli_fetch_array($data_temp)){
													$harga3=0;
													$qty=$d['QTY'];                                     
													$qtyno=$d['QTY'];                  
													//$kode_aktifnya = $d['PELANGGAN'];
													$kode_aktifnya = 'LAINNYA';
													$kod_bar = $d['KODE_BARANG'];
													$jenbar = $d['JENIS_BARANG'];
													$kode_transaksi = $d['KODE_TRANSAKSI'];
													$warna = $d['WARNA'];
													$size = $d['SIZE_'];
													$barang = $jenbar."<br>".$warna."<br>".$size;
													$satuan=number_format($d['HARGA'],0,",",".");
													$tambah=number_format($d['HARGA_TAMBAHAN'],0,",",".");
													$total=number_format($d['TOTAL'],0,",",".");
													$harga3=$harga3+$d['TOTAL'];
													$totpcs = $totpcs+$qtyno;
											
											?>
											<tr align="center" class="delete_mem<?php echo $kod_bar; ?>">
												<td><?php echo $no++; ?>.</td>
												<td align="left"><?php echo $barang; ?></td>
												<td width="5%"><?php echo $qty; ?>x</td>
												<td hidden>
													<input style="text-align:center;" name="qty_<?php echo $kod_bar;?>" id="qty" onchange="update_data('<?php echo $kod_bar;?>', this.value);" value="<?php echo $qty; ?>" type="text" onclick="totalx()" class="form-control form-control-sm mata-uang" onkeyup="inputTerbilang();" maxlength="5"></td>
												<td align="right">
													<a class="btn btn-dark" onclick="delete_data('<?php echo $kod_bar; ?>')" title="Delete Item"><img src="img/deletex.png" height="50%" ></a>
												</td>
											</tr>
											<?php 
																}
														$totpcs_tamp=number_format($totpcs,0,",",".");			
														$noooo = $no-1;
																 ?>
											<tr>
												<td colspan="4" hidden>
													<p align='right'>
														<?php echo $totpcs_tamp."(qty)"; ?>
													</p>
												</td>
											</tr>
										<!--	<table border="0" class="table table-borderless" style="background-color:#eaeaea" cellpadding="2" cellspacing="2" align=center>-->
												<tr hidden>
													<td>
														<h6 align='right'><?php echo "Jumlah Barang yang berbeda = ".$noooo; ?></h6>
													</td>
												</tr>
												<tr>
													<td colspan="4">
														<h6 align='center'><?php echo "Total Barang : ".$totpcs_tamp; ?> pcs</h6>
													</td>
												</tr>
												<tr>
													<td></td>
													<td>
														Oleh
													</td>
													<td width="5%">
														:
													</td>
													<td align="left">
														<select style="color:#fa8d70;font-weight:bold;" class="form-control form-control-sm" name="oleh_lain" id="oleh_lain">
															<option value="MARKETING">Marketing</option>
															<option value="PRODUKSI">Produksi</option>
														</select>
													</td>
												</tr>
												<tr>
													<td></td>
													<td>
														Detail
													</td>
													<td width="5%">
														:
													</td>
													<td align="left">
														<select style="color:#fa8d70;font-weight:bold;" class="form-control form-control-sm" name="detail_lain" id="detail_lain">
															<option value="GIVEAWAY">Giveaway</option>
															<option value="KONTEN">Konten</option>
															<option value="RETUR">Retur</option>
														</select>
													</td>
												</tr>
												<tr>									
													<td></td>
													<td colspan="2">
														<button width="100%" type="reset" value="reset" class="btn btn-secondary btn-sm btn-block">Cancel</button>
													</td>
													<td colspan="1">
														<button width="100%" type="submit" value="simpan" class="btn btn-primary btn-sm btn-block">Proses</button>  
													</td>
												</tr>
										</table>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
				
				
			</div>
			
		</div>
		<script type="text/javascript">
			function kategori_barang_keluar(evt, cityName) {
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
		
		
		
		
		<script src="js/jquery.mask.min.js"></script>
		<script src="js/terbilang.js"></script>
		<script>
		function inputTerbilang() {
		  //membuat inputan otomatis jadi mata uang
		  $('.mata-uang').mask('0.000.000.000', {
			reverse: true
		  });
					  
			var qty_ofl = document.getElementById('qty_ofl').value;
			var qty_onl = document.getElementById('qty_onl').value;
			var qty_lain = document.getElementById('qty_lain').value;
				if (qty_ofl == "" || qty_ofl == "0"){
					document.getElementById("qty_ofl").value = "1";
				}
				if (qty_lain == "" || qty_lain == "0"){
					document.getElementById("qty_lain").value = "1";
				}
				if (qty_onl == ""){
					document.getElementById("qty_onl").value = "1";
				}
		
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
			function autofocuss() {
				document.getElementById("jenis").focus();
			}			
		</script>		
		<script type="text/javascript">
			function total_kembali(){		  
				 $('.mata-uang').mask('0.000.000.000', {reverse: true});
			//	alert('y');
				var total_tf = document.getElementById('pem_trf').value;
				if (total_tf == ""){
					total_tf = "0";
					document.getElementById("pem_trf").value = "0";
				}
				else{
					total_tf = total_tf.replace(".","");
					total_tf = total_tf.replace(".","");
					total_tf = total_tf.replace(".","");
				}
				var total_edc = document.getElementById('pem_edc').value;
				if (total_edc == ""){
					total_edc = "0";
					document.getElementById("pem_edc").value = "0";
				}
				else{
					total_edc = total_edc.replace(".","");
					total_edc = total_edc.replace(".","");
					total_edc = total_edc.replace(".","");
				}
				
				var total_tni = document.getElementById('pem_tni').value;
				if (total_tni == ""){
					total_tni = "0";
					document.getElementById("pem_tni").value = "0";
				}
				else{
					total_tni = total_tni.replace(".","");
					total_tni = total_tni.replace(".","");
					total_tni = total_tni.replace(".","");
				}
				var total = parseInt(total_tf) + parseInt(total_edc) + parseInt(total_tni);
				var hemm = total.toFixed().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
				document.getElementById("total_pembayaran").value = total;
				document.getElementById("totalnya").innerHTML = "Rp"+hemm;				
				
			}		         
		</script>
		<script>
			function sebelum1() {         	
			  var dari = document.getElementById("dari1").value; 
			  var keter = document.getElementById("keterangan1").value; 
			  if(dari==""){
				  alert('Input dari/Oleh...');	
				  document.getElementById("dari1").focus();
				  return false;
			  }
			  else if(keter==""){
				  alert('Input catatan...');	
				  document.getElementById("keterangan1").focus();
				  return false;
			  }
			 
				else{
					return confirm('Yakin ingin simpan?');        	 
				}
			}			
		</script>	
		<script>
			function sebelum2() {         	
			  var dari = document.getElementById("dari2").value; 
			  var keter = document.getElementById("keterangan2").value; 
			  if(dari==""){
				  alert('Input dari/Oleh...');	
				  document.getElementById("dari2").focus();
				  return false;
			  }
			  else if(keter==""){
				  alert('Input catatan...');	
				  document.getElementById("keterangan2").focus();
				  return false;
			  }
			 
				else{
					return confirm('Yakin ingin simpan?');        	 
				}
			}			
		</script>	
		<script>
			function sebelum3() {         	
			  var dari = document.getElementById("dari3").value; 
			  var keter = document.getElementById("keterangan3").value; 
			  if(dari==""){
				  alert('Input dari/Oleh...');	
				  document.getElementById("dari3").focus();
				  return false;
			  }
			  else if(keter==""){
				  alert('Input catatan...');	
				  document.getElementById("keterangan3").focus();
				  return false;
			  }
			 
				else{
					return confirm('Yakin ingin simpan?');        	 
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
		
		
		
		
		<script type="text/javascript">
		  function update_data(d, e){
			var kode_barang=d;		
			var qty = e;			
				$.ajax({
				  type: "get",
				  url: "update-stok-keluar-detail.php",
				  data: {kode_barang:kode_barang, qty:qty},
				  success: function(value){
					//$("#data_table").html(value);
				//	 location.reload(true);
					 alert('Berhasil update');
					});
					//document.getElementById("form_tampil").reset();		
				  }
				});
		  }		  
		</script>
		<script type="text/javascript">
		  function delete_data(d){
			var kode_barang=d;		
			if (confirm("Are you sure you want to delete this Item?")) {			
				$.ajax({
				  type: "get",
				  url: "hapus-stok-keluar-detail.php",
				  data: {kode_barang:kode_barang},
				  success: function(value){
					 alert('Berhasil hapus');
					 location.reload(true);
					 reload_lain();
				  }
				});
				document.getElementById("btn_lain").click();
			}
			else{
				return false;
			}
		  }
		 </script>
		 
		 <script type="text/javascript">
			function simpan_temp_onl(){								
				var kode_barang = $('#kode_barang_onl').val();				
				var kode_transaksi = $('#kode_transaksi_onl').val();
				var tujuan = $('#tujuan_onl').val();					
				var kode_aktif = $('#kode_aktif').val();					
				var keter_onl = $('#keterangan_onl').val();					
				var qty = $('#qty_onl').val();
				var qty = qty.replace(".","");	
				if (kode_barang.length == 0){
					alert('Kode Barang belum diinput');
					$('#tempat_cek').val('ONLINE STORE');
				}
				else if(keter_onl == "-"){
					alert('Kode Barang tidak valid');
					$('#tempat_cek').val('ONLINE STORE');
				}
				else{	
					$.ajax({
					  method: "POST",
					  url: "simpan-stok-keluar.php",
					  data: {tujuan : tujuan,kode_transaksi : kode_transaksi,kode_barang : kode_barang, qty : qty,type:"insert"},					
					  success	: function(data){
								//$("#tempat_cek").val('ONLINE STORE');
								//document.getElementById("tempat_cek").value="ONLINE STORE";
								alert('Barang tersimpan di list...');								
								},
								error: function(response){
									console.log(response.responseText);
								}
					});					
				}
				
			 }
		</script> 
		 <script type="text/javascript">
			function sess(a){
				
				<?php
				?>
			}
		 </script>
		 <script type="text/javascript">
			function simpan_temp_ofl(){		
				var kode_barang = $('#kode_barang_ofl').val();				
				var kode_transaksi = $('#kode_transaksi_ofl').val();
				var tujuan = $('#tujuan_ofl').val();					
				var kode_aktif = $('#kode_aktif').val();					
				var keter_ofl = $('#keterangan_ofl').val();					
				var qty = $('#qty_ofl').val();
				var qty = qty.replace(".","");	
				if (kode_barang.length == 0){
					alert('Kode Barang belum diinput');
				}
				else if(keter_ofl == "-"){
					alert('Kode Barang tidak valid');		
				}
				else{	
					$.ajax({
					  method: "POST",
					  url: "simpan-stok-keluar.php",
					  data: {tujuan : tujuan,kode_transaksi : kode_transaksi,kode_barang : kode_barang, qty : qty,type:"insert"},					
					  success	: function(data){
								alert('Barang tersimpan di list...');								
								},
								error: function(response){
									console.log(response.responseText);
								}
					});					
				}						
			 }
		</script> 
		 <script type="text/javascript">
			function simpan_temp_lain(){				
			<?php
				session_start();
			//	$_SESSION['t_cek'] = 'LAINNYA';				
			?>
				var kode_barang = $('#kode_barang_lain').val();				
				var kode_transaksi = $('#kode_transaksi_lain').val();
				var tujuan = $('#tujuan_lain').val();					
				var kode_aktif = $('#kode_aktif').val();					
				var keter_lain = $('#keterangan_lain').val();
				var qty = $('#qty_lain').val();
				var qty = qty.replace(".","");	
				if (kode_barang.length == 0){
					alert('Kode Barang belum diinput');
				}
				else if(keter_lain == "-"){
					alert('Kode Barang tidak valid');				
				}
				else{	
					$.ajax({
					  method: "POST",
					  url: "simpan-stok-keluar.php",
					  data: {tujuan : tujuan,kode_transaksi : kode_transaksi,kode_barang : kode_barang, qty : qty,type:"insert"},					
					  success	: function(data){
								alert('Barang tersimpan di list...');								
								},
								error: function(response){
									console.log(response.responseText);
								}
					});					
				}						
			 }
		</script> 
		<script type="text/javascript">
			function isi_otomatis_onl(a){			   				
				//var kode_barang = $("#kode_barang").val();
				var kode_barang = a;				
				var jenis_barang,warna,sizee,qty,semua;
					$.ajax({
						url: 'list-cekbarang-new.php',
						type: 'get',
						data     : 'kode='+kode_barang,
						success: function (data) {
							 var json = data,
							 obj = JSON.parse(json);					
							jenis_barang = (obj.jenis_barangx);
							warna = (obj.warnax);
							sizee = (obj.sizex);	
							$('#kuantitasxx').val(obj.qtyx);
							$('#qty_onl').val("1");	
							var semua = jenis_barang+"\n"+warna+"\n"+sizee;							
							if(sizee==null){
								//alert('kode barang tidak ditemukan.....')
								$('#keterangan_onl').val("-");
							}
							else{
								$('#keterangan_onl').val(semua);
								document.getElementById("qty_onl").focus();
								//alert('ok');
							}
						}
					});
			}		
			function isi_otomatis_ofl(a){			   				
				//var kode_barang = $("#kode_barang").val();
				var kode_barang = a;				
				var jenis_barang,warna,sizee,qty,semua;
					$.ajax({
						url: 'list-cekbarang-new.php',
						type: 'get',
						data     : 'kode='+kode_barang,
						success: function (data) {
							 var json = data,
							 obj = JSON.parse(json);					
							jenis_barang = (obj.jenis_barangx);
							warna = (obj.warnax);
							sizee = (obj.sizex);	
							$('#kuantitasxx').val(obj.qtyx);
							$('#qty_ofl').val("1");	
							var semua = jenis_barang+"\n"+warna+"\n"+sizee;							
							if(sizee==null){
							//	alert('kode barang tidak ditemukan.....')
								$('#keterangan_ofl').val("-");
							}
							else{
								$('#keterangan_ofl').val(semua);
								document.getElementById("qty_ofl").focus();
								//alert('ok');
							}
						}
					});
			}		
			function isi_otomatis_lain(a){			   				
				//var kode_barang = $("#kode_barang").val();
				var kode_barang = a;				
				var jenis_barang,warna,sizee,qty,semua;
					$.ajax({
						url: 'list-cekbarang-new.php',
						type: 'get',
						data     : 'kode='+kode_barang,
						success: function (data) {
							 var json = data,
							 obj = JSON.parse(json);					
							jenis_barang = (obj.jenis_barangx);
							warna = (obj.warnax);
							sizee = (obj.sizex);	
							$('#kuantitasxx').val(obj.qtyx);
							$('#qty_lain').val("1");	
							var semua = jenis_barang+"\n"+warna+"\n"+sizee;							
							if(sizee==null){
								//alert('kode barang tidak ditemukan.....')
								$('#keterangan_lain').val("-");
							}
							else{
								$('#keterangan_lain').val(semua);
								document.getElementById("qty_lain").focus();
								//alert('ok');
							}
						}
					});
			}					
		</script>
		<script>
         function sebelum_lain() {         	           
			return confirm('Yakin ingin simpan?');         	          	
         }
         
		</script>
		<script>
		 function sebelum_ofl() {         	
			  var kode_transaksi = document.getElementById("oleh_ofl").value; 
			  if(kode_transaksi==""){
				  alert('isi oleh terlebih dahulu...');
				  document.getElementById("oleh_ofl").focus();
				  return false;
			  }
				else{
					return confirm('Yakin ingin simpan?');         	 
				}
			}
         
      </script>
		<script>
		 function sebelum_onl() {         	
			  var detail = document.getElementById("detail_onl").value; 
			  if(detail==""){
				  alert('Isi Nomor Resi terlebih dahulu...');
				  document.getElementById("detail_onl").focus();
				  return false;
			  }
				else{
					return confirm('Yakin ingin simpan?');         	 
				}
			}
         
      </script>
		<input hidden type="text" id="tempat_cek" maxlength="12" value="<?php echo $kode_aktifnya; ?>" name="tempat_cek" class="form-control form-control-sm" readonly=readonly>	

		<script type="text/javascript">
		  var kode_aktif = $('#tempat_cek').val();
		 // alert(kode_aktif);
			  if (kode_aktif=="OFFLINE STORE"){
				  document.getElementById("btn_offline").click();
				  document.getElementById("kode_barang_ofl").focus();
			  }
			  else if (kode_aktif=="ONLINE STORE"){
				  document.getElementById("btn_online").click();
				  document.getElementById("kode_barang_onl").focus();
			  }
			  else if (kode_aktif=="LAINNYA"){
				  document.getElementById("btn_lain").click();
				  document.getElementById("kode_barang_lain").focus();
			  }
			  else if (kode_aktif=="HISTORY"){
				  document.getElementById("btn_history").click();
			  }
			  function kategori(){
				  alert('c');
			  }
		</script>
		</div>
		<div class="navbar_bot">
			<?php include "bantuan/footer.php" ?>
		</div>
	</body>
</html>