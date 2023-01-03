<!DOCTYPE html>
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	   <?php
         include 'koneksi.php';
         $no             = 1;
         $kode_transaksi = $_GET['kode_pengeluaran'];
         ?>
      <title>Data Detail Pengeluaran - S W E A T E R I N . M E</title>
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
      <h1 align='center' style="background-color:#71b8e4;color:#FFFFFe">DATA DETAIL PENGELUARAN </h1>
      <h3 align='center' style="background-color:#1d7bb6;color:#FFFFee">- S W E A T E R I N . M E -</h3>
      <br>
      <a style="background-color:#1d7bb6;color:#FFFFFe" href="utama.php"> KE MENU UTAMA </a></br>
      <a style="background-color:#71b8e4;color:#FFFFFe" href="form-pengeluaran"> KEMBALI KE FORM PENGELUARAN </a><br><br>
	  <b style="background-color:#71b8e4;color:#FFFFFe">KODE PENGELUARAN : <?php echo $kode_transaksi; ?></b>
      <br>		
      <table id="tabel1" class="table table-striped" border="1" cellpadding="0" cellspacing="1">
         <thead align="center">
            <tr align='center' class="table-info">
               <th>NO.</th>			   
               <th>WAKTU</th>           		         			   
               <th>DIVISI</th>
               <th>KEPERLUAN</th>	
               <th>DESKRIPSI</th>
               <th>BIAYA PER ITEM</th>
               <th>BANYAKNYA</th>
			   <th>TOTAL</th>  		
			   <th>PAYMENT</th>  		
               <th>NOMOR REKENING/ NAMA</th>               
               <th>PERMINTAAN OLEH</th>               
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
         $penge = mysqli_query($koneksi, "select * from t_pengeluaran where KODE_PENGELUARAN='".$kode_transaksi."' ORDER BY WAKTU ASC");
         while ($d = mysqli_fetch_array($penge)) {
			$kod_pen = $d['KODE_PENGELUARAN'];
			$keperl = $d['KATEGORI'];
			$divi = $d['DIVISI'];
			$ketern = $d['NOTES'];
			$banyk = $d['BANYAKNYA'];									
			$banyktamp = number_format($banyk, 0, ",", ".");	
			$per_item = $d['PER_ITEM'];						
			$per_itemtamp = number_format($per_item, 0, ",", ".");	
			$nomin = $d['NOMINAL'];									
			$totharg = $totharg + $nomin;
			$nomintamp = number_format($nomin, 0, ",", ".");	
			$paymn = $d['PAYMENT'];			
			$norek = $d['NOREK'];			
			$permintaan = $d['PERMINTAAN'];			
			$tgl = formatTanggal($d['TGL']);
			$hari = date('l', strtotime($d['TGL']));
			$semua = $hari.", ".$tgl;						
         ?>
         <tr align="center">
            <td><?php echo $no++; ?></td>
            <td><?php echo $semua; ?></td>
            <td><?php echo $divi; ?></td>			
            <td><?php echo $keperl; ?></td>   
            <td align="left"><?php echo $ketern; ?></td>   
            <td align="right"><?php echo "Rp".$per_itemtamp; ?></td>   
            <td align="right"><?php echo $banyktamp; ?></td>   	
            <td align="right"><?php echo "Rp".$nomintamp; ?></td>   	 	
            <td><?php echo $paymn; ?></td>   	
            <td><?php echo $norek; ?></td>   	
            <td><?php echo $permintaan; ?></td>   	
         </tr>
         <?php 
            }
			$noo = $no - 1;
			$tothargtamp = number_format($totharg, 0, ",", ".");			
            ?>
		
		<tr>
			<td align="right" colspan="10"><b>Jumlah Transaksi</b>
				</td>
			<td align="center">
				<?php echo $noo;?>
			</td>
		 </tr>		
		 <tr>
			<td align="right" colspan="10"><b>Total Pengeluaran</b>
				</td>
			<td align="right">
				<?php echo "Rp".$tothargtamp;?>
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