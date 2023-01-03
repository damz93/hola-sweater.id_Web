<!DOCTYPE html>
<html moznomarginboxes mozdisallowselectionprint>
	<head>
		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<title>Cetak Nota Transaksi - S W E A T E R I N . M E</title>
			<link rel="shortcut icon" href="img/tokonline.png">
			<meta http-equiv="refresh" content="5; url=form-transaksi.php">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="stylesheet" href="css/freelancer.min.css">
			<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.min.js
				"></script>
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
			$no = 1;
			session_start();
			$olehhh = $_SESSION['username'];
			   $total_bangetz = 0;
			$kode_transaksi   = $_GET['kode_transaksi'];
			$waktu_skg = date("d/m/Y");
						$jam = date("H:i:s");
						
			$penjualan  = mysqli_query($koneksi, "select * from t_transaksi where KODE_TRANSAKSI='$kode_transaksi'");
						
			?>
		<font size="11" face="Arial" >
			<table border="0" style="width:100%" align='left'>
				<tr align='center'>
					<th colspan='3'>
						<img src="img\header_nota.png" width='100%'>
					</th>
				</tr>
				
				<tr>
					<td colspan='3'><br></td>
				</tr>
				<tr align='left'>
					<td align="left" style="font-size: 36px;">			
						<?php echo $kode_transaksi; ?>
					</td>
					<td colspan=2 align="right" style="font-size: 33px;">			
						<?php echo $waktu_skg."-".$jam." - ".$olehhh; ?>
					</td>
				</tr>
				<?php
					$jumbay=0;
					$no=1;
					$totpcs=0;
					         while($data = mysqli_fetch_array($penjualan)){
						//$jumbayz = $data['BAYAR'];	
						$satuan = $data['HARGA'];	
							$satuan2 = $satuan;
							$jumbay = $data['BAYAR'];	
							$jumbay = str_replace(".","",$jumbay); 
							$jumbaytamp = "Rp" . number_format($jumbay,0,',','.');
							$tambahan = $data['HARGA_TAMBAHAN'];	
							$total_tambahanzz = (int)$tambahan * (int)$data['QTY'];
							$total_tambahan = $total_tambahan + $total_tambahanzz;
							$total_tambahantamp = "Rp" . number_format($total_tambahanzz,0,',','.');
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
							$potongan = $data['POTONGAN'];	
							$total_diskon = $total_diskon + $potongan;
							$potongantamp = "Rp" . number_format($potongan,0,',','.');
							$total_setelah_disk = $total_blum_disk - $diskon2;				
							$total_harga_barang = $total_harga_barang + $total_blum_disk;
							$total_setelah_disktamp = "Rp" . number_format($total_setelah_disk,0,',','.');	
					          
					          ?>
				<tr>
					<td colspan='3'><br></td>
				</tr>
				<tr align="left" colspan="3">
					<!--	<td><?php echo "(".$no.")".$data['KODE_BARANG']."-".$data['JENIS_BARANG']."-".$data['WARNA']."(".$data['SIZE_'].")"; ?></td>-->
					<td align='left'><?php echo $data['JENIS_BARANG']; ?></td>
					<td width="15%"  rowspan="2" align='center'><?php echo $data['QTY']." pcx"; ?></td>
					<td rowspan="2" align='right'><?php echo $total_blum_disktamp; ?></td>
				</tr>
				<tr>
					<!--<td hidden align='left'><?php echo $satuan; ?></td>-->
					<td><?php echo $data['WARNA']; ?></td>
				</tr>
				<tr hidden>
					<td hidden align='left'>Tambh</td>
					<td hidden align='right'><?php echo $tambahantamp ?></td>
					<td hidden align='right'><?php echo $total_tambahantamp; ?></td>
				</tr>
				<tr hidden>
					<td hidden align='left'>Disc</td>
					<td hidden align='right' colspan="2"><?php echo $potongantamp; ?></td>
				</tr>
				<tr hidden>
					<td align='left'>Total</td>
					<td align='right' colspan="2"><?php echo $total_setelah_disktamp; ?></td>
				</tr>
				<?php
					$waktu_skg2 = date("d/m/Y h:i:s");
					         $tgl_hari_ini = date("Y/m/d");
					         $jam_hari_ini = date("h:i:s");
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
						$ongkir = $data['ONGKIR'];
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
					$no++;
					}
								
								 
								 
								// $penjualan2 = mysqli_query($koneksi, "select KODE_COSTUM from t_transaksi where KODE_TRANSAKSI='$kode_transaksi'");
								 $penjualan2 = mysqli_query($koneksi,"SELECT `COSTUM`,`KODE_COSTUM`,SUM(HARGA_TAMBAHAN) AS HARGA,COUNT(`KODE_COSTUM`)AS JUMLAH,QTY FROM t_transaksi WHERE KODE_TRANSAKSI='$kode_transaksi' AND HARGA_TAMBAHAN<>0 GROUP BY `KODE_COSTUM`");
								 while($data2= mysqli_fetch_array($penjualan2)){
									$jumlah_tamp = number_format($data2['JUMLAH'],0,',','.');
									$qtyyy_tamp = number_format($data2['QTY'],0,',','.');
									$harga_tamp = "Rp" . number_format($data2['HARGA'],0,',','.');
									$jumlah_cos = $data2['HARGA'];
									
								 
					         ?>
				<tr>
					<td colspan='3'><br></td>
				</tr>
				<tr>
					<td align='left'><?php echo $data2['COSTUM']; ?></td>
					<td align='center' rowspan="2"><?php echo $qtyyy_tamp." pcx"; ?></td>
					<td align='right' rowspan="2"><?php echo $harga_tamp; ?></td>
				</tr>
				<tr>
					<td align='left'><?php echo $data2['KODE_COSTUM']; }?></td>
				</tr>
				<tr align="center">
					<td colspan='3'>-----------------------------------------------------</td>
				</tr>
				<tr hidden>
					<td colspan='2' align='right'>Jumlah Barang</td>
					<td align='right'><?php echo $totpcs; ?></td>
				</tr>
				<?php
				//	$totalnyami = $totalnyami + $ongkir;
				
								 
								 
								 
						         $total_tambahantamp = "Rp" . number_format($total_tambahan,0,',','.');
						      $total_diskontamp = "Rp" . number_format($total_diskon,0,',','.');
						$total_harga_barang = $total_harga_barang + $jumlah_cos;
						$total_harga_barangtamp = "Rp" . number_format($total_harga_barang,0,',','.');
						
						$totalnyami = $total_harga_barang -$total_diskon;
						         $total_bangetz = "Rp" . number_format($total_bangetz,0,',','.');
						         $totalnyamitamp = "Rp" . number_format($totalnyami,0,',','.');
								 $total_kembali = $jumbay - $totalnyami;
						         $total_kembalitamp = "Rp" . number_format($total_kembali,0,',','.');
						        // $total_diskontamp = "Rp" . number_format($total_diskon,0,',','.');
						       //  $total_bayar = "Rp" . number_format($jumbay,0,',','.');
						         $ongkirr = "Rp" . number_format($ongkir,0,',','.');
					?>
				<tr>
					<td colspan='2' align='right'>Jumlah</td>
					<td align='right'><?php echo $total_harga_barangtamp; ?></td>
				</tr>
				<tr hidden>
					<td colspan='2' align='right'>Total Biaya Tambahan</td>
					<td align='right'><?php echo $total_tambahantamp; ?></td>
				</tr>
				<tr hidden>
					<td colspan='2' align='right' colspan="2">Ongkos Kirim</td>
					<td align='right'><?php echo $ongkirr; ?></td>
				</tr>
				<tr>
					<td colspan='2' align='right'>Diskon</td>
					<td align='right'><?php echo $total_diskontamp;; ?></td>
				</tr>
				<tr>
					<td colspan='2' align='right'>Total Bayar</td>
					<td align='right'><?php echo $totalnyamitamp; ?></td>
				</tr>
				<tr>
					<td colspan='2' align='right'>Pembayaran diterima</td>
					<td align='right'><?php echo $jumbaytamp; ?></td>
				</tr>
				<tr>
					<td colspan='2' align='right'>Kembali</td>
					<td align='right'><?php echo $total_kembalitamp; ?></td>
				</tr>
				<tr>
					<td colspan='3'><br></td>
				</tr>
				<tr align='center'>
					<th colspan='3'>
						<img src="img\footer_nota.png" width='100%'>
					</th>
				</tr>
			</table>
		</font>
		<script>
			window.print();
		</script>
	</body>
</html>