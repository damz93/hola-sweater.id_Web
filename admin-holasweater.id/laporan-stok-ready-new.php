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
			<style>
			p.ex1 {			  
			  padding-right: 120px;
			  text-align: right;
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
			<h2 class="center">DATA BARANG READY</h2>
		</u>
		<h3 class="center">HOLASWEATER.ID</h3>
		<?php 
			include 'koneksi.php';
			date_default_timezone_set('Asia/Hong_Kong');
			$waktu_skg = date("d-M-Y");
			$tot_kes = 0;
			$jam=date("H:i:s a");
			if (isset($_POST['cetak_barang_ready'])){
				$nama = "Stok Barang Ready";
				$data_barang3= mysqli_query($koneksi,"SELECT DISTINCT JENIS_BARANG from t_stok WHERE NOTES='GUDANG' order BY JENIS_BARANG ASC");
				//$data_barang3= mysqli_query($koneksi,"SELECT * FROM t_stok WHERE QTY>0 ORDER BY QTY DESC");
				$cek_status = 'READY';
				$jumbar = mysqli_num_rows($data_barang3);
			} 			
			
			$jumbar = $jumbar." Barang yang berbeda";
		?>     
	<!--	<p class="left"><b><?php echo $nama; ?></b></p>
		<p class="left"><b><?php echo $jumbar; ?></b></p>-->
		<br>
		<p class="ex1"><i>[<?php echo $waktu_skg." - ".$jam; ?>]</i></p>
		<br>
		
			<?php 
				while($data = mysqli_fetch_array($data_barang3)){			
					$jenis = $data['JENIS_BARANG'];
			?>
			
		<table border="0" style="background-color:skyblue;width:75%" align='center'>
			<tr align='left'>
				<th><h5>Jenis Barang : <?php echo $jenis; ?></h5></th>
			</tr>
		</table>
		<?php
			$data_barang_= mysqli_query($koneksi,"SELECT * from t_stok WHERE JENIS_BARANG='$jenis' AND QTY>0 GROUP BY KODE_BARANG ORDER BY KODE_BARANG ASC");
		?>
		<table border="1" style="width:75%" align='center'>
			<tr align='center'>
				<th width="5%">No</th>
				<th>Kode Barang</th>
				<th>Warna</th>
				<th>Size</th>
				<th>QTY</th>
			</tr>
			<?php 
				$no = 1;			
				$jumqty = 0;
				
				  while($datax = mysqli_fetch_array($data_barang_)){			
					$kode = $datax['KODE_BARANG'];
					$warn = $datax['WARNA']; 
					$sizze = $datax['SIZE_']; 
					$qty = $datax['QTY'];  
					$qty_tamp = number_format($qty,0,',','.');        
					$jumqty = $jumqty + $qty;				
					$tot_kes = $tot_kes + $qty;
			?>
			<tr>
				<td align='center'><?php echo $no++; ?></td>
				<td align='left'><?php echo $kode; ?></td>
				<td align='left'> <?php echo $warn; ?></td>
				<td align='left'> <?php echo $sizze; ?></td>
				  <td align='right'> <?php echo $qty_tamp;  }?></td>
			</tr>
			<?php
				$jumqty = number_format($jumqty,0,',','.');      	
				$tot_kes_tamp = number_format($tot_kes,0,',','.');      			
				?>
			<tr>
				<td colspan="4" align="center"><b>Jumlah</b></td>
				<td align='right'> <?php echo $jumqty;  ?></td>
			</tr>
		</table>
		<table border="0" style="width:75%" align='center'>		
			<tr>
				<td><br><br><br>
				</td>
			</tr>
		</table>
		
			<?php 	
			}
			
			
		?>
		<table hidden border="0" style="width:75%" align='center'>		
			<tr>
				<td>
					<h1><?php echo $tot_kes_tamp; ?></h1>
				</td>
			</tr>
		</table>

		<script>
			window.print();
		</script>
	</body>
</html>