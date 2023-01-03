<?php
   //error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
   error_reporting(0);
   include 'koneksi.php';
   ?>
<html>
   <head>
      <script>
         function inputTerbilang() {
           //membuat inputan otomatis jadi mata uang
           $('.mata-uang').mask('0.000.000.000', {reverse: true});
         
           //mengambil data uang yang akan dirubah jadi terbilang
            var input = document.getElementById("terbilang-input").value.replace(/\./g, "");
         
            //menampilkan hasil dari terbilang
            document.getElementById("terbilang-output").value = terbilang(input).replace(/  +/g, ' ');
         } 
      </script>
      <script>
         function sebelum() {                        
           var resi = document.getElementById("kode_order").value; 
           if(resi==""){
               alert('Masukkan Kode Resi');    
               document.getElementById("kode_order").focus();
               return false;
           }
             else{
                return confirm('Yakin ingin simpan?');              
             }
         }
         
      </script>
      <style>
         div.ex1 {
         background-color: lightblue;
         width: 110px;
         height: 110px;
         overflow: scroll;
         }
         div.ex2 {
         background-color: lightblue;
         width: 110px;
         height: 110px;
         overflow: hidden;
         }
         div.ex3 {  
         width: 1024px;
         height: 500px;
         overflow: auto;
         }
         div.ex4 {
         background-color: lightblue;
         width: 110px;
         height: 110px;
         overflow: visible;
         }
      </style>
      <script type="text/javascript">
         function delete_data(d){
           var jenis_barang=d;        
           if (confirm("Are you sure you want to delete this Item?")) {            
               $.ajax({
                 type: "get",
                 url: "hapus-reseller-detail.php",
                 data: {jenis_barang:jenis_barang},
                 success: function(value){
                   //$("#data_table").html(value);
                    location.reload(true);
                   //document.getElementById("form_tampil").reset();        
                 }
               });
           }
           else{
               return false;
           }
         }
      </script>
	  <script>
			function sebelumnya() {         				
			  var norekt = $('#norek').val();
			  var nacost = $('#nacost').val();
			  var wacost = $('#wacost').val();
			  var alcost = $('#alcost').val();
			  if(norekt==""){
				  alert('Nomor Rekening/Nama Kosong.. Mohon diisi.');	
				  document.getElementById("norek").focus();
				  return false;
			  }
			  if(nacost==""){
				  alert('Nama Costumer Kosong.. Mohon diisi.');	
				  document.getElementById("nacost").focus();
				  return false;
			  }
			  if(wacost==""){
				  alert('WA Costumer Kosong.. Mohon diisi.');	
				  document.getElementById("wacost").focus();
				  return false;
			  }
			  if(alcost==""){
				  alert('Alamat Costumer Kosong.. Mohon diisi.');	
				  document.getElementById("alcost").focus();
				  return false;
			  }
			
				else{
			return confirm('Yakin ingin simpan?');         	 
				}
			}
			
		</script>
   </head>
   <body>
      <form method="post" action="simpan-rsl.php" autocomplete="off" onsubmit="return sebelumnya()">	  
         <div class="table-responsive">
            <div class="container">
               <br>
               <div class="ex3">
                  <table border="0" class="table" cellpadding="2" cellspacing="2" align=center>
                     <div class="form-group">
                        <thead align="center">
                           <tr align='center' class="table-info">
                              <th width="1%">No</th>
                              <th>Jenis Barang</th>
                              <th>Deskripsi</th>
                              <th>Biaya</th>
                              <th>Qty</th>
                              <th>Jumlah</th>
                              <th width="3%">Aksi</th>
                           </tr>
                        </thead>
                        <?php
                           session_start();
                           $oleh   = $_SESSION['username'];
                           $kod_trs = $_POST['kode_transaksi'];
                           $no     = 1;
                           $juml_tagihan =0;
                           $juml_qty =0;
                           $totpcs = 0;
                            // $data   = mysqli_query($koneksi, "select * from t_pengeluaran_temp where OLEH='".$oleh."' AND KODE_PENGELUARAN='".$kod_trs."' ORDER BY ID DESC");
                           $data   = mysqli_query($koneksi, "select * from t_reseller_temp ORDER BY ID DESC");
                           while ($d = mysqli_fetch_array($data)) {
								$juml_tagihan = $juml_tagihan + $d['TOTAL'];
                               $juml_tagihantamp = "Rp".number_format($juml_tagihan, 0, ",", ".");
                           	$juml_qty = $juml_qty + $d['BANYAKNYA'];
                               $juml_qtytamp = number_format($juml_qty, 0, ",", ".");
                               $nominal            = "Rp".number_format($d['TOTAL'], 0, ",", ".");
                               $jen_bar         = $d['JENIS_BARANG'];
                               $desk         = $d['DESKRIPSI'];
                               $kode_transaksi         = $d['KODE_PENGELUARAN'];
                               $keterangan = $d['NOTES'];
                               $peritem         = $d['PER_ITEM'];
                           	$peritemtamp = "Rp".number_format($peritem, 0, ",", ".");										
                               $banyaknya         = $d['BANYAKNYA'];
                           	$banyaknyatamp = number_format($banyaknya, 0, ",", ".");
                           	
                               $totpcs++;
                           ?>
                        <tr align="center">
                           <td><?php
                              echo $no++;
                              ?></td>
                           <td><?php
                              echo $jen_bar;
                              ?></td>
                           <td align="left"><?php
                              echo $desk;
                              ?></td>
                           <td><?php
                              echo $peritemtamp;
                              ?></td>
                           <td><?php
                              echo $banyaknyatamp;
                              ?></td>
                           <td align="center"><?php
                              echo $nominal;
                              ?></td>
                           <td>
                              <a class="btn btn-danger" onclick="delete_data('<?php echo $jen_bar; ?>')" title="Delete Item"><img src="img/delete.png" height="50%" ></a>
                           </td>
                        </tr>
                        <?php
                           }
                           
                           ?>
                        <tr>
                           <td colspan="7">
                              <p align='right'>
                                 <?php
                                    echo $juml_tagihantamp . " (Total Tagihan)<br>";												
                                    echo $juml_qtytamp . " (Jumlah QTY)<br>";												
                                    echo $totpcs . " (Banyaknya Transaksi)";
                                    ?>
                              </p>
                           </td>
                        </tr>
                     </div>
                  </table>
                  <table border="0" class="table" cellpadding="2" cellspacing="2" align=center>
                     <div class="form-group">
					 <td hidden><input readonly="readonly" value="<?php echo $juml_tagihan; ?>" type="text" id="total1" class="form-control form-control-sm mata-uang"></td>
                        <tr>
						
                           <td align="left">
                              <h6>Kategori</h6>
                           </td>
                           <td colspan="3">
                              <select name="kategori" id="kategori" onchange="select_aft_dev()" class="form-control form-control-sm">
                                 <option value="RESELLER A" <?php if($_POST['kategori'] == 'RESELLER A') {echo 'selected=selected'; } ?> >Reseller A</option>
                                 <option value="RESELLER B" <?php if($_POST['kategori'] == 'RESELLER B') {echo 'selected=selected'; } ?> >Reseller B</option>
                                 <option value="RESELLER C"<?php if($_POST['kategori'] == 'RESELLER C') {echo "selected=selected"; } ?> >Reseller C</option>
                                 <option value="RESELLER D"<?php if($_POST['kategori'] == 'RESELLER D') {echo "selected=selected"; } ?> >Reseller D</option>
                                 <option value="LAIN-LAIN"<?php if($_POST['kategori'] == 'LAIN-LAIN') {echo "selected=selected"; } ?> >Lain-lain</option>
                              </select>
                           </td>
                           <td align="left">
                              <h6>Nama Costumer</h6>
                           </td>
                           <td colspan="3">
                              <input value="Nama Costumer" type="text" placeholder="Nama Costumer" id="nacost" maxlength="30" name="nacost" class="form-control form-control-sm">									
                           </td>
                        </tr>
                        <tr>
                           <td align="left">
                              <h6>No.Rek / Nama</h6>
                           </td>
                           <td colspan="3">
                              <input value="Nomor Rekening/Nama" type="text" placeholder="Nomor Rekening/Nama" id="norek" maxlength="30" name="norek" class="form-control form-control-sm">									
                           </td>
                           <td align="left">
                              <h6>Alamat Costumer</h6>
                           </td>
                           <td colspan="3">
                              <input value="Alamat Costumer" type="text" placeholder="Alamat Costumer" id="alcost" maxlength="30" name="alcost" class="form-control form-control-sm">									
                           </td>
                        </tr>
                        <tr>
                           <td align="left">
                              <h6>Payment Method</h6>
                           </td>
                           <td colspan="3">
                              <select name="payment" id="payment" onchange="select_aft_pay()" class="form-control form-control-sm">
                                 <option value="CASH" <?php if($_POST['payment'] == 'CASH') {echo 'selected=selected'; } ?> >Cash</option>
                                 <option value="TRANSFER" <?php if($_POST['payment'] == 'TRANSFER') {echo 'selected=selected'; } ?> >Transfer</option>
                              </select>
                           </td>
                           <td align="left">
                              <h6>WA Costumer</h6>
                           </td>
                           <td colspan="3">
                              <input value="08" type="number" placeholder="08" id="wacost" maxlength="15" name="wacost" class="form-control form-control-sm">									
                           </td>
                        </tr>
                        <tr>
                           <td align="left">
                              <h6>Ongkos Kirim</h6>
                           </td>
                           <td width="2%"><label>Rp</label></td>
                           <td colspan="2"><input value="0" type="text" name="ongkir" id="ongkir" class="form-control form-control-sm mata-uang" onkeyup="total_biaya2();"></td>
						   <td align="left">
                              <h6>Total Biaya</h6>
                           </td>
                           <td colspan="3"><h5 align="left"><label name="total_harga" id="total_harga"><?php echo $juml_tagihantamp; ?></label></h5></td>
						   
						   
						   
                        </tr>
                     </div>
                     <tr align='center'>
                        <td colspan="7">
                           <button width="100%" type="submit" value="simpan" class="btn btn-info btn-lg btn-block">Proses</button>                                                
                        </td>
                     </tr>
                  </table>
               </div>
            </div>
         </div>
      </form>
	  	<script type="text/javascript">
			function total_biaya2(){		  
				 $('.mata-uang').mask('0.000.000.000', {reverse: true});		
				
				var total1x = document.getElementById('total1').value;
				var ongkirx = document.getElementById('ongkir').value;
				  if (total1x == ""){
						document.getElementById('total1').value="0";
						total1x=0;
				  }
				  if (ongkirx == ""){
						document.getElementById('ongkir').value="0";
						ongkirx=0;
				  }
									
				total1x = total1x.replace(".","");
				total1x = total1x.replace(".","");
				//total1x = total1x.replace(".","");
				ongkirx = ongkirx.replace(".","");		
				ongkirx = ongkirx.replace(".","");				
				//ongkirx = ongkirx.replace(".","");								
								
				
				
					var total = parseInt(ongkirx) + parseInt(total1x);
					//alert (total_tr);
					var totalnya = total.toFixed().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
					
					//document.getElementById("nominal").value = totalnya;				
					document.getElementById("total_harga").innerHTML = "Rp"+totalnya;				
				
			}		         
		</script>
   </body>
</html>