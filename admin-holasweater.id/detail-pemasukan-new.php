<?php
   include 'koneksi.php';
   $kode_tr= $_GET['kode_input'];
   $pemasukan  = mysqli_query($koneksi, "select * from t_pemasukan2 where KODE_TRANSAKSI='$kode_tr'");
   $row        = mysqli_fetch_array($pemasukan);
   $tglny = date_create($row['TGL']);   
   $tglnya = date_format($tglny,'d-m-Y');  
   $jenis = $row['JENIS'];
   $ketern = $row['NOTES'];
   $dari = $row['DARI'];
   $cost = $row['COSTUM'];
   $payment = $row['PAYMENT'];
   $noref = $row['NOREF'];
   $qty = $row['QTY'];
   $total = $row['TOTAL'];
   $qty=number_format($qty,0,",",".");
   $total=number_format($total,0,",",".");
 ?>
<!DOCTYPE html>
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <title>Data Detail Pemasukan - HOLASWEATER.ID</title>      
	  <link rel="shortcut icon" href="img/hola_ic.png">
     <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/journ_bootstrap.min.css">
		<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
		<script src="js/bootstrap-datepicker.js"></script>
		<link rel="stylesheet" href="css/datepicker.css">
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
      <?php 
         error_reporting(0);
             session_start();					
             if($_SESSION['status']!="login"){
             	echo "<script>alert('Anda belum login.....');window.location.href='index?pesan=belum_login';</script>";                    
             }
         else if ($_SESSION['level']!="OWNER" AND $_SESSION['level']!="ADMIN" AND $_SESSION['level']!="ACCOUNTING"){
         //echo "<script>alert('...');window.location.href='edit-pengeluarann.php';</script>";                    
			echo "<script>alert('Anda tidak memiliki akses.....');window.location.href='javascript:history.go(-1)';</script>";
         }
		 else{
             ?>
      <div class="bg">
	  <h1 align='center' style="background-color:#73607c;color:#d5d5d5">DATA DETAIL PEMASUKAN </h1>
      <h3 align='center' style="background-color:#9f87aa;color:#FFFFFF">- HOLASWEATER.ID -</h3>
	  <br>
	  <br>
      <div class='container'>
         
         <form>
            <div class="table-responsive">
               <div class="form-group">
                  <div class="container">
                     <table border="0" style="width:60%" class="table table-borderless" cellpadding="2" cellspacing="2" align=center>
                        <div class="form-group">                           
						   <tr>
							<th>Kode Pemasukan</th>
							<td width="5%"></td>
							<td colspan="2"><input readonly value="<?php echo $kode_tr;?>" name="KODE_PEMASUKAN" class="form-control form-control-sm" ></td>			
						</tr>
						<tr>
							<th>Tanggal Input</th>
							<td width="5%"></td>
							<td colspan="2"><input readonly placeholder="Tanggal Transaksi(dd/MM/yyyy)" class="form-control form-control-sm datepicker" maxlength="30" value="<?php echo $tglnya;?>" type="text" name="tgl_transaksi" id="tgl_transaksi">  </td>
						</tr>
						<tr>
							<th>Jenis Pemasukan</th>
							<td width="5%"></td>
							<td colspan="2">
								<input readonly value="<?php echo $jenis;?>" name="KODE_PEMASUKAN" class="form-control form-control-sm" >
							</td>		
							
						</tr>		
						
						<tr hidden>
							<th>Total Pembayaran</th>
							<td width="5%" align="right"><label>Rp</label></td>
							<td colspan="2"><input type="text" id="total_pembayaran" class="form-control form-control-sm mata-uang" value="<?php echo $total;?>" onkeyup="inputTerbilang();" name="TOTAL_PEMBAYARAN" ></th>
						</tr>
						<tr>
							<th>PCS Terjual</th>
							<td width="5%" align="right"></td>
							<td colspan="2"><input readonly type="text" id="qty" value="<?php echo $qty;?>" class="form-control form-control-sm mata-uang" onkeyup="inputTerbilang();" name="QTY" ></th>
						</tr>
						
						<tr>
							<th>Costum Sablon</th>
							<td width="5%" align="right"></td>
							<td colspan="2"><input type="text" readonly id="costum" value="<?php echo $cost;?>" class="form-control form-control-sm mata-uang" onkeyup="inputTerbilang();" name="COSTUM" ></th>
						</tr>
						<tr>
							<th>Keterangan</th>
							<td width="5%"></td>
							<td colspan="2"><textarea rows="4" readonly cols="50" class="form-control form-control-sm" id="keterangan"  placeholder="Keterangan" maxlength="300" type="text" name="KETERANGAN"><?php echo htmlspecialchars($ketern); ?></textarea></td>
						</tr>
						
                        </div>
                     </table>
                  </div>
               </div>
            </div>
         </form>
      </div>
		 <?php } ?>
   </body>
</html>