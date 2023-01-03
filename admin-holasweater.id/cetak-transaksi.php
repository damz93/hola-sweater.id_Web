<!DOCTYPE html>
<html moznomarginboxes mozdisallowselectionprint>
	<head>
		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<title>Cetak Nota Transaksi - S W E A T E R I N . M E</title>
			<link rel="shortcut icon" href="img/tokonline.png">
			<meta http-equiv="refresh" content="5; url=input-transaksi.php">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="stylesheet" href="css/freelancer.min.css">
			<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
			<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
			<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
			<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>			
			<script data-ad-client="ca-pub-5256228815542923" async src"https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
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
			//$jumbay = $_POST['jumlah_pembayaran'];	
			$totpcs=0;
			$ongkir = $_POST['ongkir'];		
			//			$sumberx = $_POST['sumberx'];			
			$diskonnew = $_POST['nomdiskon'];
			$kode_penjualan = $_POST['kode_transaksi'];	
			$ongkir= str_replace(".","",$ongkir); 
			//		$jumbay = str_replace(".","",$jumbay); 
			//$jumbayZZ = str_replace(".","",$jumbay); 
			date_default_timezone_set('Asia/Hong_Kong');
			$waktu_skg = date("d/m/Y");
			$jam = date("H:i:s");
			
			$data_pengeluaran = mysqli_query($koneksi,"select max(ID) as ID from t_transaksi");
				 while($d = mysqli_fetch_array($data_pengeluaran)){
					$jumtranskX        = $d['ID'];					
				 }
			      
			      if ($jumtranskX == 0) {
			      	$kode_penjualan = "TRX-0000001";
			      }
			      else{
			      	$jumtranskX++;
			if (strlen($jumtranskX)== 1){
			      		$kode_penjualan = "TRX-000000".$jumtranskX;
			      	}
			      	else if (strlen($jumtranskX)== 2){
			      		$kode_penjualan = "TRX-00000".$jumtranskX;
			      	}
			      	else if (strlen($jumtranskX)== 3){
			      		$kode_penjualan = "TRX-0000".$jumtranskX;
			      	}
			      	else if (strlen($jumtranskX)== 4){
			      		$kode_penjualan = "TRX-000".$jumtranskX;
			      	}
			      	else if (strlen($jumtranskX)== 5){
			      		$kode_penjualan = "TRX-00".$jumtranskX;
			      	}
			      	else if (strlen($jumtranskX)== 6){
			      		$kode_penjualan = "TRX-0".$jumtranskX;
			      	}
			      	else if (strlen($jumtranskX)== 7){
			      		$kode_penjualan = "TRX-".$jumtranskX;
			      	}
			      	else if (strlen($jumtranskX)== 8){
			      		$kode_penjualan = "TRX-".$jumtranskX;
			      	}
			      }
			
			
			
			?>
		<table border="0" style="width:28%" align='left'>
			<tr align="left">
				<td colspan="3">
					<p style="font-size: 10px;">
						<?php echo $waktu_skg."-".$jam; ?>
					</p>
				</td>
			</tr>
			<tr align='center'>
				<th colspan="3">S W E A T E R I N . M E</th>
			</tr>
			<tr align='center'>
				<th colspan="3">Jl </th>
			</tr>
			<tr>
				<td align="center" colspan="3">
					<p style="font-size: 12px;">							
						IG:@ - WA:+
					</p>
				</td>
			</tr>
			<tr align="center">
				<td colspan="3">----------------------------------------</td>
			</tr>
			<tr align='left'>
				<th colspan="3">
					<i><u><?php echo $kode_penjualan ?><br></u></i>
				</th>
			</tr>
			<?php 
				$no = 1;
				session_start();
				$olehyy = $_SESSION['username'];
				$total_bangetz = 0;
				$totalnyami = 0;
				$total_diskon = 0;
				date_default_timezone_set('Asia/Hong_Kong');
				
				$sql = mysqli_query($koneksi,"select * from t_transaksi_temp WHERE OLEH='".$olehyy."'");
				while($data = mysqli_fetch_array($sql)){
					$satuan = $data['HARGA'];	
					$satuan2 = $satuan;
					$total = $data['TOTAL'];			
					$satuan = "Rp" . number_format($satuan,0,',','.');
					$total = "Rp" . number_format($total,0,',','.');
					$total_banget = $data['TOTAL'];						
					$total_blum_disk = $satuan2 * $data['QTY'];
					$total_blum_disktamp = "Rp" . number_format($total_blum_disk,0,',','.');
					$potonggg = $diskonnew;
					$potongan2 = "Rp" . number_format($diskonnew,0,',','.');			
					$diskon = $data['DISKON'];	
					$diskon2 = $data['DISKON2'];	
					$total_diskon = $total_diskon+$diskon2;
					$total_setelah_disk = $total_blum_disk - $diskon2;				
					$total_setelah_disktamp = "Rp" . number_format($total_setelah_disk,0,',','.');	
				?>
			<tr align="left" colspan="3">
				<td><?php echo $data['KODE_BARANG']."-".$data['JENIS_BARANG']."-".$data['WARNA']."-".$data['SIZE_']; ?></td>
			</tr>
			<tr>
				<td align='left'><?php echo $satuan; ?></td>
				<td align='center'>x<?php echo $data['QTY']; ?></td>
				<td align='right'><?php echo $total_blum_disktamp; ?></td>
			</tr>
			<tr>
				<td align='left'>Disc</td>
				<td align='right'><?php echo $diskon ?></td>
				<td align='right'><?php echo $diskon2; ?></td>
			</tr>
			<tr>
				<td align='left'>Total</td>
				<td align='right' colspan="2"><?php echo $total_setelah_disktamp; ?></td>
			</tr>
			<?php 	
				date_default_timezone_set('Asia/Hong_Kong');				
				$total_bangetz = $total_blum_disk + $total_bangetz;
				$totalnyami = $totalnyami + $total_setelah_disk;
				$kode_penjualan2 = $kode_penjualan;					
				$tgl = $data['TGL'];
				$waktu = $data['WAKTU'];
				$oleh = $data['OLEH'];
				$keterangan = $data['KETERANGAN'];
				$kode_barang = $data['KODE_BARANG'];
				$jenis_barang = $data['JENIS_BARANG'];
				$sizee = $data['SIZE_'];
				$warna = $data['WARNA'];
				$diskon = $data['DISKON'];
				$diskon2 = $data['DISKON2'];
				$kodis = $data['KODE_DISKON'];
				$warna = $data['WARNA'];
				$kuantitas = $data['QTY'];
				//$sumber = $sumberx;
				$harga = $data['HARGA'];
				//	$diskon = $potonggg;
				///		$potongan = $data['POTONGAN'];
				$total = $data['TOTAL'];
				$totpcs = $totpcs + $kuantitas;
				         	// query SQL untuk insert data			
				$query="INSERT INTO t_transaksi(KODE_DISKON,DISKON,DISKON2,TOTAL2,KODE_TRANSAKSI,KODE_BARANG,JENIS_BARANG,SIZE_,WARNA,HARGA,QTY,ONGKIR,TOTAL,TGL,WAKTU,OLEH,KETERANGAN)VALUES('$kodis','$diskon','$diskon2','$total_setelah_disk','$kode_penjualan2','$kode_barang','$jenis_barang','$sizee','$warna','$harga','$kuantitas','$ongkir','$total','$tgl','$waktu','$oleh','$keterangan')";
				if (mysqli_query($koneksi, $query)) {
				
				}
				         $sql2 = "DELETE FROM t_transaksi_temp where OLEH='".$oleh."'";            
				         if (mysqli_query($koneksi, $sql2)) {
				         //	echo "Record deleted successfully";
							}
				         }
				         $totalnyami = $totalnyami + $ongkir;
				         $total_bangetz = "Rp" . number_format($total_bangetz,0,',','.');
				         $totalnyamitamp = "Rp" . number_format($totalnyami,0,',','.');
				    //     $total_kembali = "Rp" . number_format($total_kembali,0,',','.');
				         $total_diskontamp = "Rp" . number_format($total_diskon,0,',','.');
				       //  $total_bayar = "Rp" . number_format($jumbay,0,',','.');
				         $ongkirr = "Rp" . number_format($ongkir,0,',','.');
				         ?>
			<tr align="center">
				<td colspan='3'>----------------------------------------</td>
			</tr>
			<tr>
				<td colspan='2' align='left' colspan="2">Jumlah Barang</td>
				<td align='right'><?php echo $totpcs; ?></td>
			</tr>
			<tr>
				<td colspan='2' align='left' colspan="2">Total Barang</td>
				<td align='right'><?php echo $total_bangetz; ?></td>
			</tr>
			<tr>
				<td colspan='2' align='left' colspan="2">Ongkos Kirim</td>
				<td align='right'><?php echo $ongkirr; ?></td>
			</tr>
			<tr>
				<td colspan='2' align='left' colspan="2">Diskon</td>
				<td align='right'><?php echo $total_diskontamp;; ?></td>
			</tr>
			<tr>
				<td colspan='2' align='left' colspan="2">Total</td>
				<td align='right'><?php echo $totalnyamitamp; ?></td>
			</tr>
			<tr hidden>
				<td colspan='2' align='left' colspan="2">Bayar</td>
				<td align='right'><?php //echo $total_bayar; ?></td>
			</tr>
			<tr hidden>
				<td colspan='2' align='left' colspan="2">Kembali</td>
				<td align='right'><?php //echo $total_kembali; ?></td>
			</tr>
			<tr align="center">
				<td colspan="3"><br>- Terima Kasih -</td>
			</tr>
		</table>
		<script>
			window.print();
		</script>
	</body>
</html>