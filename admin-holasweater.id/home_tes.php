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
		<link rel="shortcut icon" href="img/hola_ic.png">
		<title>HOME - HOLASWEATER.ID</title>
		<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
		<script src="js/bootstrap-datepicker.js"></script>
		<link rel="stylesheet" href="css/css-terpakai.css">
		<link rel="stylesheet" href="css/datepicker.css">
		
	</head>
	<body>
		<div class="sidebar">
			<h1 style="color:#73607c"> <b>holasweater.id</b></h1>
			<br>
			<a class="active" href="home2"><b>Home</b></a>
			<a class="nav-link" href="barang-masuk-new2"><b>Stok dan Barang Masuk</b></a>
			<a class="nav-link" href="barang-keluar-new2"><b>Barang Keluar</b></a>
			<a class="nav-link" href="pemasukan-new2"><b>Pemasukan</b></a>
			<a class="nav-link" href="pengeluaran-new2"><b>Pengeluaran</b></a>
			<a class="nav-link" href="laporan-new2"><b>Summary & Report</b></a>
			<a class="nav-link" href="pengaturan-new2"><b>Preferences</b></a>
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
				include "koneksi.php";
				$penjualan  = mysqli_query($koneksi, "select SUM(QTY) AS TOT_QTY, SUM(COSTUM) AS TOT_CS from  t_pemasukan2 where MONTH(TGL)='$bulan' AND YEAR(TGL)='$tahun'");
					while($data = mysqli_fetch_array($penjualan)){
									$pcs_trjual = $data['TOT_QTY'];							
									$pcs_trjual = number_format($pcs_trjual,0,',','.');	
									$tot_cos = $data['TOT_CS'];							
									$tot_cost = number_format($tot_cos,0,',','.');	
								}
				$sisa  = mysqli_query($koneksi, "select SUM(QTY) AS TOT_QTY from t_stok WHERE QTY>0");
					while($dat2a = mysqli_fetch_array($sisa)){
									$sisa2 = $dat2a['TOT_QTY'];							
									$sisa_ = number_format($sisa2,0,',','.');	
								}
				$home  = mysqli_query($koneksi, "select * from t_home ORDER BY ID DESC LIMIT 1");
					while($dhome = mysqli_fetch_array($home)){
									$target = $dhome['TARGET'];							
									$kata = $dhome['KATA'];							
									$target_ = number_format($target,0,',','.');	
								}
				?>
			<table style="width:93%" class="responsive" border="0" align="center" cellpadding="0" cellspacing="0">
				<tr>
					<td align="left" colspan="2">
						<img src="img/welcome.png" align="left"/></br>
						<p style="font-size:24pt;color:#2d2d2d;text-align:left;font-weight:bold;">&nbsp<?php echo $username; ?></p>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<textarea style="width:100%;font-weight:bold;background-color:#c1c1c1;color:#73607c;font-size:18pt" class="form-control form-control-sm" rows="6" readonly="readonly" cols="4" name="t_area_deks" id="t_area_deks"><?php echo $kata; ?></textarea>
					</td>
				</tr>
				<tr>
					<td colspan="2" align="right">
						<br>
						<p style="color:#73607c;font-size:14pt;font-weight:bold"><?php echo $tgl_lengk;?></p>
					<td>
				</tr>
				<tr>
					<td align="center" width="100%">
						<button id="btn_intip" type="button" class="collapsible">
							<p style="font-size:16pt;text-align:center;color:#533f5c"><b>&darr; &nbsp Intip Pencapaian Hari ini Yuk &nbsp &darr;</b></p>
						</button>
						<div class="content2">
							<table style="width:95%" border="0" align="center" cellpadding="0" cellspacing="0">
								<tr>
									<td>
										<br>
									</td>
								</tr>
								<tr>
									<td><b>Total Penjualan PCS
									</td>
									<td width="5%"><b>:
									</td>
									<td align="right"><b>
										<?php echo $pcs_trjual; ?>
									</td>
									<td width="20%">
									</td>
									<td><b>Sisa Barang Ready
									</td>
									<td width="5%"><b>:
									</td>
									<td align="right"><b>
										<?php echo $sisa_; ?>
									</td>
								</tr>
								<tr>
									<td><b>Total Costum Sablon
									</td>
									<td width="5%"><b>:
									</td>
									<td align="right"><b>
										<?php echo $tot_cost; ?>
									</td>
									<td width="20%">
									</td>
									<td><b>Target Bulanan
									</td>
									<td width="5%"><b>:
									</td>
									<td align="right"><b>
										<?php echo $target_; ?>
									</td>
								</tr>
							</table>
						</div>
					</td>
				</tr>
			</table>
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
		</div>
		<div class="navbar_bot">
			<?php include "bantuan/footer.php" ?>
		</div>
	</body>
</html>