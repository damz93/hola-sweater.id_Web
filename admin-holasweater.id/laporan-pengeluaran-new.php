<!DOCTYPE html>
<html moznomarginboxes mozdisallowselectionprint>
	<head>
		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<title>Laporan Pengeluaran - HOLASWEATER.ID</title>
			<!--<meta http-equiv="refresh" content="5; url=form-laporan">-->
			<link rel="shortcut icon" href="img/hola_ic.png">
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
			<style type="text/css" media="print">
				@page {
				size: a4;   /* auto is the initial value */
				margin: 1;  /* this affects the margin in the printer settings */
				}
			</style>
	</head>
	</head>
	<body>
	
	<?php 
         error_reporting(0);
         session_start();
         if ($_SESSION['status']!="login") {
			echo "<script>alert('Anda belum login.....');window.location.href='index?pesan=belum_login';</script>";
		}
		else if ($_SESSION['level']!="OWNER" AND $_SESSION['level']!="PURCHASING" AND $_SESSION['level']!="BENDAHARA"){
			echo "<script>alert('Anda tidak memiliki akses.....');window.location.href='javascript:history.go(-1)';</script>";
		}
		else {
			
		}
      ?>
		<u>
			<h1 class="center">LAPORAN PENGELUARAN</h1>
		</u>
		<h3 class="center">HOLASWEATER.ID</h3>
		<?php
			include 'koneksi.php';
			date_default_timezone_set('Asia/Hong_Kong');
			$waktu_skg = date("d-M-Y");
			$jam=date("H:i:s a");
			
			$divisi = $_POST['tujuan_dana_keluar2'];
			function formatTanggal($date){
			 // ubah string menjadi format tanggal
			 return date('d-m-Y', strtotime($date));
			}
			if (isset($_POST['cetak_dana_keluar']))
			{			
				$tglnya = $_POST['cek_tanggal_dana_keluar1'];
				$tgl_nya = date_create($tglnya);
				$tgl_awalz = date_format($tgl_nya,"Y/m/d");
				
				$tglakhir = $_POST['cek_tanggal_dana_keluar2'];
				$tgl_akhir = date_create($tglakhir);
				$tgl_akhirz = date_format($tgl_akhir,"Y/m/d");
				
				
				$nama = "Laporan Pengeluaran(" . formatTanggal($tglnya) ." s.d. ". formatTanggal($tglakhir).")";
				$tujuan = $_POST['tujuan_dana_keluar2'];
				if ($tujuan != 'SEMUA'){	
					$data_barang = mysqli_query($koneksi, "SELECT * from t_pengeluaran WHERE DIVISI='".$tujuan."' AND (TGL BETWEEN '".$tgl_awalz."' AND '".$tgl_akhirz."') ORDER BY TGL ASC");
				}
				else{
					$data_barang = mysqli_query($koneksi, "SELECT * from t_pengeluaran WHERE TGL BETWEEN '".$tgl_awalz."' AND '".$tgl_akhirz."' ORDER BY TGL ASC");
				}
			}
			
			$jumtrans = mysqli_num_rows($data_barang);
			$jumtrans = "Jumlah Transaksi: " . $jumtrans;
			?>
			
			<br>
			<br>
		<p class="left"><b><?php echo $nama; ?></b></p>
		<p class="left"><b><?php echo $jumtrans; ?></b></p>
		<p class="left"><b>Divisi : <?php echo $divisi; ?></b></p>
		<p class="right"><i>[<?php echo $waktu_skg." - ".$jam; ?>]</i></p>
		
		
		<table border="1" style="width: 100%" align='left'>
			<tr align='center'>
				<th width="5%">No</th>
				<th>Tanggal - Jam</th>
				<!--<th hidden>Kode Pengeluaran</th>-->
				<th>Kategori</th>
				<th>Keterangan</th>
				<th>Permintaan</th>
				<th>Diinput Oleh</th>
				<th>Nominal</th>
			</tr>
			<?php 
				$no = 1;		
				$total_keluar=0;
				  while($data = mysqli_fetch_array($data_barang)){					
				$waktuu = $data['WAKTU'];
				$kodpenn = $data['KODE_PENGELUARAN'];
				$katee = $data['KATEGORI'];
				$ketee = $data['NOTES'];
				$oleh = $data['OLEH'];
				$permin = $data['PERMINTAAN'];
				$nomii = $data['NOMINAL'];
				$total_keluar=$total_keluar+$nomii;   								
				$nomii = "Rp" . number_format($nomii,0,',','.');      				
				?>
			<tr>
				<td align='center'><?php echo $no++; ?></td>
				<td align='center'><?php echo $waktuu; ?></td>
				<!--<td hidden align='center'><?php echo $kodpenn; ?></td>-->
				<td align='left'><?php echo $katee; ?></td>
				<td align='left'><?php echo $ketee; ?></td>
				<td align='left'><?php echo $permin; ?></td>
				<td align='left'><?php echo $oleh; ?></td>
				<td align='right'><?php echo $nomii; }?></td>
			</tr>
			<tr>
				<?php
					$total_keluar = "Rp" . number_format($total_keluar,0,',','.');      
					?>
				<td colspan="6" align="right"><b>Total</td>
				<td align='right'> <?php echo $total_keluar; ?></td>
			</tr>
		</table>
		<script>
			window.print();
		</script>
	</body>
</html>