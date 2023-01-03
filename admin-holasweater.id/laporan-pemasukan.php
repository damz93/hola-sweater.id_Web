<!DOCTYPE html>
<html moznomarginboxes mozdisallowselectionprint>
   <head>
      <head>
         <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<title>Laporan Pemasukan - S W E A T E R I N . M E</title>
			<link rel="shortcut icon" href="img/tokonline.png">
         <!--<meta http-equiv="refresh" content="5; url=form-laporan">-->
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
   </head>
   </head>
   <body>   
      <?php 
				error_reporting(0);
				session_start();					
				if($_SESSION['status']!="login"){
					echo "<script>alert('Anda belum login.....');window.location.href='index?pesan=belum_login';</script>";                    
				}
				else if ($_SESSION['level']!="OWNER" AND $_SESSION['level']!="SPV ADMIN" AND $_SESSION['level']!="ADMIN" AND $_SESSION['level']!="BENDAHARA"){
					echo "<script>alert('Anda tidak memiliki akses.....');window.location.href='javascript:history.go(-1)';</script>";
				}
		?>
      <u>
         <h1 class="center">LAPORAN PEMASUKAN</h1>
      </u>
     <h3 class="center">S W E A T E R I N . M E</h3>
     <?php
		include 'koneksi.php';
		date_default_timezone_set('Asia/Hong_Kong');
	//	$waktu_skg = date("d-M-Y");
		//$waktu_skg = date("l jS \of F Y h:i:s A");
		$waktu_skg = date("j F Y");
		
	//	$waktu_skg = date_format($waktu_skg,'d-m-Y');  
		$jam = date("H:i:s");
		function formatTanggal($date){
		 // ubah string menjadi format tanggal
		 return date('d-m-Y', strtotime($date));
		}
		if (isset($_POST['tampil_semua22'])){			
			$nama = "Penjualan Pemasukan - Semua Transaksi";
			$data_barang = mysqli_query($koneksi,"SELECT JENIS, SUM(`QTY`) AS QTYX, SUM(`COSTUM`) AS COSTUMX, SUM(`TOTAL`) AS TOTALX FROM `t_pemasukan2` GROUP BY JENIS ORDER BY TOTAL DESC");
			$data_barang2 = mysqli_query($koneksi,"SELECT SUM(`QTY`) AS QTYZ, SUM(`COSTUM`) AS COSTUMZ, SUM(`TOTAL`) AS TOTALZ FROM `t_pemasukan2`");
		 }
		 
		else if (isset($_POST['tampil_tanggald22']))
		{			
			$tglnya = $_POST['cek_tanggald22'];
			$tgl_nya = date_create($tglnya);
			$tgl_awalz = date_format($tgl_nya,"Y/m/d");
			
			$tglakhir = $_POST['cek_tanggald22d'];
			$tgl_akhir = date_create($tglakhir);
			$tgl_akhirz = date_format($tgl_akhir,"Y/m/d");
			
			if((strcmp($tglnya,$tglakhir)==0) OR empty($tglakhir)){
				$nama = "Laporan Pemasukan Harian - " . formatTanggal($tglnya);
				$data_barang = mysqli_query($koneksi, "SELECT JENIS, SUM(`QTY`) AS QTYX, SUM(`COSTUM`) AS COSTUMX, SUM(`TOTAL`) AS TOTALX FROM `t_pemasukan2` WHERE TGL='".$tglnya."' GROUP BY JENIS ORDER BY TOTALX DESC");
				$data_barang2 = mysqli_query($koneksi, "SELECT SUM(`QTY`) AS QTYZ, SUM(`COSTUM`) AS COSTUMZ, SUM(`TOTAL`) AS TOTALZ FROM `t_pemasukan2` WHERE TGL='".$tglnya."'");							
			}
			else{
				$nama = "Laporan Pemasukan(" . formatTanggal($tglnya) ." s.d. ". formatTanggal($tglakhir).")";
				$data_barang = mysqli_query($koneksi, "SELECT JENIS, SUM(`QTY`) AS QTYX, SUM(`COSTUM`) AS COSTUMX, SUM(`TOTAL`) AS TOTALX FROM `t_pemasukan2` WHERE TGL BETWEEN '".$tgl_awalz."' AND '".$tgl_akhirz."' GROUP BY JENIS ORDER BY TOTALX DESC");
				$data_barang2 = mysqli_query($koneksi, "SELECT SUM(`QTY`) AS QTYZ, SUM(`COSTUM`) AS COSTUMZ, SUM(`TOTAL`) AS TOTALZ FROM `t_pemasukan2` WHERE TGL BETWEEN '".$tgl_awalz."' AND '".$tgl_akhirz."'");
			}
		}
		else if (isset($_POST['tampil_buland22']))
		{	
			$bulawal = $_POST['cek_buland22'];
			$bulanaw = substr($bulawal,0,2);
			$tahunaw = substr($bulawal,3,7);
			$tgl_awal = $tahunaw."-".$bulanaw."-01";
			
			$bulakhir = $_POST['cek_buland22d'];
			$bulanak = substr($bulakhir,0,2);
			$tahunak = substr($bulakhir,3,7);
			$tgl_akhir = $tahunak."-".$bulanak."-31";
			
			if((strcmp($bulawal,$bulakhir)==0) OR empty($bulakhir)){
				$nama = "Laporan Pemasukan Bulanan - " . $bulawal;
				$data_barang = mysqli_query($koneksi, "SELECT JENIS, SUM(`QTY`) AS QTYX, SUM(`COSTUM`) AS COSTUMX, SUM(`TOTAL`) AS TOTALX FROM `t_pemasukan2` WHERE MONTH(TGL)='".$bulanaw."' AND YEAR(TGL)='".$tahunaw."' GROUP BY JENIS ORDER BY TOTALX DESC");
				$data_barang2 = mysqli_query($koneksi, "SELECT SUM(`QTY`) AS QTYZ, SUM(`COSTUM`) AS COSTUMZ, SUM(`TOTAL`) AS TOTALZ FROM `t_pemasukan2` WHERE MONTH(TGL)='".$bulanaw."' AND YEAR(TGL)='".$tahunaw."'");	
			}
			else{
				$nama = "Laporan Pemasukan Bulanan(" . $bulawal." s.d. ". $bulakhir.")";
				$data_barang = mysqli_query($koneksi, "SELECT JENIS, SUM(`QTY`) AS QTYX, SUM(`COSTUM`) AS COSTUMX, SUM(`TOTAL`) AS TOTALX FROM `t_pemasukan2` WHERE TGL between '".$tgl_awal."' AND '".$tgl_akhir."' GROUP BY JENIS ORDER BY TOTALX DESC");
				$data_barang2 = mysqli_query($koneksi, "SELECT SUM(`QTY`) AS QTYZ, SUM(`COSTUM`) AS COSTUMZ, SUM(`TOTAL`) AS TOTALZ FROM `t_pemasukan2` WHERE TGL between '".$tgl_awal."' AND '".$tgl_akhir."'");
			}	
		}
		else if (isset($_POST['tampil_tahund22']))
		{	
			$tahunnya = $_POST['cek_tahund22'];
			$tahunawal_nya = $tahunnya."-01-01";
			
			
			$tahunnya2 = $_POST['cek_tahund22d'];
			$tahunakhir_nya = $tahunnya2."-12-31";
			
			if((strcmp($tahunnya,$tahunnya2)==0) OR empty($tahunnya2)){				
				$nama = "Laporan Pemasukan Tahunan - " . $tahunnya;
				$data_barang = mysqli_query($koneksi, "SELECT JENIS, SUM(`QTY`) AS QTYX, SUM(`COSTUM`) AS COSTUMX, SUM(`TOTAL`) AS TOTALX FROM `t_pemasukan2` WHERE YEAR(TGL)='".$tahunnya."' GROUP BY JENIS ORDER BY TOTALX DESC");	
				$data_barang2 = mysqli_query($koneksi, "SELECT SUM(`QTY`) AS QTYZ, SUM(`COSTUM`) AS COSTUMZ, SUM(`TOTAL`) AS TOTALZ FROM `t_pemasukan2` WHERE YEAR(TGL)='".$tahunnya."'");	
			}
			else{
				$nama = "Laporan Transaksi Tahunan(" . $tahunnya." s.d. ". $tahunnya2.")";
				
				$data_barang = mysqli_query($koneksi, "SELECT JENIS, SUM(`QTY`) AS QTYX, SUM(`COSTUM`) AS COSTUMX, SUM(`TOTAL`) AS TOTALX FROM `t_pemasukan2` WHERE TGL between '".$tahunawal_nya."' AND '".$tahunakhir_nya."' GROUP BY JENIS ORDER BY TOTALX DESC");	
				$data_barang2 = mysqli_query($koneksi, "SELECT SUM(`QTY`) AS QTYZ, SUM(`COSTUM`) AS COSTUMZ, SUM(`TOTAL`) AS TOTALZ FROM `t_pemasukan2` WHERE TGL between '".$tahunawal_nya."' AND '".$tahunakhir_nya."'");	
			}
			
			
		}
		$jumtrans = mysqli_num_rows($data_barang);
		$jumtrans = "Jumlah Transaksi: " . $jumtrans;
	?>
