<?php
   include 'koneksi.php';
   $kode_tr= $_GET['kode_input'];
   $pemasukan  = mysqli_query($koneksi, "select * from t_pemasukan2 where KODE_TRANSAKSI='$kode_tr'");
   $row        = mysqli_fetch_array($pemasukan);
   $tglnya = $row['TGL'];
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
      <title>Edit Pemasukan - S W E A T E R I N . M E</title>
      <link rel="shortcut icon" href="img/tokonline.png">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
      <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
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
         else if($_SESSION['level']!="OWNER"){
         //echo "<script>alert('...');window.location.href='edit-pengeluarann.php';</script>";                    
         echo "<script>alert('Anda tidak memiliki akses.....');window.location.href='javascript:history.go(-1)';</script>";
         }
             ?>
      <div class="bg">
      <h1 align='center' style="background-color:#71b8e4;color:#FFFFFe">EDIT PEMASUKAN</h1>
      <h3 align='center' style="background-color:#1d7bb6;color:#FFFFee">- S W E A T E R I N . M E -</h3>
      <div class='container'>
         <a style="background-color:#71b8e4;color:#FFFFFe" href="form-pemasukan"> [ Kembali ke Data Pemasukan ]</a><br>
         
         <form method="post" action="update-pemasukan.php" onsubmit="return confirm('Yakin ingin update?');">
            <div class="table-responsive">
               <div class="form-group">
                  <div class="container">
                     <table border="0" class="table" cellpadding="2" cellspacing="2" align=center>
                        <div class="form-group">                           
						   <tr>
							<th>Kode Pemasukan</th>
							<td width="5%"></td>
							<td colspan="2"><input readonly value="<?php echo $kode_tr;?>" name="KODE_PEMASUKAN" class="form-control form-control-sm" ></td>			
						</tr>
						<tr>
							<th>Jenis Pemasukan</th>
							<td width="5%"></td>
							<td colspan="2">
								<select  class="form-control form-control-sm" name="JENIS" id="jenis"  onchange="autofocus2()" autofocus>
									 <option value="OFFLINE STORE" <?php if($jenis=="OFFLINE STORE") echo 'selected="selected"'; ?> >Offline Store</option>
									 <option value="RESELLER" <?php if($jenis=="RESELLER") echo 'selected="selected"'; ?> >Reseller</option>
									 <option value="SHOPEE" <?php if($jenis=="SHOPEE") echo 'selected="selected"'; ?> >Shope</option>
									 <option value="LAIN-LAIN" <?php if($jenis=="LAIN-LAIN") echo 'selected="selected"'; ?> >Lain-lain</option>
								</select>
							</td>		
							
						</tr>

						<tr>
							<td><br>
							</td>
						</tr>			
						<tr>
							<th>Tanggal Transaksi</th>
							<td width="5%"></td>
							<td colspan="2"><input autofocus placeholder="Tanggal Transaksi(dd/MM/yyyy)" class="form-control form-control-sm datepicker" maxlength="30" value="<?php echo $tglnya;?>" type="text" name="tgl_transaksi" id="tgl_transaksi">  </td>
						</tr>
						
						<tr>
							<th>Terima Dari</th>
							<td width="5%"></td>
							<td colspan="2"><input  class="form-control form-control-sm" id="dari"  value="<?php echo $dari;?>"  placeholder="Dari" maxlength="120" type="text" name="DARI"></th>
						</tr>
						   
						  
						
						<tr>
							<th>Total Pembayaran</th>
							<td width="5%" align="right"><label>Rp</label></td>
							<td colspan="2"><input type="text" id="total_pembayaran" class="form-control form-control-sm mata-uang" value="<?php echo $total;?>" onkeyup="inputTerbilang();" name="TOTAL_PEMBAYARAN" ></th>
						</tr>
						<tr>
							<th>PCS Terjual</th>
							<td width="5%" align="right"></td>
							<td colspan="2"><input type="text" id="qty" value="<?php echo $qty;?>" class="form-control form-control-sm mata-uang" onkeyup="inputTerbilang();" name="QTY" ></th>
						</tr>
						
						<tr>
							<th>Jumlah Costum</th>
							<td width="5%" align="right"></td>
							<td colspan="2"><input type="text" id="costum" value="<?php echo $cost;?>" class="form-control form-control-sm mata-uang" onkeyup="inputTerbilang();" name="COSTUM" ></th>
						</tr>
						<tr>
							<td><br>
							</td>
						</tr>
						
						<tr hidden>
							<th>Payment Method</th>
							<td width="5%"></td>
							<td colspan="2"><input  class="form-control form-control-sm" id="payment4"  placeholder="Transfer, EDC, Tunai ...." maxlength="120" type="text" name="PAYMENT4"></th>
						</tr>
						<tr>
							<th>Payment Method</th>
							<td width="5%"></td>
							<td colspan="2">
								<select  class="form-control form-control-sm" name="PAYMENT" id="payment"  onchange="autofocus3()" autofocus>																	
									 <option value="EDC" <?php if($payment=="EDC") echo 'selected="selected"'; ?> >EDC</option>
									 <option value="TRANSFER" <?php if($payment=="TRANSFER") echo 'selected="selected"'; ?> >Transfer</option>
									 <option value="TUNAI" <?php if($payment=="TUNAI") echo 'selected="selected"'; ?> >Tunai</option>									
								</select></td>
						</tr>
						<tr>
							<th>No. Ref Pembayaran</th>
							<td width="5%"></td>
							<td colspan="2"><input  class="form-control form-control-sm" id="noref" value="<?php echo $noref;?>" placeholder="No-Ref" maxlength="120" type="text" name="NOREF"></td>
						</tr>
						<tr>
							<th>Keterangan</th>
							<td width="5%"></td>
							<td colspan="2"><textarea rows="4" cols="50" class="form-control form-control-sm" id="keterangan"  placeholder="Keterangan" maxlength="300" type="text" name="KETERANGAN"><?php echo htmlspecialchars($ketern); ?></textarea></td>
						</tr>
						
						
						
						
                           <tr align='center'>
                              <br>
                              <td colspan="3"><button type="submit" value="simpan" class="btn btn-info btn-lg btn-block">Update</button></td>
                           </tr>
                        </div>
                     </table>
                  </div>
               </div>
            </div>
         </form>
         <script src="js/jquery.mask.min.js"></script>
         <script src="js/terbilang.js"></script>
         <script type="text/javascript">
            function inputTerbilang() {
              //membuat inputan otomatis jadi mata uang
              $('.mata-uang').mask('0.000.000.000', {reverse: true});
            
              //mengambil data uang yang akan dirubah jadi terbilang
               var input = document.getElementById("terbilang-input").value.replace(/\./g, "");
            
               //menampilkan hasil dari terbilang
               document.getElementById("terbilang-output").value = terbilang(input).replace(/  +/g, ' ');
            } 
         </script>		
         <script type="text/javascript">
            function select(){			   
            document.getElementById("tgl_transaksi").focus();							
            }
         </script>
         <script type="text/javascript">
            $(function(){
                $(".datepicker").datepicker({
                    format: 'yyyy-mm-dd',
                    autoclose: true,
                    todayHighlight: true,
                });
            });
         </script>
		 <script type="text/javascript">
			function total_transferx(){		  
				 $('.mata-uang').mask('0.000.000.000', {reverse: true});		
				//var input = document.getElementById("total_pemasukan").value.replace(/\./g, "");
			//	var input = document.getElementById("total_pengeluaran").value.replace(/\./g, "");
			
			   //menampilkan hasil dari terbilang
			   //document.getElementById("total_pemasukan").value = terbilang(input).replace(/  +/g, ' ');			
			   //document.getElementById("total_pengeluaran").value = terbilang(input).replace(/  +/g, ' ');			
			   
			//   alert('0');
				var total_masukx = document.getElementById('total_pemasukan').value;
				var total_keluarx = document.getElementById('total_pengeluaran').value;								
				var total_masuk = total_masukx.replace(".","");
				total_masuk = total_masuk.replace(".","");
				total_masuk = total_masuk.replace(".","");
				var total_keluar = total_keluarx.replace(".","");		
				total_keluar = total_keluar.replace(".","");				
				total_keluar = total_keluar.replace(".","");				
				if (total_masuk == ""){
					document.getElementById('total_pemasukan').value="0";
					total_masuk=0;
				}
				else if (total_keluar == ""){
					document.getElementById('total_pengeluaran').value="0";
					total_keluar=0;
					//
				}
				
				
					var total = parseInt(total_masuk) - parseInt(total_keluar);
					//alert (total_tr);
					var totalnya = total.toFixed().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
					
					document.getElementById("total_transfer").value = totalnya;				
					document.getElementById("kembalian").innerHTML = "Rp"+totalnya;				
				
			}		         
		</script>
		
		<script>
			function autofocus2() {
				document.getElementById("tgl_transaksi").focus();
			}
			 
		</script>
		<script>
			function autofocus3() {
				document.getElementById("noref").focus();
			}
			 
		</script>
      </div>
   </body>
</html>