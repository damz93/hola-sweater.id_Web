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
		<title>PENGATURAN - HOLASWEATER.ID</title>
		<link rel="shortcut icon" href="img/hola_ic.png">
		<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
		<script src="js/bootstrap-datepicker.js"></script>	
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
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
			<a class="nav-link" href="barang-keluar-new"><b>Barang Keluar</b></a>
			<a class="nav-link" href="pemasukan-new"><b>Pemasukan</b></a>
			<a class="nav-link" href="pengeluaran-new"><b>Pengeluaran</b></a>
			<a class="nav-link" href="laporan-new"><b>Summary & Report</b></a>
			<a class="active" href="pengaturan-new"><b>Preferences</b></a>
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
				$kode_aktifnya='';
				?>	
			<h2>Preferences</h2>
			<div class="tab">
				<button class="tablinks" id="btn_l_data" onclick="kategori_pengeluaran(event, 'l_data')">
				<b>Data User</b>
				<button class="tablinks" id="btn_l_tambah" onclick="kategori_pengeluaran(event, 'l_tambah')">
				<b>Tambah User</b>		
				</button>
				<button class="tablinks" id="btn_l_setting" onclick="kategori_pengeluaran(event, 'l_setting')">
				<b>Home Page Setting</b>
				</button>
			</div>
			<div style="display: block;" id="l_tambah" class="tabcontent">
				<br>
				<h4 style="color:#284d58">Tambah Data User</h4>
				<br>
				<form action="simpan-user-new.php" onsubmit="return cek_tambah_user();" method="post" autocomplete="off">
					<div class="container">
						<div class="table-responsive">
							<table style="width:100%" border="0" align="left" cellpadding="0" cellspacing="0">
								<div class="form-group">
									<tr>
										<td align="left" style="width:25%">
											<b>User ID</b>
										</td>
										<td align="center" style="width:5%">
											<b>:</b>
										</td>
										<td align="left">
											<input class="form-control form-control-sm" id="user_id" onkeyup="cek_username();" value="" placeholder="User ID yang akan dipakai untuk login" maxlength="50" type="text" name="user_id" autofocus>
											<input hidden class="form-control form-control-sm" id="user_id2" value="" placeholder="username 2" maxlength="50" type="text" name="user_id2" autofocus>
										</td>
										<td style="width:5%">						
										</td>
									</tr>
									<tr>
										<td align="left" style="width:25%">
											<b>Nama Lengkap</b>
										</td>
										<td align="center" style="width:5%">
											<b>:</b>
										</td>
										<td align="left">
											<input class="form-control form-control-sm" id="nama_lengkap" value="" placeholder="Nama Lengkap" maxlength="60" type="text" name="nama_lengkap">
										</td>
										<td style="width:5%">						
										</td>
									</tr>
									<tr>
										<td align="left" style="width:25%">
											<b>Nickname</b>
										</td>
										<td align="center" style="width:5%">
											<b>:</b>
										</td>
										<td align="left">
											<input class="form-control form-control-sm" id="nicname" value="" placeholder="Nickname" maxlength="30" type="text" name="nicname">
										</td>
										<td style="width:5%">						
										</td>
									</tr>
									<tr>
										<td align="left" style="width:25%">
											<b>Tanggal Lahir</b>
										</td>
										<td align="center" style="width:5%">
											<b>:</b>
										</td>
										<td align="left">
											<input class="form-control form-control-sm datepicker" value="" type="text" placeholder="yyyy-mm-dd"  id="tgl_lahir" name="tgl_lahir">		
										</td>
										<td style="width:5%">						
										</td>
									</tr>
									<tr>
										<td align="left" style="width:25%">
											<b>Whatsapp</b>
										</td>
										<td align="center" style="width:5%">
											<b>:</b>
										</td>
										<td align="left">
											<input class="form-control form-control-sm" id="wassap" value="" placeholder="08XXX" maxlength="20" type="number" name="wassap">	
										</td>
										<td style="width:5%">						
										</td>
									</tr>
									<tr>
										<td align="left" style="width:25%">
											<b>Alamat</b>
										</td>
										<td align="center" style="width:5%">
											<b>:</b>
										</td>
										<td align="left">
											<textarea rows="4" cols="50" class="form-control form-control-sm" value="" id="alamat" placeholder="Alamat" maxlength="300" type="text" name="alamat"></textarea>
										</td>
										<td style="width:5%">						
										</td>
									</tr>
									<tr>
										<td align="left" style="width:25%">
											<b>Jabatan</b>
										</td>
										<td align="center" style="width:5%">
											<b>:</b>
										</td>
										<td align="left">
											<select class="form-control" name="jabatan" id="jabatan">
												<option value="0">Pilih Jabatan</option>
												<option value="ACCOUNTING">Accounting</option>
												<option value="ADMIN">Admin</option>
												<option value="OFFLINE STORE">Offline Store</option>
												<option value="ONLINE STORE">Online Store</option>
												<option value="PURCHASING">Purchasing</option>
												<option value="STAFF">Staff</option>
												<option value="WAREHOUSE">Warehouse</option>
											</select>
										</td>
										<td style="width:5%">						
										</td>
									</tr>
									<tr>
										<td align="left" style="width:25%">
											<b>Password</b>
										</td>
										<td align="center" style="width:5%">
											<b>:</b>
										</td>
										<td align="left">
											<input type="password" name="password" id="password" value="" class="form-control form-control-sm" placeholder="*********">
										</td>
										<td style="width:5%">						
										</td>
									</tr>
									<tr>
										<td><br>
										</td>
									</tr>
									<tr>
										<td align="right" colspan="3">
											<button style="width:100%" type="submit" class="btn btn-primary btn-sm" name="create_data_user">Create </button>
										</td>
									</tr>
								</div>
							</table>
						</div>
					</div>
				</form>
			</div>
			<div style="display: block;" id="l_setting" class="tabcontent">
				<br>
				<h4 style="color:#284d58">Home Page Setting</h4>
				<br>
				<div class="container">
					<div class="table-responsive">
						<form action="simpan-home-new.php" onsubmit="return sebelum_home();" method="post" autocomplete="off">
							<table style="width:100%" border="0" align="left" cellpadding="0" cellspacing="0">
								<div class="form-group">
									<tr>
										<td align="left" style="width:35%">
											<b>Target Bulanan</b>
										</td>
										<td colspan="center" width="3%"><b>:</b>
										</td>
										<td colspan="left">
											<input type="text" value="1" id="target" class="form-control form-control-sm mata-uang" onkeyup="inputTerbilang();" name="TARGET">
										</td>
										<td style="width:5%">						
										</td>
									</tr>
									<tr>
										<td align="left" style="width:35%">
											<b>Masukkan Quote</b>
										<td colspan="center" width="3%"><b>:</b>
										</td>
										<td colspan="left">
											<textarea rows="10" cols="50" class="form-control form-control-sm" id="kata" placeholder="Kerja, kerja, kerja......" maxlength="300" type="text" name="KATA"></textarea>
										<td>
										<td style="width:5%">						
										</td>
									</tr>
									<tr>
										<td><br>
										</td>
									</tr>
									<tr>
										<td align="right" colspan="3">
											<button style="width:100%" type="submit" class="btn btn-primary btn-sm" name="create_data_home">Apply</button>	
										</td>
									</tr>
								</div>
							</table>
						</form>
					</div>
				</div>
			</div>
			<div style="display: block;" id="l_data" class="tabcontent">
				<br>
				<h4 style="color:#284d58">Data User</h4>
				<br>
				<div class="kirkan">
					<div class="table-responsive">
						<table id="tabel1" class="table table-hover" border="0" cellpadding="0" cellspacing="1">
							<thead align="center">
								<tr style="background-color:#585657;color:#FFFFFF;" align='center'>
									<th>No.</th>
									<th>Username</th>
									<th>Nama</th>
									<th>Jabatan</th>
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
								$data = mysqli_query($koneksi,"select * from t_user WHERE AKTIF='YA' AND LEVEL<>'OWNER' order by ID desc");
								while($d = mysqli_fetch_array($data)){
								?>
							<tr align="center">
								<td><?php echo $no++; ?></td>
								<td align="left"><?php echo $d['USERNAME']; ?></td>
								<td align="left"><?php echo $d['NAMA']; ?></td>
								<td align="center"><?php echo $d['LEVEL']; ?></td>
								<td>			
									<a href='edit-user-new?id=<?php echo $d['ID']; ?>' title="Edit User">
									<img src="img/edit.png" class="img-responsive" height="100%"></a>	| 
									<a href='hapus-user-new?id=<?php echo $d['ID']; ?>' title="Hapus User" onclick="return confirm('Are you sure you want to delete?')"><img src="img/delete.png" height="100%" ></a>
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
							  "lengthMenu": "Menampilkan _MENU_ Data User",
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
			</div>
			<input hidden type="text" id="tempat_cek" maxlength="12" value="<?php echo $kode_aktifnya; ?>" name="tempat_cek" class="form-control form-control-sm" readonly=readonly>
			<script type="text/javascript">
				function kategori_pengeluaran(evt, cityName) {
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
				 if (kode_aktif=="SETTING"){
				  document.getElementById("btn_l_setting").click();
				  //document.getElementById("id_cek_tanggal_dana_keluar1").focus();			  
				 }
				 else if (kode_aktif=="TAMBAH"){
				  document.getElementById("btn_l_tambah").click();		  
				  document.getElementById("user_id").focus();
				 }
				 else{
				  document.getElementById("btn_l_data").click();
				  document.getElementById("id_cek_tanggal_keluar1").focus();	
				 }
				 function kategori(){
				  alert('c');
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
				function sebelum_home(){
					var ctarget = document.getElementById('target').value;
					var ckata = document.getElementById('kata').value;
					if(ckata == ''){
						alert('Masukkan Quote...');
						document.getElementById('kata').focus();
						return false;
					}
					else{
						return confirm('Pilih OK untuk update Home-Page');   
					}
				}
			</script>
			<script>				
				function cek_tambah_user(){
					var cuser = document.getElementById('user_id').value;
					var cnama_lengkap = document.getElementById('nama_lengkap').value;
					var cnicname = document.getElementById('nicname').value;
					var ctgl_lahir = document.getElementById('tgl_lahir').value;
					var cwassap = document.getElementById('wassap').value;
					var calamat = document.getElementById('alamat').value;
					var cjabatan = document.getElementById('jabatan').value;
					var cpassword = document.getElementById('password').value;
					
					if(cuser == ''){
						alert('Username kosong...');
						document.getElementById('user_id').focus();
						return false;
					}
					else if(cnama_lengkap == ''){
						alert('Nama Lengkap kosong...');
						document.getElementById('nama_lengkap').focus();
						return false;
					}
					else if(cnicname == ''){
						alert('Nickname kosong...');
						document.getElementById('nicname').focus();
						return false;
					}
					else if(ctgl_lahir == ''){
						alert('Tanggal Lahir kosong...');
						document.getElementById('tgl_lahir').focus();
						return false;
					}
					else if(cwassap == ''){
						alert('Whatsapp kosong...');
						document.getElementById('wassap').focus();
						return false;
					}
					else if(calamat == ''){
						alert('Alamat kosong...');
						document.getElementById('alamat').focus();
						return false;
					}
					else if(cjabatan == 0){
						alert('Jabatan kosong...');
						document.getElementById('jabatan').focus();
						return false;
					}
					else if(cpassword == ''){
						alert('Password kosong...');
						document.getElementById('password').focus();
						return false;
					}
					else{
						return confirm('Pilih OK untuk menyimpan user');         
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
				function cek_username(){			   				
					var username = $("#user_id").val();
					if (username == ""){
					}
					else{
						$.ajax({
							url: 'list-username.php',
							type: 'get',
							data     : 'username='+username,
							success: function (data) {
								 var json = data,
								 obj = JSON.parse(json);
								 $('#user_id2').val(obj.username);
								var kod1 = $('#user_id').val(); 
								var kod2 = $('#user_id2').val(); 
								if (kod1 == kod2){
									alert('Usename sudah ada....');					
									document.getElementById("user_id").focus();	
									document.getElementById("user_id").value = ""; 
									document.getElementById("user_id2").value = "-"; 
								}
							}
						});
					}
				}					
			</script>	
			<script>
				function inputTerbilang() {
				//membuat inputan otomatis jadi mata uang
				$('.mata-uang').mask('0.000.000.000', {
				 reverse: true
				});
				
				var target = document.getElementById('target').value;				
				if (target == "" || target == "0"){
				document.getElementById("target").value = "1";
				}
				}
			</script>
		</div>
		<div class="navbar_bot">
			<?php include "bantuan/footer.php" ?>
		</div>
	</body>
</html>