<br><br>
      <h6 class="left"><?php echo $nama; ?></h5>
      <h6 hidden class="right"><b><?php echo $jumtrans; ?></b></h6>
      <h6 hidden class="right"><i><?php echo "[".$waktu_skg."-".$jam."]"; ?></i></h6>
      <table border="1" style="width: 100%" align='left'>
         <tr align='center'>
            <th hidden width="5%">No</th>
            <th>Sumber Pemasukan</th>
            <th>Pcs Terjual</th>
            <th>Costum Sablon</th>
            <th>Jumlah</th>
			<?php 
				session_start();
				if ($_SESSION['level']=="OWNER"){
			?>
            <th>Nominal</th>
			<?php
				}
			?>
         </tr>
         <?php 
            $no = 1;		
			$total_kuant=0;
			$total_mask=0;
			$total_kotor=0;
			$total_bersih=0;
			$total_diskon=0;
			$tot_qt_cos2=0;
			$total2=0;
              while($data = mysqli_fetch_array($data_barang)){					
            $jenis = $data['JENIS'];
            $costum = $data['COSTUMX'];
            $qty = $data['QTYX'];
            $total = $data['TOTALX'];
			$total2 = $total + $total2;
			$tot_qt_cos = $costum + $qty;
			$tot_qt_cos2 = $tot_qt_cos2 + $tot_qt_cos;
            $tot_qt_costamp = number_format($tot_qt_cos,0,',','.');      				
            $costumtamp = number_format($costum,0,',','.');      				
            $qtytamp = number_format($qty,0,',','.');      				
            $total_tamp = "Rp" . number_format($total,0,',','.');        			

			
            ?>
         <tr>
            <td hidden align='center'><?php echo $no++; ?></td>
            <td align='left'><?php echo $jenis; ?></td>
            <td align='right'><?php echo $qtytamp; ?></td>
            <td align='right'><?php echo $costumtamp; ?></td>
            <td align='right'><?php echo $tot_qt_costamp; ?></td>
            
			
			<?php 
				session_start();
				if ($_SESSION['level']=="OWNER"){
			?>
           <td align='right'><?php echo $total_tamp; ?></td>
			<?php
				}
			?>
         </tr>
		 <?php
			  }
			  
            $tot_qt_cos2_tamp = number_format($tot_qt_cos2,0,',','.'); 
				
            $total2_tamp = "Rp" . number_format($total2,0,',','.');  
			  ?>
		
         <tr>
            <td align='right' colspan="3"><b>Total</b></td>
            <td align='right'><b><?php echo $tot_qt_cos2_tamp; ?></b></td>
            
			
			<?php 
				session_start();
				if ($_SESSION['level']=="OWNER"){
			?>
           <td align='right'><b><?php echo $total2_tamp; ?></b></td>
			<?php
				}
			?>
         </tr>
			  
		
			  </table>
			  <?php
			  
				session_start();		
			  while($data2 = mysqli_fetch_array($data_barang2)){ 
			   $cos = $data2['COSTUMZ']; 
			   $qty = $data2['QTYZ']; 
			   $total = $data2['TOTALZ']; 
			   $totnya = $cos + $qty;
			   $totnyatamp = number_format($totnya,0,',','.');      
			   $totaltamp = "Rp" . number_format($total,0,',','.');      
			  }
			  
	   ?>
			<table border="0" style="width: 100%" align='center'>
				<tr><td colspan='6'>
				<br><br>
				</td>
				</tr>
				<tr>
					<td colspan='4'></td>
					<td hidden align='right'><b>Total Pcs + Costum : <?php echo $totnyatamp; ?></b></td>
					<td align='right'>Makassar, <?php echo $waktu_skg; ?></td>
					<td colspan='1'></td>
				</tr>
				<tr>
					<td colspan='4'></td>
					<td hidden align='right'><b>Total Pemasukan : <?php echo $totaltamp; ?></b></td>
					<td align='right'><b><?php echo $_SESSION['level'].' '.$_SESSION['nama_lengkap'];?></b></td>					
					<td colspan='1'></td>
				</tr>
			</table>
      <script>
         window.print();
      </script>
   </body>
</html>