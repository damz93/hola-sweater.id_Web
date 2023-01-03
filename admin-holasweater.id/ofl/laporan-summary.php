<!DOCTYPE html>
<html moznomarginboxes mozdisallowselectionprint>
	<head>
		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<title>Laporan Summary - S W E A T E R I N . M E</title>
			<meta http-equiv="refresh" content="5; url=form-laporan">
			<link rel="shortcut icon" href="img/tokonline.png">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="stylesheet" href="css/freelancer.min.css">
			<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.min.js
				"></script>
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
		else if(($_SESSION['level']!="OWNER")AND($_SESSION['level']!="BENDAHARA")) {
			echo "<script>alert('Anda tidak memiliki akses.....');window.location.href='javascript:history.go(-1)';</script>";
		}
		else {
			
		}
      ?>
		<u>
			<h1 class="center">LAPORAN SUMMARY</h1>
		</u>
		<h3 class="center">S W E A T E R I N . M E</h3>
		<?php
			include 'koneksi.php';
			date_default_timezone_set('Asia/Hong_Kong');
			$waktu_skg = date("d/m/Y");
			$jam = date("H:i:s");
			function formatTanggal($date){
			 // ubah string menjadi format tanggal
			 return date('d-m-Y', strtotime($date));
			}
			/*	if (isset($_POST['tampil_tanggal']))
			{			
				$tglnya = $_POST['cek_tanggal'];
				$nama = "Laporan Summary Harian - " . formatTanggal($tglnya);
				$data_barang = mysqli_query($koneksi, "SELECT * from t_transaksi WHERE TGL='".$tglnya."' ORDER BY TGL ASC");
			//	$data_barang = mysqli_query($koneksi, "SELECT KODE_TRANSAKSI,KODE_BARANG,NAMA_BARANG,TGL,SUM(JUMLAH)JUMLAH, SUM(KUANTITAS)KUANTITAS,SUM(HARGA_SATUAN)HARGA_SATUAN from t_transaksi WHERE TGL='".$tglnya."' GROUP BY NAMA_BARANG,KODE_BARANG ORDER BY TGL ASC");
			}
			else*/ 
			if (isset($_POST['tampil_bulan3'])){		
			
				$bulawal = $_POST['cek_bulan3'];
				$bulanaw = substr($bulawal,0,2);
				$tahunaw = substr($bulawal,3,7);
				$tgl_awal = $tahunaw."-".$bulanaw."-01";
				
				$bulakhir = $_POST['cek_bulan3d'];
				$bulanak = substr($bulakhir,0,2);
				$tahunak = substr($bulakhir,3,7);
				$tgl_akhir = $tahunak."-".$bulanak."-31";	
			
				if((strcmp($bulawal,$bulakhir)==0) OR empty($bulakhir)){
					$nama = "Laporan Summary Bulanan - " . $bulawal;
					$data_barang = mysqli_query($koneksi, "SELECT * from t_transaksi WHERE MONTH(TGL)='".$bulanaw."' AND YEAR(TGL)='".$tahunaw."' ORDER BY KODE_TRANSAKSI ASC");
					$data_barang2 = mysqli_query($koneksi, "SELECT * from t_pengeluaran WHERE MONTH(TGL)='".$bulanaw."' AND YEAR(TGL)='".$tahunaw."' ORDER BY KODE_PENGELUARAN ASC");
					$data_barang3 = mysqli_query($koneksi, "SELECT * from t_transaksi WHERE MONTH(TGL)='".$bulanaw."' AND ONGKIR>0 AND YEAR(TGL)='".$tahunaw."' GROUP BY KODE_TRANSAKSI ORDER BY KODE_TRANSAKSI ASC");
				}
				else{
					$nama = "Laporan Summary(" . $bulawal." s.d. ". $bulakhir.")";
					$data_barang = mysqli_query($koneksi, "SELECT * from t_transaksi WHERE TGL between '".$tgl_awal."' AND '".$tgl_akhir."' ORDER BY KODE_TRANSAKSI ASC");
					$data_barang2 = mysqli_query($koneksi, "SELECT * from t_pengeluaran WHERE TGL between '".$tgl_awal."' AND '".$tgl_akhir."' ORDER BY KODE_PENGELUARAN ASC");
					$data_barang3 = mysqli_query($koneksi, "SELECT * from t_transaksi WHERE TGL between '".$tgl_awal."' AND '".$tgl_akhir."' AND ONGKIR>0 GROUP BY KODE_TRANSAKSI ORDER BY TGL ASC");
								
				}
			
				
			}
			else if (isset($_POST['tampil_tahun3']))
			{				
				$tahunnya = $_POST['cek_tahun3'];
				$tahunawal_nya = $tahunnya."-01-01";
				
				$tahunnya2 = $_POST['cek_tahun3d'];
				$tahunakhir_nya = $tahunnya2."-12-31";
				
				if((strcmp($tahunnya,$tahunnya2)==0) OR empty($tahunnya2)){
					$nama = "Laporan Summary Tahunan - " . $tahunnya;
					$data_barang = mysqli_query($koneksi, "SELECT * from t_transaksi WHERE YEAR(TGL)='".$tahunnya."' ORDER BY KODE_TRANSAKSI ASC");	
					$data_barang2 = mysqli_query($koneksi, "SELECT * from t_pengeluaran WHERE YEAR(TGL)='".$tahunnya."' ORDER BY KODE_PENGELUARAN ASC");	
					$data_barang3 = mysqli_query($koneksi, "SELECT * from t_transaksi WHERE YEAR(TGL)='".$tahunnya."' AND ONGKIR>0 GROUP BY KODE_TRANSAKSI ORDER BY TGL ASC");	
				}
				else{
					$nama = "Laporan Summary(" . $tahunnya." s.d. ". $tahunnya2.")";
					$data_barang = mysqli_query($koneksi, "SELECT * from t_transaksi WHERE TGL between '".$tahunnya."' AND '".$tahunakhir_nya."' ORDER BY KODE_TRANSAKSI ASC");
					$data_barang2 = mysqli_query($koneksi, "SELECT * from t_pengeluaran WHERE TGL between '".$tahunnya."' AND '".$tahunakhir_nya."' ORDER BY KODE_PENGELUARAN ASC");
					$data_barang3 = mysqli_query($koneksi, "SELECT * from t_transaksi WHERE TGL between '".$tahunnya."' AND '".$tahunakhir_nya."' AND ONGKIR>0 GROUP BY KODE_TRANSAKSI ORDER BY TGL ASC");
				}		
			}
			$j1 = mysqli_num_rows($data_barang);
			$j2 = mysqli_num_rows($data_barang2);
			$j3 = mysqli_num_rows($data_barang3);
			$jumtrans = $j1+$j2+$j3;
			$jumtrans = "Jumlah Transaksi: " . $jumtrans;
			?>
		<h5 class="right"><b><?php echo $nama; ?></b></h5>
		<h6 class="right"><b><?php echo $jumtrans; ?></b></h6>
		<h6 class="right"><i><?php echo "[".$waktu_skg."-".$jam."]"; ?></i></h6>
		<table border="2" style="width: 100%">
			<tr align="left">
				<td colspan="5">
					<i>
						<h5>#Transaksi Pemasukan (Penjualan)</h5>
					</i>
				</td>
			</tr>
			<tr align='center'>
				<th width="3%">No</th>
				<th>Tanggal Transaksi</th>
				<th>Kode Transaksi</th>
				<th>Keterangan</th>
				<th>Nominal</th>
			</tr>
			<?php 
				$no = 1;		
				$total_jual=0;
				  while($data = mysqli_fetch_array($data_barang)){					
				$tgl_trans = $data['TGL'];
				$kodtrans = $data['KODE_TRANSAKSI'];
				$nambar = $data['JENIS_BARANG'];
				$total_jua = $data['TOTAL2'];
				$total_jual=$total_jual+$total_jua;		
				$cetak_jua = "Rp" . number_format($total_jua,0,',','.');      				
				?>
			<tr>
				<td align='center'><?php echo $no++; ?></td>
				<td align='center'><?php echo formatTanggal($tgl_trans); ?></td>
				<td align='center'><?php echo $kodtrans; ?></td>
				<td align='left'>Penjualan - <?php echo $nambar; ?></td>
				<td align='right'> <?php echo $cetak_jua; }?></td>
			</tr>
			<tr>
				<?php
					$total_jualan = $total_jual;
					$cetak_jual = "Rp" . number_format($total_jualan,0,',','.');    
					?>
				<td colspan="4" align="right">
					Jumlah Transaksi Penjualan
				</td>
				<td align='right'>
					<?php echo $no-1; ?>
				</td>
			</tr>
			<tr>
				<td colspan="4" align="right">
					Total Penjualan
				</td>
				<td align='right'>
					<b><?php echo $cetak_jual  ?></b>
				</td>
			</tr>
			<tr hidden align="left">
				<td colspan="5">
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
			<tr>
				<?php
					$semua_masuk = $total_ongkiran + $total_jualan;
					$cetak_seluruh = "Rp" . number_format($semua_masuk,0,',','.');   
					?>
			<tr>
				<td colspan="4" align="right">
					Total Pemasukan
				</td>
				<td align='right'>
					<b> <?php echo $cetak_seluruh;  ?></b>
				</td>
			</tr>
			<tr align="left">
				<td colspan="5">
					<i>
						<h5>#Transaksi Pengeluaran</h5>
					</i>
				</td>
			</tr>
			<tr align='center'>
				<th width="3%">No</th>
				<th>Tanggal Transaksi</th>
				<th>Kode Transaksi</th>
				<th>Keterangan</th>
				<th>Nominal</th>
			</tr>
			<?php 
				$total_kel=0;
				$no = 1;
				           while($data2 = mysqli_fetch_array($data_barang2)){					
					$tgl_trans2 = $data2['TGL'];
					$kodpeng = $data2['KODE_PENGELUARAN'];
					$keterangan = $data2['NOTES'];
					$total_ke = $data2['NOMINAL'];
					$total_kel=$total_kel+$total_ke;
					$cetak_kel = "Rp" . number_format($total_ke,0,',','.');      				
				         ?>
			<tr>
				<td align='center'><?php echo $no++; ?></td>
				<td align='center'><?php echo formatTanggal($tgl_trans2); ?></td>
				<td align='center'><?php echo $kodpeng; ?></td>
				<td align='left'>Pengeluaran - <?php echo $keterangan; ?></td>
				<td align='right'> <?php echo $cetak_kel; }?></td>
			</tr>
			<?php
				$total_sum = $semua_masuk-$total_kel;		  
				$total_kel = "Rp" . number_format($total_kel,0,',','.');      
				$total_sum = "Rp" . number_format($total_sum,0,',','.');      
				?>
			<tr>
				<td colspan="4" align="right">
					Jumlah Transaksi Pengeluaran
				</td>
				<td align='right'>
					<b><?php echo $no-1; ?>
				</td>
			</tr>
			<tr>
				<td colspan="4" align="right">
					Total Pengeluaran
				</td>
				<td align='right'>
					<b> <?php echo $total_kel  ?>
				</td>
			</tr>
			<tr>
				<td colspan="5" align="right"><?php 
					echo "<<< ";
					for($a=1 ;$a<=40;$a++){
						echo " - ";										
					}			
					//echo " >>>";
					?>
				</td>
			</tr>
			<tr>
				<td colspan="4" align="right">
					Total Summary
				</td>
				<td align='right'>
					<b> <?php echo $total_sum  ?>
				</td>
			</tr>
		</table>
		<script>
			window.print();
			    
		</script>
	</body>
</html>