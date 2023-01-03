<!DOCTYPE html>
<html moznomarginboxes mozdisallowselectionprint>
	<head>
		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<title>Cetak Nota Reseller - S W E A T E R I N . M E</title>
			<link rel="shortcut icon" href="img/tokonline.png">
			<!--	<meta http-equiv="refresh" content="5; url=form-reseller">-->
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
			<style>
				.rotate {
				transform: rotate(-90deg);
				/* Legacy vendor prefixes that you probably don't need... */
				/* Safari */
				-webkit-transform: rotate(-90deg);
				/* Firefox */
				-moz-transform: rotate(-90deg);
				/* IE */
				-ms-transform: rotate(-90deg);
				/* Opera */
				-o-transform: rotate(-90deg);
				/* Internet Explorer */
				filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);
				}
				table{
				width:100%;
				height:100%;
				}
			</style>
	</head>
	</head>
	<body>
		<?php 
			error_reporting(0);
			session_start();					
			if($_SESSION['status']!="login"){
				echo "<script>alert('Anda belum login.....');window.location.href='index?pesan=belum_login';</script>";                    
			}
			 else if ($_SESSION['level']!="OWNER" AND $_SESSION['level']!="SPV ADMIN" AND $_SESSION['level']!="ADMIN"){
				echo "<script>alert('Anda tidak memiliki akses.....');window.location.href='javascript:history.go(-1)';</script>";
			}
			?>
		<?php
			include 'koneksi.php';
			date_default_timezone_set('Asia/Hong_Kong');
			$waktu_skg = date("d/m/Y");
			$jam = date("H:i:s");
			$kode_tr = $_GET['kode_transaksi'];
			function formatTanggal($date){
			 // ubah string menjadi format tanggal
			 return date('d-m-Y', strtotime($date));
			}
			?>
		<font size="3" face="Calibri" >
		<!--<div style="border-bottom:3px dashed #000000;">-->
			<table border="0" align='center' width="100%">
				<tr width="38%" align="center">
					<th width="100%">
						<table border="0" align='center'>
							<tr>
								<td colspan="4"><br><br>
								</td>
							</tr>
							<tr>
								<td width="10%"></td>
								<?php 
									$total=0;
									$no=1;
									$data_reseller = mysqli_query($koneksi,"SELECT * from t_reseller WHERE KODE_TRANSAKSI='$kode_tr'");
									$data2 = mysqli_fetch_array($data_reseller);
									$tgl = formatTanggal($data2['TGL']);
									?>
								<td colspan="2" width="50%">
									<h4>SWEATERIN.ME</h4>
									<h6>Ruko Toddopuli Nomor 10 Blok B2</h6>
									<h6>Kec. Manggala, Makassar</h6>
									<h6>WA : 081371029661 - IG : @sweaterin.me</h6>
								</td>
								<td align="right" valign="top">
									<h4>INVOICE</h4>									
								</td>
							</tr>
							<tr>
								<td width="10%"></td>
								<td colspan="2" width="50%">
									<br><br>
									<h6>Tanggal : <?php echo $tgl; ?></h6>
								</td>
								<td align="left">								
									<h6>Nomor Invoice: <?php echo $data2['KODE_TRANSAKSI']; ?></h6>
									<h6>Costumer: <?php echo $data2['COSTUMER']; ?></h6>
									<h6>Alamat: <?php echo $data2['ALAMAT']; ?></h6>
									<h6>Telp/ Whatsapp: <?php echo $data2['WA']; ?></h6>
								</td>
								<td width="10%"></td>
							</tr>
							<tr>
								<td width="10%"></td>
								<td colspan="3" align="left">
									<table style="width:100%" border="1" align='left'>
										<tr>
											<td align="center">No					
											</td>
											<td align="center">Jenis Barang
											</td>
											<td align="center">Deskripsi
											</td>
											<td align="center">Harga Satuan
											</td>
											<td align="center">Qty
											</td>
											<td align="center">Jumlah
											</td>
										</tr>
										<?php
											$qty2 = 0;
											$data_reseller2 = mysqli_query($koneksi,"SELECT * from t_reseller WHERE KODE_TRANSAKSI='$kode_tr'");
											while($data = mysqli_fetch_array($data_reseller2)){			
											$jenbar = $data['JENIS_BARANG'];
											$nominal = $data['TOTAL'];
											$ongkir = $data['ONGKIR'];
											$qty = $data['BANYAKNYA'];
											$qty2 = $qty2 + $qty;
											$total = $total+$nominal;
											$total_ong = $total+$ongkir;
											$totaltamp= "Rp".number_format($total,0,',','.');
											$desk = $data['DESKRIPSI'];
											$per_itemtamp= "Rp".number_format($data['PER_ITEM'],0,',','.');
											$ongkirtamp= "Rp".number_format($data['ONGKIR'],0,',','.');
											$bnyaktamp = number_format($data['BANYAKNYA'],0,',','.');
											$nomintamp = "Rp".number_format($data['TOTAL'],0,',','.');							
											$total_ongtamp = "Rp".number_format($total_ong,0,',','.');							
											
											?>
										<tr>
											<td align="center">
												<h6><?php echo $no++; ?></h6>
											</td>
											<td align="left">
												<h6><?php echo $jenbar; ?></h6>
											</td>
											<td align="left">
												<h6><?php echo $desk; ?></h6>
											</td>
											<td align="right">
												<h6><?php echo $per_itemtamp; ?></h6>
											</td>
											<td align="right">
												<h6><?php echo $bnyaktamp; ?></h6>
											</td>
											<td align="right">
											<h6><?php echo $nomintamp; }
											
											$qtytamp = number_format($qty2,0,',','.');
											
											?></h6>
											</td>
										</tr>										
										<tr>
											<td colspan="4" align="right">
												<h6>Total</h6>
											</td>
											<td align="right">
												<h6><?php echo $qtytamp; ?></h6>
											</td>
											<td align="right">
												<h6><?php echo $totaltamp; ?></h6>
											</td>
										</tr>								
										<tr>
											<td colspan="4" align="right">
												<h6>Ongkos Kirim</h6>
											</td>
											<td colspan="2" align="right">
												<h6><?php echo $ongkirtamp; ?></h6>
											</td>
										</tr>						
										<tr>
											<td colspan="4" align="right">
												<h6>Total Pembayaran</h6>
											</td>
											<td colspan="2" align="right">
												<h6><?php echo $total_ongtamp; ?></h6>
											</td>
										</tr>
									</table>
								</td>								
								<td width="10%">
								</td>
							</tr>
							<tr>
								<td width="5%"></td>
								<td colspan="3" align="left">
									<table style="width:100%" border="0" align='left'>
										<tr>
											<td colspan="3">
												<br>
												<br>
												<br>
												<h6>Transfer Via</h6>
												<h6>BCA 7892067727</h6>
												<h6>A/N  Rizka Ardianti</h6>												
												<br>
												<br>
											</td>
										</tr>
										<tr hidden>
											<td width="20%"></td>
											<td width="30%" align="center">
												<h6>Mengetahui</h6><br><br><br><br>
												<h6>----------------</h6>
											</td>
											<td width="30%" align="center">
												<h6>Disetujui Oleh,</h6><br><br><br><br>
												<h6>----------------</h6>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</th>		
				</tr>
			</table>
		</font>
		<script>
			window.print();
		</script>
	</body>
</html>