<!DOCTYPE html>
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <title>Data Pemasukan - S W E A T E R I N . M E</title>
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
					echo "<script>alert('Anda belum login.....');window.location.href='index?pesan=belum_login';</script>";
				}
				else if ($_SESSION['level']!="OWNER" AND $_SESSION['level']!="SPV ADMIN" AND $_SESSION['level']!="ADMIN" AND $_SESSION['level']!="SPV GUDANG" AND $_SESSION['level']!="GUDANG" AND $_SESSION['level']!="BENDAHARA"){
					echo "<script>alert('Anda tidak memiliki akses.....');window.location.href='javascript:history.go(-1)';</script>";
				}
		?>
      <h1 align='center' style="background-color:#71b8e4;color:#FFFFFe">DATA PEMASUKAN</h1>
      <h3 align='center' style="background-color:#1d7bb6;color:#FFFFee">- S W E A T E R I N . M E -</h3>
      <br>
      <a style="background-color:#1d7bb6;color:#FFFFFe" href="utama"> KE MENU UTAMA </a></br>
      <a style="background-color:#71b8e4;color:#FFFFFe" href="input-pemasukan"> INPUT DATA PEMASUKAN </a><br>
      <br>		
      <table id="tabel1" class="table table-striped" border="1" cellpadding="0" cellspacing="1">
         <thead align="center">
            <tr align='center' class="table-info">
				<th>NO.</th>			 
				<th>KODE PEMASUKAN</th>			 
				<th>TANGGAL</th>			   
				<th>JENIS PEMASUKAN</th>
				<th>PCS</th>
				<th>COSTUM</th>
				<th>KETERANGAN</th>
				<th>AKSI</th>
            </tr>
         </thead>
         <?php 
            include 'koneksi.php';
            $no=1;
			 function formatTanggal($date){
                    // ubah string menjadi format tanggal
                    return date('d-M-Y', strtotime($date));
                    }	
            $data = mysqli_query($koneksi,"select * from t_pemasukan2 order by ID DESC");
            while($d = mysqli_fetch_array($data)){
				//$tgl = $d['WAKTU'];
				//$tgl = formatTanggal($d['TGL']);  
				$date_ = date_create($d['TGL']);
				$tgl2 = date_format($date_,'d-m-Y');  
				//$tgl2 = date_format($d['TGL'],'d-M-Y');  
				//date_format($date,"d/m/Y");
                $hari = date('l', strtotime($d['TGL']));
                $semua = $hari.", ".$tgl;
				$tgl_tamp = substr($tgl,0,10);
				$kod_inp = $d['KODE_TRANSAKSI'];				
				$jenis = $d['JENIS'];
				$dari = $d['DARI'];
				$tott = $d['TOTAL'];		            
            	$tott_tamp = "Rp".number_format($tott,0,",",".");				
				$paymn = $d['PAYMENT'];
				$noref = $d['NOREF'];
				$notes= $d['NOTES'];				
				$cost = $d['COSTUM'];
				$costtamp = number_format($cost,0,",",".");
				$qty = $d['QTY'];
				$qtytamp = number_format($qty,0,",",".");
				$keter = $d['NOTES'];			
				
            	?>
         <tr align="center">
            <td><?php echo $no++; ?></td>
            <td><?php echo $kod_inp; ?></td>
            <td><?php echo $tgl2; ?></td>
            <td><?php echo $jenis; ?></td>
            <td align='right'><?php echo $qtytamp; ?></td>
            <td align='right'><?php echo $costtamp; ?></td>  
            <td align='left'><?php echo $keter; ?></td>  
            <td>			
            <a href='detail-pemasukan?kode_input=<?php echo $kod_inp; ?>' title="Lihat Pemasukan"><img src="img/show.png" class="img-responsive" height="100%"></a>|
			<a hidden target="_BLANK" href='cetak-pemasukan?kode_transaksi=<?php echo $kod_inp; ?>' title="Cetak Nota Pemasukan" onclick="return confirm('Are you sure you want to reprint?')"><img src="img/print.png" height="100%" ></a>
			<a href='hapus-pemasukan?kode_input=<?php echo $kod_inp; ?>' title="Delete Pemasukan" onclick="return confirm('Are you sure you want to delete?')"><img src="img/delete.png" height="100%" ></a>
            </td>
         </tr>
         <?php 
            }
            ?>
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
                     "lengthMenu": "Menampilkan _MENU_ Data Pemasukan",
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