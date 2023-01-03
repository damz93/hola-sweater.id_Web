<!DOCTYPE html>
<html moznomarginboxes mozdisallowselectionprint>
   <head>
      <head>
         <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
         <title>Cetak Nota Pemasukan - S W E A T E R I N . M E</title>
         <link rel="shortcut icon" href="img/tokonline.png">
         <meta http-equiv="refresh" content="5; url=form-pemasukan">
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
         else if ($_SESSION['level']!="OWNER" AND $_SESSION['level']!="SPV ADMIN" AND $_SESSION['level']!="ADMIN" AND $_SESSION['level']!="BENDAHARA"){
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
         //$data_pemasukan = mysqli_query($koneksi,"SELECT * from t_pemasukan WHERE KODE_TRANSAKSI='$kode_tr'");
         	
         $jumtrans = mysqli_num_rows($data_pemasukan);
         $jumtrans = "Jumlah Transaksi: " . $jumtrans;
         ?>
      <font size="3" face="Calibri" >
         <div style="border-bottom:3px dashed #000000;">
            <table border="0" align='center'>
               <tr align='center' width="38%">
                  <th width="20%">
                     <div class='rotate'>				
						<h4 align="left"><u><i>CFO COPY</u></i></h4>
                     </div>
                  </th>
                  <th width="80%">
                     <table border="0" align='center'>
                        <tr>
                           <td width="5%"></td>
                           <td><br><br>
                           </td>
                        </tr>
                        <tr>
                           <td width="5%"></td>
                           <?php 
                              $data_pemasukan = mysqli_query($koneksi,"SELECT * from t_pemasukan2 WHERE KODE_TRANSAKSI='$kode_tr'");
                                while($data = mysqli_fetch_array($data_pemasukan)){								
                              		$tglupd = substr($data['WAKTU'],0,10);		
                              		$dari = $data['DARI'];
                              		$qty = number_format($data['QTY'],0,',','.');
                              		$tot_pem = "Rp" . number_format($data['TOTAL_PEMASUKAN'],0,',','.');
                              		$tot_pen = "Rp" . number_format($data['TOTAL_PENGELUARAN'],0,',','.');
                              		$tot_edc = "Rp" . number_format($data['TOTAL_EDC'],0,',','.');
                              		$tot_tr = "Rp" . number_format($data['TOTAL_TRANSFER'],0,',','.');
                              		?>
                           <td colspan="2">
                              <h4>SWEATERIN.ME</h4>
                              <h6>Ruko Toddopuli Nomor 10 Blok B2</h6>
                              <h6>Kec. Manggala, Makassar</h6>
                              <h6>WA : 081371029661 - IG : @sweaterin.me</h6>
                           </td>
                           <td>
                              <h4>LEMBAR PEMASUKAN</h4>
                              <h6>Tanggal: <?php echo $tglupd; ?></h6>
                              <h6>Kode Pemasukan : <?php echo $data['KODE_TRANSAKSI']; ?></h6>
                           </td>
                        </tr>
                        <tr>
                           <td width="5%"></td>
                           <td colspan="2" align="left">
                              <br>
                              <h6>Telah Terima Dari : <?php echo $dari; ?></h6>
                              <h6>Pembayaran untuk : <?php echo $data['PEMASUKAN_TGL']; ?> </h6>
                           </td>
                        </tr>
                        <tr>
                           <td width="5%"></td>
                           <td colspan="3" align="left">
                              <table style="width:80%" border="2" align='left'>
                                 <tr>
                                    <td align="center">PCS Terjual						
                                    </td>
                                    <td align="center">Pemasukan Cash
                                    </td>
                                    <td align="center">EDC
                                    </td>
                                    <td align="center">Pengeluaran
                                    </td>
                                    <td align="center">Total Transfer
                                    </td>
                                 </tr>
                                 <tr>
                                    <td align="center">
                                       <h6><?php echo $qty; ?></h6>
                                    </td>
                                    <td align="center">
                                       <h6><?php echo $tot_pem; ?></h6>
                                    </td>
                                    <td align="center">
                                       <h6><?php echo $tot_edc; ?></h6>
                                    </td>
                                    <td align="center">
                                       <h6><?php echo $tot_pen; ?></h6>
                                    </td>
                                    <td align="center">
                                       <h6><?php echo $tot_tr; ?></h6>
                                    </td>
                                 </tr>
                              </table>
                           </td>
                        </tr>
                        <tr>
                           <td width="5%"></td>
                           <td colspan="3" align="left">
                              <table style="width:80%" border="0" align='left'>
                                 <tr>
                                    <td><br><br><br>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td><br>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td align="center">
                                       <h6><u><?php echo $data['DARI']; ?></u></h6>
                                    </td>
                                    <td align="center">
                                       <h6><u><?php echo $data['OLEH']; ?></u></h6>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td><br>
                                    </td>
                                 </tr>
                              </table>
                           </td>
                        </tr>
                        <?php
                           }
                           ?>		
                     </table>
                  </th>
                  </th>
               </tr>
			   
			</table>
         </div>
         <div style="border-bottom:3px dashed #000000;">
            <table border="0" align='center'>
               <tr width="38%">
                  <th width="20%">
                     <div class='rotate'>
						<h5 align="left"><u><i>Costumer COPY</u></i></h5>
                     </div>
                  </th>
                  <th width="80%">
                     <table border="0" align='center'>
                        <tr>
                           <td width="5%"></td>
                           <td><br>
                           </td>
                        </tr>
                        <tr>
                           <td width="5%"></td>
                           <?php 
                              $data_pemasukan = mysqli_query($koneksi,"SELECT * from t_pemasukan2 WHERE KODE_TRANSAKSI='$kode_tr'");
                                while($data = mysqli_fetch_array($data_pemasukan)){								
                              		$tglupd = substr($data['WAKTU'],0,10);		
                              		$dari = $data['DARI'];
                              		$qty = number_format($data['QTY'],0,',','.');
                              		$tot_pem = "Rp" . number_format($data['TOTAL_PEMASUKAN'],0,',','.');
                              		$tot_pen = "Rp" . number_format($data['TOTAL_PENGELUARAN'],0,',','.');
                              		$tot_edc = "Rp" . number_format($data['TOTAL_EDC'],0,',','.');
                              		$tot_tr = "Rp" . number_format($data['TOTAL_TRANSFER'],0,',','.');
                              		?>
                           <td colspan="2">
                              <h4>SWEATERIN.ME</h4>
                              <h6>Ruko Toddopuli Nomor 10 Blok B2</h6>
                              <h6>Kec. Manggala, Makassar</h6>
                              <h6>WA : 081371029661 - IG : @sweaterin.me</h6>
                           </td>
                           <td>
                              <h4>LEMBAR PEMASUKAN</h4>
                              <h6>Tanggal: <?php echo $tglupd; ?></h6>
                              <h6>Kode Pemasukan : <?php echo $data['KODE_TRANSAKSI']; ?></h6>
                           </td>
                        </tr>
                        <tr>
                           <td width="5%"></td>
                           <td colspan="2" align="left">
                              <br>
                              <h6>Telah Terima Dari : <?php echo $dari; ?></h6>
                              <h6>Pembayaran untuk : <?php echo $data['PEMASUKAN_TGL']; ?> </h6>
                           </td>
                        </tr>
                        <tr>
                           <td width="5%"></td>
                           <td colspan="3" align="left">
                              <table style="width:80%" border="2" align='left'>
                                 <tr>
                                    <td align="center">PCS Terjual						
                                    </td>
                                    <td align="center">Pemasukan Cash
                                    </td>
                                    <td align="center">EDC
                                    </td>
                                    <td align="center">Pengeluaran
                                    </td>
                                    <td align="center">Total Transfer
                                    </td>
                                 </tr>
                                 <tr>
                                    <td align="center">
                                       <h6><?php echo $qty; ?></h6>
                                    </td>
                                    <td align="center">
                                       <h6><?php echo $tot_pem; ?></h6>
                                    </td>
                                    <td align="center">
                                       <h6><?php echo $tot_edc; ?></h6>
                                    </td>
                                    <td align="center">
                                       <h6><?php echo $tot_pen; ?></h6>
                                    </td>
                                    <td align="center">
                                       <h6><?php echo $tot_tr; ?></h6>
                                    </td>
                                 </tr>
                              </table>
                           </td>
                        </tr>
                        <tr>
                           <td width="5%"></td>
                           <td colspan="3" align="left">
                              <table style="width:80%" border="0" align='left'>
                                 <tr>
                                    <td><br><br><br>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td><br>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td align="center">
                                       <h6><u><?php echo $data['DARI']; ?></u></h6>
                                    </td>
                                    <td align="center">
                                       <h6><u><?php echo $data['OLEH']; ?></u></h6>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td><br>
                                    </td>
                                 </tr>
                              </table>
                           </td>
                        </tr>
                        <?php
                           }
                           ?>		
                     </table>
                  </th>
                  </th>		
               </tr>
            </table>
         </div>
         <div style="border-bottom:3px dashed #000000;">
            <table border="0" align='center'>
               <tr width="38%">
                  <th width="20%">
                     <div class='rotate'>
                        <h4 align="left"><u><i>Admin COPY</u></i></h4>
                     </div>
                  </th>
                  <th width="80%">
                     <table border="0" align='center'>
                        <tr>
                           <td width="5%"></td>
                           <td><br>
                           </td>
                        </tr>
                        <tr>
                           <td width="5%"></td>
                           <?php 
                              $data_pemasukan = mysqli_query($koneksi,"SELECT * from t_pemasukan2 WHERE KODE_TRANSAKSI='$kode_tr'");
                                while($data = mysqli_fetch_array($data_pemasukan)){								
                              		$tglupd = substr($data['WAKTU'],0,10);		
                              		$dari = $data['DARI'];
                              		$qty = number_format($data['QTY'],0,',','.');
                              		$tot_pem = "Rp" . number_format($data['TOTAL_PEMASUKAN'],0,',','.');
                              		$tot_pen = "Rp" . number_format($data['TOTAL_PENGELUARAN'],0,',','.');
                              		$tot_edc = "Rp" . number_format($data['TOTAL_EDC'],0,',','.');
                              		$tot_tr = "Rp" . number_format($data['TOTAL_TRANSFER'],0,',','.');
                              		?>
                           <td colspan="2">
                              <h4>SWEATERIN.ME</h4>
                              <h6>Ruko Toddopuli Nomor 10 Blok B2</h6>
                              <h6>Kec. Manggala, Makassar</h6>
                              <h6>WA : 081371029661 - IG : @sweaterin.me</h6>
                           </td>
                           <td>
                              <h4>LEMBAR PEMASUKAN</h4>
                              <h6>Tanggal: <?php echo $tglupd; ?></h6>
                              <h6>Kode Pemasukan : <?php echo $data['KODE_TRANSAKSI']; ?></h6>
                           </td>
                        </tr>
                        <tr>
                           <td width="5%"></td>
                           <td colspan="2" align="left">
                              <br>
                              <h6>Telah Terima Dari : <?php echo $dari; ?></h6>
                              <h6>Pembayaran untuk : <?php echo $data['PEMASUKAN_TGL']; ?> </h6>
                           </td>
                        </tr>
                        <tr>
                           <td width="5%"></td>
                           <td colspan="3" align="left">
                              <table style="width:80%" border="2" align='left'>
                                 <tr>
                                    <td align="center">PCS Terjual						
                                    </td>
                                    <td align="center">Pemasukan Cash
                                    </td>
                                    <td align="center">EDC
                                    </td>
                                    <td align="center">Pengeluaran
                                    </td>
                                    <td align="center">Total Transfer
                                    </td>
                                 </tr>
                                 <tr>
                                    <td align="center">
                                       <h6><?php echo $qty; ?></h6>
                                    </td>
                                    <td align="center">
                                       <h6><?php echo $tot_pem; ?></h6>
                                    </td>
                                    <td align="center">
                                       <h6><?php echo $tot_edc; ?></h6>
                                    </td>
                                    <td align="center">
                                       <h6><?php echo $tot_pen; ?></h6>
                                    </td>
                                    <td align="center">
                                       <h6><?php echo $tot_tr; ?></h6>
                                    </td>
                                 </tr>
                              </table>
                           </td>
                        </tr>
                        <tr>
                           <td width="5%"></td>
                           <td colspan="3" align="left">
                              <table style="width:80%" border="0" align='left'>
                                 <tr>
                                    <td><br><br><br>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td><br>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td align="center">
                                       <h6><u><?php echo $data['DARI']; ?></u></h6>
                                    </td>
                                    <td align="center">
                                       <h6><u><?php echo $data['OLEH']; ?></u></h6>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td><br>
                                    </td>
                                 </tr>
                              </table>
                           </td>
                        </tr>
                        <?php
                           }
                           ?>		
                     </table>
                  </th>
                  </th>
               </tr>
            </table>
         </div>
      </font>
      <script>
         window.print();
      </script>
   </body>
</html>