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
		<title>BARANG MASUK - HOLASWEATER.ID</title>
		<link rel="shortcut icon" href="img/hola_ic.png">
		<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
		<script src="js/bootstrap-datepicker.js"></script>
		<link rel="stylesheet" href="css/datepicker.css">
		<link rel="stylesheet" href="css/css-terpakai.css">
	</head>
	<body>
		<div class="sidebar">
			<img align="center" style="display: block; margin: auto;height:50px;" src="http://holasweater.id/admin-holasweater.id/img/hola_trs.png" alt="logo">
			<br>
			<a class="nav-link" href="menu-utama"><b>Home</b></a>
			<a class="active" href="barang-masuk-new"><b>Stok dan Barang Masuk</b></a>
			<a class="nav-link" href="barang-keluar-new"><b>Barang Keluar</b></a>
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
				
					 $data_tr = mysqli_query($koneksi,"SELECT ID,KODE_TRANSAKSI FROM t_stok_masuk ORDER BY ID DESC LIMIT 1");
				 while($d = mysqli_fetch_array($data_tr)){
					//$jumtranskX        = $d['ID'];				
					$jumtranskX        = substr($d['KODE_TRANSAKSI'],5);		
				 }
				     
				     if ($jumtranskX == 0) {
				     	$kode_masuk = "INS-0000000001";
				     }
				     else{
				     	$jumtranskX++;
					if (strlen($jumtranskX)== 1){
				     		$kode_masuk = "INS-000000000".$jumtranskX;
				     	}
				     	else if (strlen($jumtranskX)== 2){
				     		$kode_masuk = "INS-00000000".$jumtranskX;
				     	}
				     	else if (strlen($jumtranskX)== 3){
				     		$kode_masuk = "INS-0000000".$jumtranskX;
				     	}
				     	else if (strlen($jumtranskX)== 4){
				     		$kode_masuk = "INS-000000".$jumtranskX;
				     	}
				     	else if (strlen($jumtranskX)== 5){
				     		$kode_masuk = "INS-00000".$jumtranskX;
				     	}
				     	else if (strlen($jumtranskX)== 6){
				     		$kode_masuk = "INS-0000".$jumtranskX;
				     	}
				     	else if (strlen($jumtranskX)== 7){
				     		$kode_masuk = "INS-000".$jumtranskX;
				     	}
				     	else if (strlen($jumtranskX)== 8){
				     		$kode_masuk = "INS-00".$jumtranskX;
				     	}
				     	else if (strlen($jumtranskX)== 9){
				     		$kode_masuk = "INS-0".$jumtranskX;
				     	}
				     	else if (strlen($jumtranskX)== 10){
				     		$kode_masuk = "INS-".$jumtranskX;
				     	}
				     }
					 
					 
													
													
				?> 
			<h2 style="color:#284d58">Stok dan Barang Masuk</h2>
			<div class="tab">
				<button class="tablinks" id="btn_stok" onclick="kategori_barang_masuk(event, 'stok')">
					<h5><b>Tampilkan Data Stok</b></h5>
				</button>
				<?php
					session_start();
					if ($_SESSION['level']!="OWNER" AND $_SESSION['level']!="WAREHOUSE" AND $_SESSION['level']!="OWNER"){
						//echo "<script>alert('Anda tidak memiliki akses.....');window.location.href='javascript:history.go(-1)';</script>";
						//echo "<script>alert('Anda tidak memiliki akses.....');</script>";
						echo "<script>document.getElementById('btn_stok').click();document.getElementById('jenis_barang_manual93').focus();</script>";
					}
					else{
					
					?>
				<button class="tablinks" id="btn_massal" onclick="kategori_barang_masuk(event, 'massal')">
					<h5><b>Upload Barang Masuk Massal</b></h5>
				</button>
				<button class="tablinks" id="btn_manual" onclick="kategori_barang_masuk(event, 'manual')">
					<h5><b>Input Barang Masuk Manual</b></h5>
				</button>
				<button class="tablinks" id="btn_history" onclick="kategori_barang_masuk(event, 'history')">
					<h5><b>History Barang Masuk</b></h5>
				</button>
				<?php } ?>
			</div>
			<div id="massal" class="tabcontent">
				<br>
				<div class="kirkan">
					<form class="" method="post" enctype="multipart/form-data" action="upload-aksi-barmas-massal" align='left'>
						<table style="width:100%" border="0" align="center" cellpadding="0" cellspacing="0">
							<tr align="center">
								<td align="center">
									<button type="button" class="btn btn-success"><a style="color:#FFFFFF" target="_BLANK" href='format/format_upload_massal_barang_.xlsx'>_DOWNLOAD FORMAT EXCEL_</a></button>
									<br>
									<br>
									<label for="exampleFormControlFile1" style="font-weight:bold;">Upload File Excel</label>
									<input name="berkas_massal" type="file" class="form-control" style="background-color:#c1c1c1;width:30%" id="exampleFormControlFile1">
									<input name="upload" type="submit" value="Upload" class="btn btn-outline-secondary">
									<br>
									<br>
									<h4 align='left' style="height:33px;background-color:#284d58;color:#ffffff">&nbsp Hasil Import Terakhir...</h4>
								</td>
							</tr>
						</table>
					</form>
				</div>
				<div class="table-responsive">
					<table id="tabel11" class="table table-hover" border="0" cellpadding="0" cellspacing="1">
						<thead align="center">
							<tr style="background-color:#585657;color:#FFFFFF;" align='center'>
								<th width="5" height="40">No</th>
								<th width="10">Kode Barang</th>
								<th width="20">Jenis Barang</th>
								<th width="20">Warna</th>
								<th width="20">Size</th>
								<th width="20">Stok</th>
								<th width="20">Harga</th>
								<th width="20">Waktu Upload</th>
							</tr>
						</thead>
						<?php
							include "koneksi.php";
							$no=1;
							$dataxx = mysqli_query($koneksi, "select * from t_stok_excel");
							
							//menampilkan data
							while ($d = mysqli_fetch_array($dataxx)) {
								$harga = $d['HARGA'];
								$harga_tamp="Rp".number_format($harga,0,",",".");
								$stok = $d['QTY'];
								$stok_tamp=number_format($stok,0,",",".");
								$kode_aktifnya = "MASSAL";
							?>
						<tr style="background-color:#f4f4f4;color:#585858;" align='center'>
							<td align="center" height="40"><?php echo $no++;?></td>
							<td align="center"><?php echo $d['KODE_BARANG'];?></td>
							<td align="center"><?php echo $d['JENIS_BARANG'];?></td>
							<td align="center"><?php echo $d['WARNA'];?></td>
							<td align="center"><?php echo $d['SIZE_'];?></td>
							<td align="center"><?php echo $stok_tamp; ?></td>
							<td align="center"><?php echo $harga_tamp; ?></td>
							<td align="center"><?php echo $d['WAKTU']; }?></td>
						</tr>
						<form class="form-control" action="hapus-hasil-import.php" method="post" onsubmit="return confirm('Konfirmasi Hapus Hasil Import?');">
							<tr style="background-color:#585858">
								<td colspan="4" align="left">
									<input name="proses" type="submit" value="Hapus Hasil Import" class="btn btn-primary btn-sm btn-block">
								</td>
								<td colspan="4">
								</td>
							</tr>
						</form>
					</table>
				</div>
			</div>
			<!--<div style="display: block;" id="history" class="tabcontent">-->
			<div id="history" class="tabcontent">
				<br>
				<div class="kirkan">
					<form autocomplete="off" action="#" method="get" autocomplete="off">
						<table style="width:100%" border="0" align="center" cellpadding="0" cellspacing="0">
							<tr align="center">
								<td align="left">
									<h5 style="color:#242424">History Input Barang Masuk</h5>
								</td>
								<td style="width:25%">
									<input style="text-align:center" placeholder="Masukkan Tanggal" class="form-control form-control-sm datepicker" maxlength="10" type="text" id="tgl_transaksi" placeholder="Pilih Tanggal" name="tgl_transaksi"> 
								</td>
								<td style="width:10%">
									<button name="sm_tgl" width="100%" type="submit" value="ok" onclick="cek_btntgl()" value="ok" class="btn btn-primary btn-sm btn-block"><b>Tampilkan</b></button>  
								</td>
							</tr>
						</table>
					</form>
				</div>
				<div class="table-responsive">
					<table id="tabel11" class="table table-hover" border="0" cellpadding="0" cellspacing="1">
						<thead align="center">
							<tr style="background-color:#585657;color:#FFFFFF;" align='center'>
								<th>No.</th>
								<!--<th>KODE PENGELUARAN BARANG</th>
									<th>NO REFF</th>-->
								<th>Tanggal</th>
								<th>Kategori</th>
								<th>Jumlah Barang</th>
								<th>Terima Dari</th>
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
							///$data = mysqli_query($koneksi, "select sum(QTY) AS JUMLAHH,KODE_TRANSAKSI,TERIMA_DARI,KATEGORI,TGL,WAKTU,OLEH from t_stok_masuk GROUP BY KODE_TRANSAKSI ORDER BY ID DESC");
							
							if (isset($_GET['sm_tgl'])){
								$tgl = $_GET['tgl_transaksi'];
								$kode_aktifnya = "HISTORY";
								$pencek = "select * from t_stok_masuk where TGL='".$tgl."'";
								$prosescek = mysqli_query($koneksi, $pencek);
								if($tgl!='') {
									if (mysqli_num_rows($prosescek)<1) { 
										echo "
										<script>
										alert('data tidak ditemukan');
										</script>";
									}
									else{
										echo "
										<script>
										alert('data ditemukan');
										</script>";
										
										$data = mysqli_query($koneksi, "select sum(QTY) AS JUMLAHH,KODE_TRANSAKSI,TERIMA_DARI,KATEGORI,TGL,WAKTU,OLEH from t_stok_masuk where TGL='".$tgl."' GROUP BY KODE_TRANSAKSI ORDER BY ID DESC");
										while($d = mysqli_fetch_array($data)){
											$tgl = formatTanggal($d['TGL']);  
											$date_ = date_create($d['TGL']);
											$tgl2 = date_format($date_,'d-m-Y');  
											$hari = date('l', strtotime($d['TGL']));
											$semua = $hari.", ".$tgl;	
											$koder = $d['KODE_TRANSAKSI'];				
											$kodexx = $d['KODE_TRANSAKSI'];				
											$katego = $d['KATEGORI'];				
											$terima = $d['TERIMA_DARI'];				
											$qty = $d['JUMLAHH'];				
											$qty = number_format($qty,0,",",".");
											$plgn = $d['PELANGGAN'];				
											$oleh = $d['OLEH2'];
										?>
						<tr style="background-color:#f4f4f4;color:#585858;" align='center'>
							<td><?php echo $no++; ?>.</td>
							<!--<td><?php echo $koder; ?></td>
								<td><?php echo $kodexx; ?></td>-->
							<td><?php echo $tgl2; ?></td>
							<td align="left"><?php echo $katego; ?></td>
							<td><?php echo $qty; ?></td>
							<td><?php echo $terima; ?></td>
							<td><a target="_BLANK" href='barang-masuk-detail-new?kode_transaksi=<?php
								echo $koder;
								?>' title="Detail Barang Masuk" onclick="return confirm('Want Show?')"><img src="img/show.png" height="100%" ></a>|
								<a target="_BLANK" href='cetak-stok-masuk2?kode_transaksi=<?php
									echo $koder;
									?>' title="Cetak Barang Masuk" onclick="return confirm('Are you sure you want to reprint?')"><img src="img/print.png" height="100%" ></a>|<a href='hapus-stok-masuk?kode_transaksi=<?php
									echo $koder;
									?>' title="Hapus Barang Masuk" onclick="return confirm('Are you sure you want to delete?')"><img src="img/delete.png" height="100%" ></a>
							</td>
						</tr>
						<?php 
							}
							}
							}
							}
							?>
					</table>
				</div>
				<script type="text/javascript">
					function cek_btntgl(){			   
						var tgl = $("#tgl_transaksi").val();
						if (tgl==''){
							alert('Tgl Kosong');
							document.getElementById("tgl_transaksi").focus();
							return false;
						}
						else{
							document.getElementById("tgl_transaksi").value = tgl;
							return false;
							
						}
					}
				</script>
			</div>
			<div id="manual" class="tabcontent">
				<br>		
				<br>
				<table style="width:100%" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td align="left" width="40%">
							<h5>Scan Barang</h5>
						</td>
						<td align="left" width="60%">
							<h5>&nbsp &nbsp List Barang Masuk: </h5>
						</td>
					</tr>
				</table>
				<div id="kiri">
					<form method="post" id="myForm_manual" autocomplete="off">
						<div class="table-responsive">
							<div class="form-group">
								<div class="exxxxx3">
									<table border="0" class="table table-borderless" style="background-color:#ffffff" cellpadding="2" cellspacing="2" align="center">
										<tr>
											<td colspan="3">
												<input style="font-size:12pt;text-align:center" autofocus onkeyup="isi_otomatis_manual(this.value);" placeholder="Scan Kode Barang" maxlength="20" type="text" id="kode_barang_manual" class="form-control form-control-lg">
											</td>
										</tr>
										<tr hidden>
											<td>
												<h6>Kode Pengeluaran</h6>
											</td>
											<td align="left"><input type="text" id="kode_transaksi_manual" maxlength="12" value="<?php echo $kode_masuk; ?>" name="kode_transaksi_manual" class="form-control form-control-sm" readonly=readonly>
											</td>
										<tr>
										<tr hidden>
											<th><label>Jumlah Stok</label></th>
											<td><input readonly="readonly" type="text" id="kuantitasxx" class="form-control form-control-sm mata-uang" onkeyup="inputTerbilang();">
										</tr>
										<tr hidden>
											<td align="left"><input type="text" id="kode_aktif" maxlength="12" value="btn_manual" name="kode_aktif" class="form-control form-control-sm" readonly=readonly>											
											<td align="left"><input type="text" id="tujuan_manual" maxlength="12" value="MANUAL" name="TUJUAN" class="form-control form-control-sm" readonly=readonly>											
										</tr>
										<tr>
											<td colspan="3"><textarea style="background-color:#ffffff;font-size:10pt" readonly="readonly" rows="3" cols="4" class="form-control form-control-sm" id="keterangan_manual" placeholder="Detail Barang" maxlength="100" type="text" name="DETAIL"></textarea></td>
										</tr>
										<tr>
											<td align="align">
												<h6>Masukkan Jumlah</h6>
											</td>
											<td width="40%" colspan="2"><input value="1" maxlength="5" type="text" id="qty_manual" class="form-control form-control-sm mata-uang" onkeyup="inputTerbilang();"></td>
										</tr>
										<td colspan="3" align="center"><button onclick="simpan_temp_manual()" value="simpan" name="input_stok_masuk" id="input_stok_masuk_manual" class="btn btn-secondary btn-sm btn-block">Tambahkan</button></td>
										<tr hidden align='center'>
											<th align='right' colspan="2">
												<!--<button onclick="autofocuss()" value="simpan" name="input_stok_masuk" id="input_stok_masuk" class="btn btn-secondary btn-lg btn-block">Tambahkan</button>		-->
											</th>
										</tr>
									</table>
								</div>
							</div>
						</div>
					</form>
					<br>
					<table style="width:100%" border="0" align="left" cellpadding="0" cellspacing="0">
						<tr>
							<td align="left" width="40%">
								<h5>Pilih Barang Manual</h5>
							</td>
						</tr>
					</table>
					<form method="post" id="myForm_manual2" autocomplete="off">
						<div class="table-responsive">
							<div class="form-group">
								<div class="exxxxx3">
									<table border="0" class="table table-borderless" style="background-color:#ffffff" cellpadding="2" cellspacing="2" align="center">
										<tr hidden>
											<td>
												<h6>Kode Pemasukan</h6>
											</td>
											<td align="left"><input type="text" id="kode_transaksi_manual2" maxlength="12" value="<?php echo $kode_masuk; ?>" name="kode_transaksi_manual2" class="form-control form-control-sm" readonly=readonly>
											</td>
										<tr>
										<tr>
											<td align="left">
												<h6>Jenis Barang</h6>
											</td>
											<td align="right" colspan="2">
												<select name="jenis_barang_manual2" id="jenis_barang_manual2" onchange="cek_kode_barang();" class="form-control form-control-sm">
													<option value="0">Pilih Jenis</option>
													<?php
														include "koneksi.php";
														$data_jenis = mysqli_query($koneksi,"select DISTINCT(JENIS_BARANG) FROM t_stok ORDER BY JENIS_BARANG ASC");
														while($d = mysqli_fetch_array($data_jenis)){
															$jen = $d['JENIS_BARANG'];
														
															echo '<option value="'.$jen.'">'.$jen.'</option>';
														
														}							
														?>
												</select>
											</td>
										</tr>
										<tr>
											<td align="left">
												<h6>Warna</h6>
											</td>
											<td align="right" colspan="2">
												<select name="warna_barang_manual2" id="warna_barang_manual2" onchange="cek_kode_barang();" class="form-control form-control-sm">
													<option value="0">Pilih Warna</option>
													<?php
														include "koneksi.php";
														session_start();
														$data_warna = mysqli_query($koneksi,"select DISTINCT(WARNA) FROM t_stok ORDER BY WARNA ASC");
														while($d = mysqli_fetch_array($data_warna)){
															$warn = $d['WARNA'];
															echo '<option value="'.$warn.'">'.$warn.'</option>';
														}							
														?>
												</select>
											</td>
										</tr>
										<tr>
											<td align="left">
												<h6>Size</h6>
											</td>
											<td align="right" colspan="2">
												<select name="size_barang_manual2" onchange="cek_kode_barang();" id="size_barang_manual2" class="form-control form-control-sm">
													<option value="0">Pilih Size</option>
													<?php
														include "koneksi.php";
														$data_sizee = mysqli_query($koneksi,"select DISTINCT(SIZE_) FROM t_stok WHERE SIZE_<>'-' ORDER BY SIZE_ ASC");
														while($d = mysqli_fetch_array($data_sizee)){
															$size = $d['SIZE_'];
															echo '<option value="'.$size.'">'.$size.'</option>';
														}							
														?>
												</select>
											</td>
										</tr>
										<tr>
											<td align="left">
												<h6>Jumlah</h6>
											</td>
											<td colspan="2" align="right">
												<input value="1" maxlength="5" type="text" id="qty_manual2" class="form-control form-control-sm mata-uang" onkeyup="inputTerbilang();">
											</td>
										</tr>
										<tr align="right">
											<td colspan="3"><button onclick="simpan_temp_manual2()" value="simpan" name="input_stok_masuk_manual2" id="input_stok_masuk_manual2" class="btn btn-secondary btn-sm btn-block">Tambahkan</button></td>
										</tr>
										<input hidden value="-" type="text" id="kode_barang_manual2" class="form-control form-control-sm" readonly="readonly">
									</table>
								</div>
							</div>
						</div>
					</form>
				</div>
				<div id="kanan">
					<div class="ex3">
						<form method="post" onsubmit="return sebelum_manual()" id="form_tampil" name="myff2" action="simpan-trmasuk-manual">
							<div class="table-responsive">
								<div class="form-group">
									<div class="container">
										<table border="0" class="table table-borderless" style="background-color:#ffffff" cellpadding="2" cellspacing="2" align=center>
											<?php
												$totpcs=0;
												$no=1;
												$oleh = $_SESSION['username'];
												$kod_trs = $_POST['kode_transaksi'];
												$data_temp = mysqli_query($koneksi,"select * from t_stok_masuk_temp where OLEH='".$oleh."' order by ID DESC");
												while($d = mysqli_fetch_array($data_temp)){
													$harga3=0;
													$qty=$d['QTY'];
													$qty=$qty." pcs";                                     
													$qtyno=$d['QTY'];                  
													$kode_aktifnya = "MANUAL";												
													$kod_bar = $d['KODE_BARANG'];
													$jenbar = $d['JENIS_BARANG'];
													$kode_transaksi = $d['KODE_TRANSAKSI'];
													$warna = $d['WARNA'];
													$size = $d['SIZE_'];
													$barang = $jenbar."<br>".$warna."<br>".$size."<br>".$qty;
													$satuan=number_format($d['HARGA'],0,",",".");
													$tambah=number_format($d['HARGA_TAMBAHAN'],0,",",".");
													$total=number_format($d['TOTAL'],0,",",".");
													$harga3=$harga3+$d['TOTAL'];
													$totpcs = $totpcs+$qtyno;
												
												?>
											<tr style="background-color:#f6f6f6;"align="center">
												<td><?php echo $no++; ?>.</td>
												<td align="left"><?php echo $barang; ?></td>
												<td hidden>
													<input style="text-align:center;" name="qty_<?php echo $kod_bar;?>" id="qty" onchange="update_data('<?php echo $kod_bar;?>', this.value);" value="<?php echo $qty; ?>" type="text" onclick="totalx()" class="form-control form-control-sm mata-uang" onkeyup="inputTerbilang();" maxlength="5">
												</td>
												<td colspan="2" align="right">
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
												<td colspan="2"></td>
												<td colspan="2" align="center">
													<h6 style="color:#585858"><b>Total Barang Masuk : <?php echo $totpcs_tamp; ?> </b></h6>
												</td>
											</tr>
											<tr>
												<td></td>
												<td>
													Kategori
												</td>
												<td width="5%">
													:
												</td>
												<td align="left">
													<select style="color:#fa8d70;font-weight:bold;" class="form-control form-control-sm" name="kategori_manual" id="kategori_manual">
														<option value="RETUR">Retur</option>
														<option value="MARKETING">Marketing</option>
														<option value="PRODUKSI">Produksi</option>
													</select>
												</td>
											</tr>
											<tr>					
											<tr>
												<td></td>
												<td>
													Oleh
												</td>
												<td width="5%">
													:
												</td>
												<td align="left">
													<input type="text" id="oleh_manual" maxlength="40" placeholder="Oleh..." name="oleh_manual" class="form-control form-control-sm">
												</td>
											</tr>
											<tr>
												<td></td>
												<td colspan="2">
													<a class="btn btn-dark btn-sm btn-block" onclick="delete_data2('<?php 
														session_start();
														echo $_SESSION['username'];
														?>');" title="Delete Item">Clear</a>
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
			<div id="stok" class="tabcontent">
				<br>
				<div class="kirkan">
					<form autocomplete="off" action="#" method="get" autocomplete="off">
						<table style="width:100%" border="0" align="center" cellpadding="0" cellspacing="0">
							<tr align="center">
								<td align="left">
									<h6 style="color:#242424">Cari Barang</h6>
								</td>
								<td style="width:23%" align="center">
									<select name="jenis_barang_manual93" id="jenis_barang_manual93" class="form-control form-control-sm">
										<option value="0">Pilih Jenis</option>
										<?php
											include "koneksi.php";
											$data_jenis2 = mysqli_query($koneksi,"select DISTINCT(JENIS_BARANG) FROM t_stok ORDER BY JENIS_BARANG ASC");
											while($d = mysqli_fetch_array($data_jenis2)){
												$jen = $d['JENIS_BARANG'];
											
												echo '<option value="'.$jen.'">'.$jen.'</option>';
											
											}							
											?>
									</select>
								</td>
								<td style="width:23%" align="center">
									<select name="warna_barang_manual93" id="warna_barang_manual93" class="form-control form-control-sm">
										<option value="0">Pilih Warna</option>
										<?php
											include "koneksi.php";
											$data_warna2 = mysqli_query($koneksi,"select DISTINCT(WARNA) FROM t_stok ORDER BY WARNA ASC");
											while($d = mysqli_fetch_array($data_warna2)){
												$wrn = $d['WARNA'];
											
												echo '<option value="'.$wrn.'">'.$wrn.'</option>';
											
											}							
											?>
									</select>
								</td>
								<td style="width:30%" align="center">
									<button onclick="cari_barang1__()" value="simpan1" name="btn_cari_barang1" id="btn_cari_barang1" class="btn btn-primary btn-sm btn-block">Tampilkan STOK</button> 
								</td>
							</tr>
							<tr>
								<td colspan="4">							
									</br>
								</td>
							</tr>
							<tr align="center">
								<td align="left">
									<h6 style="color:#242424">Masukkan Kode Barang</h6>
								</td>
								<td style="width:23%" align="center">
									<input type="text" id="kode_barang_2" maxlength="20" name="kode_barang_2" class="form-control form-control-sm">
								</td>
								<td style="width:23%" align="left">
									<button onclick="cari_barang2()" value="simpan2" name="btn_cari_barang2" id="btn_cari_barang2" class="btn btn-primary btn-sm">Cari</button> 
								</td>
					</form>
					<td style="width:30%" align="center">
					<form action="laporan-stok-ready-new.php" onsubmit="return cek_dulu3();" method="post" autocomplete="off" target="_blank">
					<button type="submit" class="btn btn-primary btn-sm btn-block" name="cetak_barang_ready">Cetak Barang Ready Saat ini</button>
					</form>
					</td>		
					</tr>
					<?php 
						include 'koneksi.php';
						$no=1;
						if (isset($_GET['btn_cari_barang1'])) {			
							if ($_GET['warna_barang_manual93']!='' AND $_GET['jenis_barang_manual93']!=''){
								$jenis = $_GET['jenis_barang_manual93'];
								$warna = $_GET['warna_barang_manual93'];			
								
								$pencek2 = "select JENIS_BARANG,WARNA,SIZE_,SUM(QTY) as TOT_QTY from t_stok where JENIS_BARANG='".$jenis."' AND WARNA='".$warna."' GROUP BY KODE_BARANG";
								$prosescek2 = mysqli_query($koneksi, $pencek2);
								if (mysqli_num_rows($prosescek2)<1) {
										$tampil = 'Jenis('.$jenis.') - Warna('.$warna.') -> Kosong...';
								}
								else{					
									$tampil = 'Jenis('.$jenis.') - Warna('.$warna.')';
									$data_tampil2 = mysqli_query($koneksi, "select JENIS_BARANG,WARNA,SIZE_,SUM(QTY) as TOT_QTY from t_stok where JENIS_BARANG='".$jenis."' AND WARNA='".$warna."' GROUP BY KODE_BARANG");
								}
							}
						}
						if (isset($_GET['btn_cari_barang2'])) {		
							if ($_GET['kode_barang_2']!=''){									
								$kodebar = $_GET['kode_barang_2'];
								$pencek3 = "select JENIS_BARANG,WARNA,SIZE_,SUM(QTY) as TOT_QTY from t_stok where KODE_BARANG='".$kodebar."' GROUP BY KODE_BARANG";
								$prosescek3 = mysqli_query($koneksi, $pencek3);
								if (mysqli_num_rows($prosescek3)<1) {
									$tampil = 'Kode Barang('.$kodebar.') -> Kosong...';
								}
								else{
									$tampil = 'Kode Barang('.$kodebar.')';
									$data_tampil2 = mysqli_query($koneksi, "select JENIS_BARANG,WARNA,SIZE_,SUM(QTY) as TOT_QTY from t_stok where KODE_BARANG='".$kodebar."' GROUP BY KODE_BARANG");
								}
							}
						}
						
						?>
					<table style="width:45%" border="0" align="left" cellpadding="0" cellspacing="0">
					<tr align="left">
					<td colspan="5" align="left">
					<br>
					<br>
					<h6>Hasil Pencarian: <?php echo $tampil; ?></h6>
					</td>
					</tr>
					<tr align="left">
					<td colspan="5" align="left">
					<br>
					</td>
					</tr>
					<?php						
						while($d = mysqli_fetch_array($data_tampil2)){								
							$kode_aktifnya = 'STOK';
							$jenis_barang = $d['JENIS_BARANG'];
							$warnaa = $d['WARNA'];
							$sizee = $d['SIZE_'];
							$qty = $d['TOT_QTY'];
							$qty_tamp = number_format($qty,0,",",".");
							?>
					<tr style="background-color:#00000;" align="left">
					<td width="10%" align="center"><h5><b><?php echo $no; ?>.</b></h5></td>
					<td width="30%" align="left"><h5><b><?php echo $jenis_barang; ?></b></h5></td>
					<td width="30%" align="left"><h5><b><?php echo $warnaa; ?></b></h5></td>
					<td width="15%" align="left"><h5><b><?php echo $sizee; ?></b></h5></td>
					<td width="15%" align="right"><h5><b><?php echo $qty_tamp; ?></b></h5></td>
					</tr>
					<?php  $no++; 
						}
							?>
					</table>
					</table>
				</div>
			</div>
			<input hidden type="text" id="tempat_cek" maxlength="12" value="<?php echo $kode_aktifnya; ?>" name="tempat_cek" class="form-control form-control-lg" readonly=readonly>
			<script type="text/javascript">
				function kategori_barang_masuk(evt, cityName) {
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
			<script type="text/javascript">
				var kode_aktif = $('#tempat_cek').val();
				 if (kode_aktif=="MASSAL"){
				  document.getElementById("btn_massal").click();				  
				 }
				 else if (kode_aktif=="MANUAL"){
				  document.getElementById("btn_manual").click();
				  document.getElementById("kode_barang_manual").focus();
				 }
				 else if (kode_aktif=="STOK"){				  
				  document.getElementById("btn_stok").click();
				  document.getElementById("jenis_barang_manual93").focus();
				 }
				 else{
				  document.getElementById("btn_history").click();
				 }
				 function kategori(){
				  alert('c');
				 }
			</script>
			<script src="js/jquery.mask.min.js"></script>
			<script src="js/terbilang.js"></script>
			<script>
				function inputTerbilang() {
				  //membuat inputan otomatis jadi mata uang
				  $('.mata-uang').mask('0.000.000.000', {
					reverse: true
				  });
							  
					var qty_manual = document.getElementById('qty_manual').value;
					var qty_manual2 = document.getElementById('qty_manual2').value;
						if (qty_manual == "" || qty_manual == "0"){
							document.getElementById("qty_manual").value = "1";
						}
						if (qty_manual2 == "" || qty_manual2 == "0"){
							document.getElementById("qty_manual2").value = "1";
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
				if (confirm("Hapus Item ini?")) {			
				$.ajax({
				  type: "get",
				  url: "hapus-stok-masuk-detail.php",
				  data: {kode_barang:kode_barang},
				  success: function(value){
					 alert('Berhasil hapus');
					 location.reload(true);					 
				  }
				});
				document.getElementById("btn_manual").click();
				}
				else{
				return false;
				}
				}
			</script>
			<script type="text/javascript">
				function delete_data2(abc){
				var userx = abc;
				if (confirm("Hapus Semua?")) {			
				$.ajax({
				  type: "get",
				  url: "hapus-semua-stok-masuk-detail.php",
				  data: {userx:userx},
				  success: function(value){
					 alert('Berhasil hapus');
					 location.reload(true);
				  }
				});
				document.getElementById("btn_manual").click();
				}
				else{
				return false;
				}
				}
			</script>
			<script type="text/javascript">
				function cek_jenis(){
				var jenis = document.getElementById('jenis_barang_manual2').value;
				//alert(jenis);
				<?php
					session_start();						
					$_SESSION['ses_jen_barang_manual'] = $jen;
					?>
				
				}
			</script>
			<script type="text/javascript">
				function cari_barang1(){				
					var warna = $('#warna_barang_manual93').val();				
					var jenis = $('#jenis_barang_manual93').val();
					if (kode_barang.length==0){
						alert('Kode Barang belum diinput');
					}
					else if(keterangan_manual == '-'){
						alert('Kode Barang tidak valid');
					}
					else{
						$.ajax({
						  method: "POST",
						  url: "simpan-stok-masuk.php",
						  data: {tujuan : tujuan,kode_transaksi : kode_transaksi,kode_barang : kode_barang, qty : qty,type:"insert"},					
						  success	: function(data){
									document.getElementById("btn_manual").click();	
									$("#kode_aktif").val('btn_manual');
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
				function simpan_temp_manual(){				
					var kode_barang = $('#kode_barang_manual').val();				
					var kode_transaksi = $('#kode_transaksi_manual').val();
					var keterangan_manual = $('#keterangan_manual').val();
					var tujuan = $('#tujuan_manual').val();					
					var kode_aktif = $('#kode_aktif').val();					
					var qty = $('#qty_manual').val();
					var qty = qty.replace(".","");	
					if (kode_barang.length==0){
						alert('Kode Barang belum diinput');
					}
					else if(keterangan_manual == '-'){
						alert('Kode Barang tidak valid');
					}
					else{
						$.ajax({
						  method: "POST",
						  url: "simpan-stok-masuk.php",
						  data: {tujuan : tujuan,kode_transaksi : kode_transaksi,kode_barang : kode_barang, qty : qty,type:"insert"},					
						  success	: function(data){
									document.getElementById("btn_manual").click();	
									$("#kode_aktif").val('btn_manual');
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
				function simpan_temp_manual2(){				
					var kode_barang = $('#kode_barang_manual2').val();				
					var kode_transaksi = $('#kode_transaksi_manual2').val();	
					var qty = $('#qty_manual2').val();
					var qty = qty.replace(".","");	
					if (kode_barang == '-'){
						alert('Kode Barang Tidak ditemukan...');
					}
					else{
						$.ajax({
						  method: "POST",
						  url: "simpan-stok-masuk.php",
						  data: {kode_transaksi : kode_transaksi,kode_barang : kode_barang, qty : qty,type:"insert"},					
						  success	: function(data){
									document.getElementById("btn_manual").click();	
									$("#kode_aktif").val('btn_manual');
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
				function isi_otomatis_manual(a){			   				
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
								$('#qty_manual').val("1");	
								var semua = jenis_barang+"\n"+warna+"\n"+sizee;							
								if(sizee==null){
									//alert('kode barang tidak ditemukan.....')
									$('#keterangan_manual').val("-");
								}
								else{
									$('#keterangan_manual').val(semua);
									document.getElementById("qty_manual").focus();
									//alert('ok');
								}
							}
						});
				}			
			</script>
			<script>
				function sebelum_manual() {         	
				  var oleh_manual = document.getElementById("oleh_manual").value; 
				  if(oleh_manual==""){
					  alert('Isi Oleh terlebih dahulu...');
					  document.getElementById("oleh_manual").focus();
					  return false;
				  }
					else{
						return confirm('Yakin ingin simpan?');         	 
					}
				}
				      
				   
			</script>
			<script type="text/javascript">
				function cek_kode_barang(){			   				
					var warnax = $("#warna_barang_manual2").val();
					var jenis_barangx = $("#jenis_barang_manual2").val();
					var sizex = $("#size_barang_manual2").val();	
					//alert(warnax);
					 if (jenis_barangx == 0){
						 $('#kode_barang_manual2').val('-');
						//alert(jenis_barangx);
					 }
					 else if (sizex == 0){
						 $('#kode_barang_manual2').val('-');
						 //alert(sizex);
					 }
					 else if (warnax == 0){
						 $('#kode_barang_manual2').val('-');
						 //alert(warnax);
					 }
					 else{	
						$.ajax({
							url: 'list-kode-barang.php',
							type: 'get',
							data     : 'warna='+warnax+'&jenis_barang='+jenis_barangx+'&size_='+sizex,
							success: function (data) {
								var json = data,
								obj = JSON.parse(json);
								$('#kode_barang_manual2').val(obj.kode_barang);	
							}
						});
					 }
				}			
				
				function cek_dulu3(){
					return confirm('Pilih OK untuk mencetak barang ready saat ini');         
													
				}			
			</script>
		</div>
		<div class="navbar_bot">
			<?php include "bantuan/footer.php" ?>
		</div>
	</body>
</html>