<!DOCTYPE html>
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	   <?php
         include 'koneksi.php';
         $no             = 1;
         $kode_transaksi = $_GET['kode_transaksi'];
         ?>
	  <title>Data Detail Stok Masuk - HOLASWEATER.ID</title>      
	  <link rel="shortcut icon" href="img/hola_ic.png">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="css/freelancer.min.css">
      <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
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
        background-image: url("img/bg_wood.png");
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
			echo "<script>alert('Anda belum login.....');window.location.href='index?pesan=belum_login';</script>";                    
		}
		else if ($_SESSION['level']!="OWNER" AND $_SESSION['level']!="SPV ADMIN" AND $_SESSION['level']!="ADMIN" AND $_SESSION['level']!="SPV GUDANG" AND $_SESSION['level']!="GUDANG" AND $_SESSION['level']!="BENDAHARA"){
			echo "<script>alert('Anda tidak memiliki akses.....');window.location.href='javascript:history.go(-1)';</script>";
		}
      ?>
      <h1 align='center' style="background-color:#73607c;color:#d5d5d5">DATA DETAIL STOK MASUK </h1>
      <h3 align='center' style="background-color:#9f87aa;color:#FFFFFF">- HOLASWEATER.ID -</h3>
      <br>
	  <b style="background-color:#fdc766;color:#585657">KODE TRANSAKSI : <?php echo $kode_transaksi; ?></b>
      <br>		
      <table id="tabel1" class="table table-hover" border="1" cellpadding="0" cellspacing="1">
	  
         <thead align="center">
            <tr style="background-color:#585657;color:#FFFFFF;" align='center'>
			
               <th>NO.</th>			   
               <th>WAKTU</th>       
               <th>OLEH</th>    		   
               <th>KODE BARANG</th>               
               <th>JENIS BARANG</th>
               <th>WARNA</th>	
               <th>SIZE</th>
               <th>QTY</th>
            </tr>
         </thead>
		 <?php
			function formatTanggal($date){
			// ubah string menjadi format tanggal
				return date('d-M-Y', strtotime($date));
			}
         $juml_keseluruhan = 0;
         $kuantitas = 0;
         $order = mysqli_query($koneksi, "select * from t_stok_masuk where KODE_TRANSAKSI='$kode_transaksi' ORDER BY JENIS_BARANG,WARNA ASC");
         while ($d = mysqli_fetch_array($order)) {
			$kodr = $d['KODE_TRANSAKSI'];
			$tgl = formatTanggal($d['TGL']);
			$hari = date('l', strtotime($d['TGL']));
			$semua = $hari.", ".$tgl;			
			$kod_bar = $d['KODE_BARANG'];
			$jenbar = $d['JENIS_BARANG'];
			$size = $d['SIZE_'];
			$warna = $d['WARNA'];
			$oleh = $d['OLEH'];
			$qty = $d['QTY'];
			$qty2 = number_format($qty, 0, ",", ".");
			$kuantitas = $kuantitas + $qty;
			
											
         ?>
         <tr align="center">
            <td><?php echo $no++; ?></td>
            <td><?php echo $semua; ?></td>
            <td><?php echo $oleh; ?></td>     
            <td><?php echo $kod_bar; ?></td>			
            <td><?php echo $jenbar; ?></td>   
            <td><?php echo $warna; ?></td>    
            <td><?php echo $size; ?></td>   
            <td align="right"><?php echo $qty2; ?></td>     
         </tr>
         <?php 
            }
			$kuantitas2 = number_format($kuantitas, 0, ",", ".");
			
			$noo = $no - 1;
			$noo = number_format($noo, 0, ",", ".");
            ?>
		<tr>
			<td align="right" colspan=7><b>Jumlah Barang berbeda</b>
				</td>
         <td align="right">
            <?php echo $noo;?>
         </td>
		 </tr>
		<tr>
			<td align="right" colspan=7><b>Jumlah QTY</b>
				</td>
			<td align="right">
            <?php echo $kuantitas2;?>
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