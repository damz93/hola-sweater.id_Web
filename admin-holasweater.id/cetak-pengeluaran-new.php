<?php
	$tgl_hari_ini =  date('l, d-m-Y');
?>
<!DOCTYPE html>
<html moznomarginboxes mozdisallowselectionprint>
	<head>
		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<title>Cetak Nota Pengeluaran - HOLASWEATER.ID</title>
			<link rel="stylesheet" href="css/journ_bootstrap.min.css">
			<link rel="shortcut icon" href="img/hola_ic.png">
			<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
			<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
			<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
			<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
			<script src="js/bootstrap-datepicker.js"></script>
			<link rel="stylesheet" href="css/datepicker.css">
			<style type="text/css">
				.left    { text-align: left;}
				.right   { text-align: right;}
				.center  { text-align: center;}
				.justify { text-align: justify;}
			</style>
			<style type="text/css" media="print">
				@page {
				size: a4;   /* auto is the initial value */
				margin: 5;  /* this affects the margin in the printer settings */
				}
			</style>
	</head>
	</head>
	<body>
	
	<?php 
         error_reporting(0);
         session_start();
		 $s_level = $_SESSION['level'];
		 $s_user = $_SESSION['username'];
         if ($_SESSION['status']!="login") {
			echo "<script>alert('Anda belum login.....');window.location.href='index?pesan=belum_login';</script>";
		}
		else if ($_SESSION['level']!="OWNER" AND $_SESSION['level']!="PURCHASING" AND $_SESSION['level']!="BENDAHARA"){
			echo "<script>alert('Anda tidak memiliki akses.....');window.location.href='javascript:history.go(-1)';</script>";
		}
		else {
			
			include 'koneksi.php';
			date_default_timezone_set('Asia/Hong_Kong');
			$waktu_skg = date("d/m/Y");
			$jam = date("H:i:s");
			$kode= $_GET['kode_transaksi'];
			function formatTanggal($date){
			 // ubah string menjadi format tanggal
			 return date('d-m-Y', strtotime($date));
			}
				
			$data_barang = mysqli_query($koneksi, "SELECT * from t_pengeluaran WHERE KODE_PENGELUARAN='$kode'");
			
				$no = 1;		
				$total_keluar=0;
				  while($data = mysqli_fetch_array($data_barang)){					
					$waktuu = $data['WAKTU'];
					$tglny = date_create($data['TGL']);   
					$tglnya = date_format($tglny,'d F Y');  
					$kodpenn = $data['KODE_PENGELUARAN'];
					$katee = $data['KATEGORI'];
					$ketee = $data['NOTES'];
					$oleh = $data['PERMINTAAN'];
					$nomii = $data['NOMINAL'];  								
					$nomii_tamp = "Rp" . number_format($nomii,0,',','.');      	}
				
		}
      ?>		
			<h1 style="color:#73607c" class="right"><font color="#73607c">HOLASWEATER.ID</font></h1>
			<h5 class="right"><?php echo $tgl_hari_ini; ?></h5>
			<h3 style="color:#73607c" class="left">Bukti Input Pengeluaran</h3></br>
			<table border="0" style="width: 30%" align="left">
				<tr>
					<td>
						<h5 style="color:#73607c" class="left">Kode Input</h5>
					</td>
					<td style="width: 5%"
						<h5 style="color:#73607c" class="center">:</h5>
					</td>
					<td>
						<h5 style="color:#73607c" class="left"><?php echo $kode; ?></h5>
					</td>
				</tr>
				<tr>
					<td>
						<h5 style="color:#73607c" class="left">Tanggal Input</h5>
					</td>
					<td style="width: 5%"
						<h5 style="color:#73607c" class="center">:</h5>
					</td>
					<td>
						<h5 style="color:#73607c" class="left"><?php echo $tglnya; ?></h5>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<br>
					</td>
				</tr>
				<tr>	
					<td>
						<h5 style="color:#73607c" class="left">Keperluan</h5>
					</td>
					<td style="width: 5%"
						<h5 style="color:#73607c" class="center">:</h5>
					</td>
					<td>
						<h5 style="color:#73607c" class="left"><?php echo $katee; ?></h5>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<br>
					</td>
				</tr>
			</table>
			
	
		<table border="0" style="width: 100%" align="center">
			<tr align='center' style="background-color:#393939;color:#ffffff">
				<th colspan="2" ><h5><font color="#ffffff">Detail Pengeluaran</font></h5></th>
			</tr>
			<tr rowspan="3">
				<th colspan="2" style="background-color:#c3c3c3;color:#ffffff"><?php echo nl2br(htmlspecialchars($ketee));?></th>
			</tr>
			<tr>
				<th colspan="2"><br></td>
			</tr>		
			<tr>
				<td align="left" style="background-color:#c3c3c3;color:#ffffff"><b>Total Tagihan</td>
				<td align='center' style="background-color:#c3c3c3;color:#ffffff"><b>: <?php echo $nomii_tamp; ?></b></td>
			</tr>
		</table>
		
			<table border="0" style="width: 100%" align="center">
					
			<tr>
				<th colspan="2"><br><br></td>
			</tr>		
			<tr>
				<td align="left"><b>Diajukan Oleh: <?php echo $oleh; ?> </td>
				<td align='center'><b>Disetujui Oleh:</td>
			</tr>				
			<tr>
				<th colspan="2"><br><br><br></td>
			</tr>		
			<tr>
				<td align="left"></td>
				<td align='center'><b><?php echo $s_user; ?></td>
			</tr>
			<tr>
				<td align="left"></td>
				<td align='center'><b><?php echo $s_level; ?></td>
			</tr>
			</table>	
			
		<script>
			window.print();
		</script>
	</body>
</html>