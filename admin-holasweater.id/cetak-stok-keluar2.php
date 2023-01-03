<!DOCTYPE html>
<html moznomarginboxes mozdisallowselectionprint>
	<head>
		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<title>Cetak Stok Keluar - S W E A T E R I N</title>
			<link rel="shortcut icon" href="img/tokonline.png">
			<meta http-equiv="refresh" content="5; url=home">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="stylesheet" href="css/freelancer.min.css">
			<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
			<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
			<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
			<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
			<script data-ad-client="ca-pub-5256228815542923" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<style type="text/css">
				.left    { text-align: left;}
				.right   { text-align: right;}
				.center  { text-align: center;}
				.justify { text-align: justify;}
			</style>
			<!--<style type="text/css" media="print">
				@page {
				size: 72.1px, 210px;   /* auto is the initial value */    
				}
				</style>-->
			<style type="text/css" media="print">
				@media screen {
				p.bodyText {font-family:verdana, arial, sans-serif;}
				}
				@media print {
				p.bodyText {font-family:georgia, times, serif;}
				}
				@media screen, print {
				p.bodyText {font-size:9pt}
				size: auto;
				}
			</style>
	</head>
	</head>
	<body>
		<?php
			include 'koneksi.php';
			date_default_timezone_set('Asia/Hong_Kong');

			session_start();
			$usnme = $_SESSION['username'];			
			$levell = $_SESSION['level'];		
			$total_bangetz = 0;
			$kode_transaksi   = $_GET['kode_transaksi'];
			$waktu_skg = date("d/m/Y");
			$jam = date("H:i:s");
						
			error_reporting(0);
			if($_SESSION['status']!="login"){
				echo "<script>alert('Anda belum login.....');window.location.href='index?pesan=belum_login';</script>";                    
			}
			else if ($_SESSION['level']!="OWNER" AND $_SESSION['level']!="WAREHOUSE" AND $_SESSION['level']!="ACCOUNTING"){
				echo "<script>alert('Anda tidak memiliki akses.....');window.location.href='javascript:history.go(-1)';</script>";
			}			
						
			$pengeluaran  = mysqli_query($koneksi, "select TGL,KODE_TRANSAKSI_AUTO,KODE_TRANSAKSI,PELANGGAN,OLEH2,SUM(QTY)AS JUMLAH from t_stok_keluar where KODE_TRANSAKSI_AUTO='$kode_transaksi'");
				while($data = mysqli_fetch_array($pengeluaran)){				
					$date_ = date_create($data['TGL']);					
					$kod_trx = $data['KODE_TRANSAKSI'];
					$tujuan = $data['PELANGGAN'];
					$oleh2 = $data['OLEH2'];
					$tgl2 = date_format($date_,'d-m-Y');  
					$juml = $data['JUMLAH'];
					$jumlah = number_format($juml,0,',','.');
				}
			?>
		<table border="0" style="width:28%" align='left'>
			<tr hidden align="left">
				<td colspan="3">
					<p style="font-size: 10px;">
						<?php echo $waktu_skg."-".$jam; ?>
					</p>
				</td>
			</tr>
			<tr align="left">
				<td colspan="3">						
					<b>holasweater.id</b>
					<hr style="height:5px;color:black;background-color:black"></td>
			</tr>
			<tr align='left'>
				<td colspan="3">
					<h4>Barang Keluar</h4>
				</td>
			</tr>
			<tr align='center'>
				<td align='left'>
					Kode Input
				</td>
				<td align='center'>
					:
				</td>
				<td align='left'>
					<?php echo $kode_transaksi; ?>
				</td>
			</tr>
			<tr align='center'>
				<td align='left'>
					Tanggal
				</td>
				<td align='center'>
					:
				</td>
				<td align='left'>
					<?php echo $tgl2; ?><br>
				</td>
			</tr>
			<tr>
				<td>
				<br>
				</td>
			</tr>
			<tr align='center'>
				<td align='left'>
					Tujuan
				</td>
				<td align='center'>
					:
				</td>
				<td align='left'>
					<?php echo $tujuan; ?>
				</td>
			</tr>
			<tr align='center'>
				<td align='left'>
					Jumlah
				</td>
				<td align='center'>
					:
				</td>
				<td align='left'>
					<?php echo $jumlah; ?>
				</td>
			</tr>
			<tr align='center'>
				<td align='left'>
					Detail
				</td>
				<td align='center'>
					:
				</td>
				<td align='left'>
					<?php echo $kod_trx; ?>
				</td>
			</tr>
			<tr align='center'>
				<td align='left'>
					Oleh
				</td>
				<td align='center'>
					:
				</td>
				<td align='left'>
					<?php echo $oleh2; ?>
					<br>
				</td>
			</tr>
			<tr>
				<td>
				<br>
				<br>
				</td>
			</tr>
			<tr align='center'>
				<td align='left'>
					<?php echo $levell; ?>
				</td>
				<td align='center'>
					:
				</td>
				<td align='left'>
					<?php echo $usnme; ?>
				</td>
			</tr>
		</table>
		<script>
			window.print();
		</script>
	</body>
</html>