<!DOCTYPE html>
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	   <?php
         include 'koneksi.php';
         $no             = 1;
         $kode_transaksi = $_GET['kode_transaksi'];
         ?>
      <title>Data Detail Transaksi - S W E A T E R I N . M E</title>
      <link rel="shortcut icon" href="img/tokonline.png">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="css/freelancer.min.css">
      <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.min.js
         "></script>
      <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
      <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
      <script data-ad-client="ca-pub-5256228815542923" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>	  
	   <style>
        body, html {
        height: 100%;
        margin: 0;
        }
        .bg {
        /* The image used */
        background-image: url("img/bg_.png");
        /* Full height */
        height: 100%; 
        /* Center and scale the image nicely */
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        }
    </style>
   </head>
   <body>
   <div class="bg">
      <?php 
	    error_reporting(0);
         session_start();
         if($_SESSION['status']!="login"){
         	echo "<script>alert('Anda Harus Login untuk mengakses halaman ini');window.location.href='esana-admin/index.php?pesan=belum_login';</script>";
         	//header("location:index.php?pesan=belum_login");
         }
         ?>
      <h1 align='center' style="background-color:#71b8e4;color:#FFFFFe">DATA DETAIL TRANSAKSI </h1>
      <h3 align='center' style="background-color:#1d7bb6;color:#FFFFee">- S W E A T E R I N . M E -</h3>
      <br>
      <a style="background-color:#1d7bb6;color:#FFFFFe" href="utama.php"> KE MENU UTAMA </a></br>
      <a style="background-color:#71b8e4;color:#FFFFFe" href="form-transaksi.php"> KEMBALI KE FORM TRANSAKSI </a><br><br>
	  <b style="background-color:#71b8e4;color:#FFFFFe">KODE TRANSAKSI : <?php echo $kode_transaksi; ?></b>
      <br>		
      <table id="tabel1" class="table table-striped" border="1" cellpadding="0" cellspacing="1">
         <thead align="center">
            <tr align='center' class="table-info">
               <th>NO.</th>			   
               <th>WAKTU</th>           		   
               <th>KODE BARANG</th>               
               <th>JENIS BARANG</th>	
               <th>SIZE</th>
               <th>WARNA</th>
               <th>HARGA SATUAN</th>
               <th>QTY</th>
			   <th>JUMLAH</th>  		
               <th>KODE DISKON</th>
               <th>NOMINAL PER ITEM</th>
               <th>TOTAL DISKON</th>	   
               <th>TOTAL</th>	   
            </tr>
         </thead>
		 <?php
			function formatTanggal($date){
			// ubah string menjadi format tanggal
				return date('d-M-Y', strtotime($date));
			}
         $juml_keseluruhan = 0;
         $kuantitas = 0;
		 $totharg = 0;
		 $totharg2 = 0;
		 $diskonn = 0;
		 $ongkirr = 0;
         $order = mysqli_query($koneksi, "select * from t_transaksi where KODE_TRANSAKSI='$kode_transaksi' ORDER BY QTY ASC");
         while ($d = mysqli_fetch_array($order)) {
			$kodr = $d['KODE_TRANSAKSI'];
			$tgl = formatTanggal($d['TGL']);
			$hari = date('l', strtotime($d['TGL']));
			$semua = $hari.", ".$tgl;			
			$kod_bar = $d['KODE_BARANG'];
			$kod_diskon = $d['KODE_DISKON'];
			$diskon = $d['DISKON'];
			$diskon = number_format($diskon, 0, ",", ".");	
			$diskon2 = $d['DISKON2'];
			$diskon2tamp = number_format($diskon2, 0, ",", ".");	
			$jenbar = $d['JENIS_BARANG'];
			$size = $d['SIZE_'];
			$ongk = $d['ONGKIR'];
			$ongkirr = $ongk;
			$warna = $d['WARNA'];		
			$harga = $d['HARGA'];			
			$harga2 = number_format($harga, 0, ",", ".");			
			$qty = $d['QTY'];
			$qty2 = number_format($qty, 0, ",", ".");
			$kuantitas = $kuantitas + $qty;
			$juml = $d['TOTAL'];
			$totalfix = $d['TOTAL2'];
			$totharg = $totharg + $juml;
			$totharg2 = $totharg2 + $totalfix;
			$diskonn = $diskonn + $diskon2;
			$juml2 = number_format($juml, 0, ",", ".");										
			$totalfixtamp = "Rp".number_format($totalfix, 0, ",", ".");								
         ?>
         <tr align="center">
            <td><?php echo $no++; ?></td>
            <td><?php echo $semua; ?></td>
            <td><?php echo $kod_bar; ?></td>			
            <td><?php echo $jenbar; ?></td>   
            <td><?php echo $size; ?></td>   
            <td><?php echo $warna; ?></td>   
            <td align="right"><?php echo "Rp".$harga2; ?></td>   
            <td><?php echo $qty2; ?></td>   
            <td align="right"><?php echo "Rp".$juml2; ?></td>   	
            <td><?php echo $kod_diskon; ?></td>   	
            <td align="right"><?php echo $diskon; ?></td>   	
            <td align="right"><?php echo $diskon2tamp; ?></td>   	
            <td align="right"><?php echo $totalfixtamp; ?></td>   
         </tr>
         <?php 
            }
			$noo = $no - 1;
			$totharg2 = $totharg + $ongkirr - $diskonn;			
			$totharg = number_format($totharg, 0, ",", ".");				
			$totharg2tamp = number_format($totharg2, 0, ",", ".");	
			$kuantitas = number_format($kuantitas, 0, ",", ".");	
			$ongkirr = number_format($ongkirr, 0, ",", ".");	
			$diskonntamp = number_format($diskonn, 0, ",", ".");	
            ?>
		
		<tr>
			<td align="right" colspan="12"><b>Jumlah Barang yang berbeda</b>
				</td>
			<td align="right">
				<?php echo $noo;?>
			</td>
		 </tr>
		 <tr>
			<td align="right" colspan="12"><b>Jumlah Qty</b>
				</td>
			<td align="right">
				<?php echo $kuantitas;?>
			</td>
		 </tr>
		 <tr>
			<td align="right" colspan="12"><b>Total Harga Barang</b>
				</td>
			<td>
				<?php echo "Rp".$totharg;?>
			</td>
		 </tr>
		 <tr>
			<td align="right" colspan="12"><b>Ongkos Kirim</b>
				</td>
			<td>
				<?php echo "Rp".$ongkirr;?>
			</td>
		 </tr>
		 <tr>
			<td align="right" colspan="12"><b>Total Diskon</b>
				</td>
			<td>
				<?php echo "Rp".$diskonntamp;?>
			</td>
		 </tr>
		<tr>
			<td align="right" colspan="12"><b>Total Harga</b>
				</td>
			<td align="left">
				<?php echo "Rp".$totharg2tamp;?>
			</td>
		 </tr>
      </table>
      <script type="text/javascript">
         $(document).ready(function() {
             //$("#tabel1").tablesorter();
             $("#tabel1").DataTable({
                 "paging": true,
                 "ordering": true,
                 "info": true,
                 // });
                 //$("#tabel1").DataTable({
                 "language": {
                     "decimal": "",
                     "emptyTable": "Tidak ada data yang tersedia di tabel",
                     "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ Inputan",
                     "infoEmpty": "Menampilkan 0 sampai 0 dari 0 Inputan",
                     "infoFiltered": "(difilter dari _MAX_ total Inputan)",
                     "infoPostFix": "",
                     "thousands": ".",
                     "lengthMenu": "Menampilkan _MENU_ Data Detail Order",
                     "loadingRecords": "memuat...",
                     "processing": "Sedang di proses...",
                     "search": "Pencarian:",
                     "zeroRecords": "Arsip tidak ditemukan",
                     "paginate": {
                         "first": "Pertama",
                         "last": "Terakhir",
                         "next": "Selanjutnya",
                         "previous": "Kembali"
                     },
                     "aria": {
                         "sortAscending": ": aktifkan urutan kolom ascending",
                         "sortDescending": ": aktifkan urutan kolom descending"
                     }
                 }
             });
         });
      </script>
	  </div>
   </body>
</html>