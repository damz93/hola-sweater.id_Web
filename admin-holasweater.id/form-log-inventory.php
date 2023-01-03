<!DOCTYPE html>
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <title>Data Log Inventory - S W E A T E R I N . M E</title>
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
				else if ($_SESSION['level']!="OWNER" AND $_SESSION['level']!="SPV GUDANG" AND $_SESSION['level']!="GUDANG"){
					echo "<script>alert('Anda tidak memiliki akses.....');window.location.href='javascript:history.go(-1)';</script>";
				}
		?>
      <h1 align='center' style="background-color:#71b8e4;color:#FFFFFe">DATA LOG INVENTORY</h1>
      <h3 align='center' style="background-color:#1d7bb6;color:#FFFFee">- S W E A T E R I N . M E -</h3>
      <br>
      <a style="background-color:#1d7bb6;color:#FFFFFe" href="utama"> KE MENU UTAMA </a></br>
      <a style="background-color:#1d7bb6;color:#FFFFFe" href="form-pilih-inventory"> PILIH INVENTORY</a></br>
      <a style="background-color:#71b8e4;color:#FFFFFe" href="input-log-inventory"> INPUT LOG INVENTORY(BARANG MASUK/KELUAR) </a><br>
      <br>		
      <table id="tabel1" class="table table-striped" border="1" cellpadding="0" cellspacing="1">
         <thead align="center">
            <tr align='center' class="table-info">
               <th>NO.</th>			 
               <th>KODE INVETORY</th>
               <th>TGL INPUT</th>		  
               <th>KETERANGAN</th>	
               <th>NAMA BARANG</th>	    
               <th>QTY</th>
               <th>DARI/UNTUK</th>	  
               <th>OLEH</th>		   
               <th>AKSI</th>
            </tr>
         </thead>
         <?php 
            include 'koneksi.php';
            $no=1;
            $data = mysqli_query($koneksi,"select * from t_log_inventory order by ID DESC");
            while($d = mysqli_fetch_array($data)){
				$tglAA = $d['TGL'];
				$tgl = $d['WAKTU'];
				$kodlog = $d['KODE_LOG'];
				$tgl = substr($tgl,0,10);
				$kodbar = $d['KODE_BARANG'];
				$sumber = $d['SUMBER'];
				$nambar = $d['NAMA_BARANG'];
				$spesif = $d['SPESIFIKASI'];				
				$info = $d['INFO'];				
				$qty = $d['QTY'];
				$oleh = $d['OLEH'];
				$qtytamp = number_format($qty,0,",",".");
				$satuan = $d['SATUAN'];
				$semua_barang = "[".$kodbar."]".$nambar."-".$spesif."(".$satuan.")";
            	?>
         <tr align="center">
            <td><?php echo $no++; ?></td>
            <td><?php echo $kodlog; ?></td>
            <td><?php echo $tgl; ?></td>
            <td><?php echo $info; ?></td>   
            <td align="left"><?php echo $semua_barang; ?></td>      
            <td align="right"><?php echo $qtytamp; ?></td>      
			<td align="left"><?php echo $sumber; ?></td>              
            <td align="left"><?php echo $oleh; ?></td>     
            <td>			
               <!--<a href='edit-log-inventory.php?kode_inventory=<?php echo $kodlog; ?>' title="Edit Log Inventory">
               <img src="img/edit.png" class="img-responsive" height="100%"></a>	| -->
               <a href='hapus-log-inventory?kode_inventory=<?php echo $kodlog; ?>' title="Delete Inventory" onclick="return confirm('Are you sure you want to delete?')"><img src="img/delete.png" height="100%" ></a>
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
                     "lengthMenu": "Menampilkan _MENU_ Data Log Inventory",
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