<!DOCTYPE html>
<html moznomarginboxes mozdisallowselectionprint>
	<head>
		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<title>Laporan Summary - HOLASWEATER.ID</title>
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
			<style type="text/css" media="print">
				@media print {
				tr.vendorListHeading {
				background-color: #1a4567 !important;
				-webkit-print-color-adjust: exact; 
				}
				}
				@media print {
				.vendorListHeading th {
				color: white !important;
				}
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
			<h1 class="center">LAPORAN SUMMARY</h1>
		</u>
		<h3 class="center">HOLASWEATER.ID</h3>
		<?php
			include 'koneksi.php';
			date_default_timezone_set('Asia/Hong_Kong');
			$waktu_skg = date("d-M-Y");
			$jam=date("H:i:s a");
			function formatTanggal($date){
			 // ubah string menjadi format tanggal
			 return date('d-m-Y', strtotime($date));
			}
			if (isset($_POST['cetak_summary']))
			{				
				$tglnya = $_POST['cek_tanggal_summary1'];
				$tgl_nya = date_create($tglnya);
				$tgl_awalz = date_format($tgl_nya,"Y/m/d");
				$tamp_tgl_awal = date_format($tgl_nya,"d-m-Y");
				
				$tglakhir = $_POST['cek_tanggal_summary2'];
				$tgl_akhir = date_create($tglakhir);
				$tgl_akhirz = date_format($tgl_akhir,"Y/m/d");
				$tamp_tgl_akhir = date_format($tgl_akhir,"d-m-Y");

				if((strcmp($tglnya,$tglakhir)==0) OR empty($tglakhir)){
					$nama = "Laporan Summary - " . $tamp_tgl_awal;
					$data_barang = mysqli_query($koneksi, "SELECT * from t_pemasukan2 WHERE TGL='".$tgl_awalz."' ORDER BY TGL ASC");	
					$data_barang2 = mysqli_query($koneksi, "SELECT TGL,SUM(NOMINAL) AS NOMI,PAYMENT, KODE_PENGELUARAN,KATEGORI,DIVISI,PERMINTAAN FROM `t_pengeluaran` WHERE TGL)='".$tgl_awalz."' group BY KODE_PENGELUARAN ORDER BY KODE_PENGELUARAN ASC");	
					$data_barang3 = mysqli_query($koneksi, "SELECT * from t_transaksi WHERE TGL='".$tgl_awalz."' AND ONGKIR>0 GROUP BY KODE_TRANSAKSI ORDER BY TGL ASC");	
				}
				else{
					$nama = "Laporan Summary (" . $tamp_tgl_awal." s.d. ". $tamp_tgl_akhir.")";
					$data_barang = mysqli_query($koneksi, "SELECT * from t_pemasukan2 WHERE TGL between '".$tgl_awalz."' AND '".$tgl_akhirz."' ORDER BY TGL ASC");
					$data_barang2 = mysqli_query($koneksi, "SELECT TGL,SUM(NOMINAL) AS NOMI,PAYMENT, KODE_PENGELUARAN,KATEGORI,DIVISI,PERMINTAAN FROM `t_pengeluaran` WHERE TGL between '".$tgl_awalz."' AND '".$tgl_akhirz."' group BY KODE_PENGELUARAN ORDER BY KODE_PENGELUARAN ASC");
					$data_barang3 = mysqli_query($koneksi, "SELECT * from t_transaksi WHERE TGL between '".$tgl_awalz."' AND '".$tgl_akhirz."' AND ONGKIR>0 GROUP BY KODE_TRANSAKSI ORDER BY TGL ASC");
				}		
			}
			$j1 = mysqli_num_rows($data_barang);
			$j2 = mysqli_num_rows($data_barang2);
			$j3 = mysqli_num_rows($data_barang3);
			$jumtrans = $j1+$j2+$j3;
			$jumtrans = "Jumlah Transaksi: " . $jumtrans;
			?>
			<br>
			<br>
		<p class="left"><b><?php echo $nama; ?></b></p>
		<p class="right"><b><?php echo $jumtrans; ?></b></p>
		<p class="right"><i>[<?php echo $waktu_skg." - ".$jam; ?>]</i></p>
		<table border="2" style="width: 100%">
			<tr align="left">
				<td colspan="6">
					<i>
						<h5>#Transaksi Pemasukan</h5>
					</i>
				</td>
			</tr>
			<tr align='center'>
				<th width="3%">No</th>
				<th>Tanggal Transaksi</th>
				<th>Kode Transaksi</th>
				<th>Jenis</th>
				<th>Dari</th>
				<!--<th>Payment</th>-->
				<th>Total Pemasukan</th>
			</tr>
			<?php 
				$no = 1;		
				$total_jual=0;
				  while($data = mysqli_fetch_array($data_barang)){					
				$tgl_trans = $data['TGL'];
				$kodtrans = $data['KODE_TRANSAKSI'];
				$total = $data['TOTAL'];
				$total_tamp = "Rp" . number_format($total,0,',','.');    
				$payment = $data['PAYMENT'];
				//$jenis = $data['JENIS'].' - '.$data['DARI'];
				$jenis = $data['JENIS'];
				$dari =$data['DARI'];
				$total_jual=$total+$total_jual;		
				$total_jua_tamp = "Rp" . number_format($total_jua,0,',','.');      				
				?>
			<tr>
				<td align='center'><?php echo $no++; ?></td>
				<td align='center'><?php echo formatTanggal($tgl_trans); ?></td>
				<td align='center'><?php echo $kodtrans; ?></td>
				<td align='left'><?php echo $jenis; ?></td>
				<td align='left'><?php echo $dari; ?></td>
				<!--<td align='left'><?php echo $payment; ?></td>-->
				<td align='right'> <?php echo $total_tamp; }?></td>
			</tr>
			<tr>
				<?php
				//	$total_jualan = $total_jual;
					$total_jual_tamp = "Rp" . number_format($total_jual,0,',','.');    
					?>
				<td colspan="5" align="right">
					Jumlah Transaksi Pemasukan
				</td>
				<td align='right'>
					<?php echo $no-1; ?>
				</td>
			</tr>
			<tr>
				<td colspan="5" align="right">
					Total Pemasukan
				</td>
				<td align='right'>
					<b><?php echo $total_jual_tamp  ?></b>
				</td>
			</tr>
			<tr hidden align="left">
				<td colspan="4">
					<i>
						<h5>#Transaksi Pemasukan 2 (Ongkos Kirim)</h5>
					</i>
				</td>
			</tr>
			<tr hidden align='center'>
				<th width="3%">No</th>
				<th>Tanggal Transaksi</th>
				<th>Kode Penjualan</th>
				<th>Keterangan</th>
				<th>Nominal</th>
			</tr>
			<?php 
				$no = 1;		
				$total_ongkir=0;
				  while($data = mysqli_fetch_array($data_barang3)){					
				$tgl_trans = $data['TGL'];
				$kodtrans = $data['KODE_TRANSAKSI'];
				$total_ongk = $data['ONGKIR'];
				$total_ongkir=$total_ongkir+$total_ongk;		
				$cetak_ong = "Rp" . number_format($total_ongk,0,',','.');      				
				?>
			<tr hidden>
				<td align='center'><?php echo $no++; ?></td>
				<td align='center'><?php echo formatTanggal($tgl_trans); ?></td>
				<td align='center'><?php echo $kodtrans; ?></td>
				<td align='center'>Ongkos Kirim</td>
				<td align='right'> <?php echo $cetak_ong; }?></td>
			</tr>
			<tr hidden>
				<?php
					$total_ongkiran = $total_ongkir;
					$cetak_ongkir = "Rp" . number_format($total_ongkir,0,',','.');    
					?>
				<td colspan="4" align="right">
					Jumlah Transaksi Ongkos Kirim
				</td>
				<td align='right'>
					<b> <?php echo $no-1; ?></b>
				</td>
			</tr>
			<tr hidden>
				<td colspan="4" align="right">
					Total Ongkos Kirim
				</td>
				<td align='right'>
					<b> <?php echo $cetak_ongkir  ?></b>
				</td>
			</tr>
			<tr hidden>
				<?php
					$semua_masuk = $total_ongkiran + $total_jualan;
					$cetak_seluruh = "Rp" . number_format($semua_masuk,0,',','.');   
					?>
			<tr hidden>
				<td colspan="4" align="right">
					Total Pemasukan
				</td>
				<td align='right'>
					<b> <?php echo $cetak_seluruh;  ?></b>
				</td>
			</tr>
			<tr align="left">
				<td colspan="6">
					<i>
						<h5>#Transaksi Pengeluaran</h5>
					</i>
				</td>
			</tr>
			<tr align='center'>
				<th width="3%">No</th>
				<th>Tanggal Transaksi</th>
				<th>Kode Transaksi</th>
				<th colspan='2'>Keperluan - Permintaan</th>
				<th colspan='1'>Total Tagihan</th>
			</tr>
			<?php 
				$total_kel=0;
				$no = 1;
				           while($data2 = mysqli_fetch_array($data_barang2)){					
					$tgl_trans2 = $data2['TGL'];
					$kodpeng = $data2['KODE_PENGELUARAN'];
					$keterangan = $data2['KATEGORI'].' - '.$data2['PERMINTAAN'];
					$nominal = $data2['NOMI'];
					$total_kel=$total_kel+$nominal;
					$tamp_nominal = "Rp" . number_format($nominal,0,',','.');      				
				         ?>
			<tr>
				<td align='center'><?php echo $no++; ?></td>
				<td align='center'><?php echo formatTanggal($tgl_trans2); ?></td>
				<td align='center'><?php echo $kodpeng; ?></td>
				<td align='left' colspan='2'><?php echo $keterangan; ?></td>
				<td align='right' colspan='1'> <?php echo $tamp_nominal; }?></td>
			</tr>
			<?php
				$total_sum = $total_jual-$total_kel;		  
				$total_kel_tamp = "Rp" . number_format($total_kel,0,',','.');      
				$total_sum_tamp = "Rp" . number_format($total_sum,0,',','.');      
				?>
			<tr>
				<td colspan="5" align="right">
					Jumlah Transaksi Pengeluaran
				</td>
				<td colspan='1' align='right'>
					<b><?php echo $no-1; ?>
				</td>
			</tr>
			<tr>
				<td colspan="5" align="right">
					Total Pengeluaran
				</td>
				<td colspan='1'  align='right'>
					<b> <?php echo $total_kel_tamp  ?>
				</td>
			</tr>
			<tr hidden>
				<td colspan="6" align="right"><?php
					echo "<<< ";
					for($a=1 ;$a<=40;$a++){
						echo " - ";										
					}			
					//echo " >>>";
					?>
				</td>
			</tr>
			<tr>
				<td colspan="5" align="right">
					Total Summary
				</td>
				<td colspan='2'  align='right'>
					<h2><b> <?php echo $total_sum_tamp  ?></b></h2>
				</td>
			</tr>
		</table>
		<script>
			window.print();
			    
		</script>
	</body>
</html>