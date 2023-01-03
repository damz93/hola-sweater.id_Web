<!DOCTYPE html>
<html moznomarginboxes mozdisallowselectionprint>
		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<title>Laporan Stok Barang - HOLASWEATER.ID</title>
			<!--<meta http-equiv="refresh" content="5; url=form-laporan">-->
			<link rel="shortcut icon" href="img/hola_ic.png">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="stylesheet" href="css/freelancer.min.css">
			<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
			<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
			<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
			<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
			<link rel="shortcut icon" href="img/esana.jpg">
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
	<body>	
      <?php 
				error_reporting(0);
				session_start();					
				if($_SESSION['status']!="login"){
					echo "<script>alert('Anda belum login.....');window.location.href='index?pesan=belum_login';</script>";                    
				}
				else if ($_SESSION['level']!="OWNER" AND $_SESSION['level']!="SPV ADMIN" AND $_SESSION['level']!="ADMIN" AND $_SESSION['level']!="SPV GUDANG" AND $_SESSION['level']!="GUDANG" AND $_SESSION['level']!="BENDAHARA"){
					echo "<script>alert('Anda tidak memiliki akses.....');window.location.href='javascript:history.go(-1)';</script>";
				}
		?>
		<u>
			<h1 class="center">LAPORAN STOK</h1>
		</u>
		<h3 class="center">HOLASWEATER.ID</h3>
		<?php 
			include 'koneksi.php';
			date_default_timezone_set('Asia/Hong_Kong');
			$waktu_skg = date("d-M-Y");
			$cek_status = '';
			$jam=date("H:i:s a");
			if (isset($_POST['cetak_barang_keluar'])){
				$cek_status = 'KELUAR';
				$tgl_1 = $_POST['cek_tanggal_keluar1'];				
				$tgl_11 = date_create($tgl_1);
				$tgl_1d = date_format($tgl_11,"d-m-Y");
				
				$tgl_2 = $_POST['cek_tanggal_keluar2'];
				$tgl_22 = date_create($tgl_2);
				$tgl_2d = date_format($tgl_22,"d-m-Y");
				
				$tujuan = $_POST['tujuan_keluar'];
				$nama = "Barang Keluar - ".$tgl_1d." s.d ".$tgl_2d."(".$tujuan.")";
				if ($tujuan != 'SEMUA'){
					$data_barang1 = mysqli_query($koneksi,"SELECT KODE_TRANSAKSI,PELANGGAN,OLEH2,SUM(QTY) as JUMQTY,OLEH,TGL from t_stok_keluar WHERE PELANGGAN='$tujuan' AND (TGL BETWEEN '$tgl_1' AND '$tgl_2') GROUP BY KODE_TRANSAKSI ORDER BY TGL ASC");
				}
				else{
					$data_barang1 = mysqli_query($koneksi,"SELECT KODE_TRANSAKSI,PELANGGAN,OLEH2,SUM(QTY) as JUMQTY,OLEH,TGL from t_stok_keluar WHERE TGL BETWEEN '$tgl_1' AND '$tgl_2' GROUP BY KODE_TRANSAKSI ORDER BY TGL ASC");
				}				
				$jumbar = mysqli_num_rows($data_barang1);
			}
			else if (isset($_POST['cetak_barang_ready'])){
				$nama = "Stok Barang Ready";
				$data_barang3= mysqli_query($koneksi,"SELECT * FROM t_stok WHERE QTY>0 ORDER BY QTY DESC");
				$cek_status = 'READY';
				$jumbar = mysqli_num_rows($data_barang3);
			} 
			else if (isset($_POST['cetak_barang_masuk'])){	
				$cek_status = 'MASUK';
				$tgl_1 = $_POST['cek_tanggal_masuk1'];				
				$tgl_11 = date_create($tgl_1);
				$tgl_1d = date_format($tgl_11,"d-m-Y");
				
				$tgl_2 = $_POST['cek_tanggal_masuk2'];
				$tgl_22 = date_create($tgl_2);
				$tgl_2d = date_format($tgl_22,"d-m-Y");
				
				$tujuan = $_POST['tujuan_masuk'];
				$nama = "Barang Masuk - ".$tgl_1d." s.d ".$tgl_2d."(".$tujuan.")";	
				if ($tujuan != 'SEMUA'){				
					$data_barang2 = mysqli_query($koneksi,"SELECT KODE_TRANSAKSI,KATEGORI,TERIMA_DARI,SUM(QTY) as JUMQTY,OLEH,TGL from t_stok_masuk WHERE KATEGORI='$tujuan' AND (TGL BETWEEN '$tgl_1' AND '$tgl_2.') GROUP BY KODE_TRANSAKSI ORDER BY TGL ASC");			
				}
				else{
					$data_barang2 = mysqli_query($koneksi,"SELECT KODE_TRANSAKSI,KATEGORI,TERIMA_DARI,SUM(QTY) as JUMQTY,OLEH,TGL from t_stok_masuk WHERE TGL BETWEEN '$tgl_1' AND '$tgl_2' GROUP BY KODE_TRANSAKSI ORDER BY TGL ASC");
				}
				$jumbar = mysqli_num_rows($data_barang2);
			}
			
			$jumbar = $jumbar." Barang yang berbeda";
		?>     
		<p class="left"><b><?php echo $nama; ?></b></p>
		<p class="left"><b><?php echo $jumbar; ?></b></p>
		<p class="right"><i>[<?php echo $waktu_skg." - ".$jam; ?>]</i></p>
		<?php
			if ($cek_status == 'READY'){
		?>
		<table border="1" style="width: 100%" align='center'>
			<tr align='center'>
				<th width="5%">No</th>
				<th>Kode Barang</th>
				<th>Jenis Barang</th>
				<th>Warna</th>
				<th>Size</th>
				<th>QTY</th>
			</tr>
			<?php 
				$no = 1;			
				$jumqty = 0;
				
				  while($data = mysqli_fetch_array($data_barang3)){			
					$kode = $data['KODE_BARANG'];
					$jenis_b = $data['JENIS_BARANG'];
					$warn = $data['WARNA']; 
					$sizze = $data['SIZE_']; 
					$qty = $data['QTY'];  
					$qty_tamp = number_format($qty,0,',','.');        
					$jumqty = $jumqty + $qty;				
			?>
			<tr>
				<td align='center'><?php echo $no++; ?></td>
				<td align='center'><?php echo $kode; ?></td>
				<td align='left'><?php echo $jenis_b; ?></td>
				<td align='left'> <?php echo $warn; ?></td>
				<td align='left'> <?php echo $sizze; ?></td>
				<td align='right'> <?php echo $qty_tamp; } ?></td>
			</tr>
			<?php
				$jumqty = number_format($jumqty,0,',','.');      				
				?>
			<tr>
				<td colspan="5" align="right"><b>Jumlah QTY</b></td>
				<td align='right'> <?php echo $jumqty;  ?></td>
			</tr>
		</table>
			<?php }
			else if ($cek_status == 'KELUAR'){
		?>
		<table border="1" style="width: 100%" align='center'>
			<tr align='center'>
				<th width="5%">No</th>
				<th>TGL</th>
				<th>Kode Transaksi</th>
				<th>Kategori</th>
				<th>Via</th>
				<th>Jumlah Barang</th>
				<th>Penginput</th>
			</tr>
			<?php 
				$no = 1;			
				$jumqty = 0;
				
				  while($data = mysqli_fetch_array($data_barang1)){					
					$tgl_1 = date_create($data['TGL']);
					$tgl_1dx = date_format($tgl_1,"d-m-Y");
					$kode = $data['KODE_TRANSAKSI'];
					$kateg = $data['PELANGGAN'];
					$via = $data['OLEH2']; 
					$oleh = $data['OLEH']; 
					$qty = $data['JUMQTY'];  
					$qty_tamp = number_format($qty,0,',','.');        
					$jumqty = $jumqty + $qty;				
			?>
			<tr>
				<td align='center'><?php echo $no++; ?></td>
				<td align='center'><?php echo $tgl_1dx; ?></td>
				<td align='center'><?php echo $kode; ?></td>
				<td align='center'><?php echo $kateg; ?></td>
				<td align='center'> <?php echo $via; ?></td>
				<td align='center'> <?php echo $qty_tamp; ?></td>
				<td align='center'> <?php echo $oleh; } ?></td>
			</tr>
			<?php
				$jumqty = number_format($jumqty,0,',','.');      				
				?>
			<tr>
				<td colspan="6" align="right"><b>Jumlah QTY</b></td>
				<td align='left'> <?php echo $jumqty;  ?></td>
			</tr>
		</table>
		<?php }
			else if ($cek_status == 'MASUK'){
		?>
		<table border="1" style="width: 100%" align='center'>
			<tr align='center'>
				<th width="5%">No</th>
				<th>TGL</th>
				<th>Kode Transaksi</th>
				<th>Kategori</th>
				<th>Terima Dari</th>
				<th>Jumlah Barang</th>
				<th>Penginput</th>
			</tr>
			<?php 
				$no = 1;			
				$jumqty = 0;
				
				  while($data = mysqli_fetch_array($data_barang2)){					
					$tgl_1 = date_create($data['TGL']);
					$tgl_1dx = date_format($tgl_1,"d-m-Y");
					$kode = $data['KODE_TRANSAKSI'];
					$kateg = $data['KATEGORI'];
					$via = $data['TERIMA_DARI']; 
					$oleh = $data['OLEH']; 
					$qty = $data['JUMQTY'];  
					$qty_tamp = number_format($qty,0,',','.');        
					$jumqty = $jumqty + $qty;				
			?>
			<tr>
				<td align='center'><?php echo $no++; ?></td>
				<td align='center'><?php echo $tgl_1dx; ?></td>
				<td align='center'><?php echo $kode; ?></td>
				<td align='center'><?php echo $kateg; ?></td>
				<td align='center'> <?php echo $via; ?></td>
				<td align='center'> <?php echo $qty_tamp; ?></td>
				<td align='center'> <?php echo $oleh; } ?></td>
			</tr>
			<?php
				$jumqty = number_format($jumqty,0,',','.');      				
				?>
			<tr>
				<td colspan="6" align="right"><b>Jumlah QTY</b></td>
				<td align='left'> <?php echo $jumqty;  ?></td>
			</tr>
		</table>
			<?php }
			?>
			
		<script>
			window.print();
		</script>
	</body>
</html>