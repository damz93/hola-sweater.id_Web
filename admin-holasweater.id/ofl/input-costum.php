<?php
   include 'koneksi.php';
   ?>
<!DOCTYPE html>
<html>
   <head>
      <title>Tambah Costum - S W E A T E R I N . M E</title>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <link rel="shortcut icon" href="img/tokonline.png">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
      <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
      <script src="js/bootstrap-datepicker.js"></script>
      <link rel="stylesheet" href="css/datepicker.css">
      <!--  <link rel="stylesheet" href="css/freelancer.min.css">    -->
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
			else if (($_SESSION['level']!="OWNER") AND ($_SESSION['level']!="SPV KASIR")){
					echo "<script>alert('Anda tidak memiliki akses.....');window.location.href='javascript:history.go(-1)';</script>";
			}
	?>
      <h1 align='center' style="background-color:#71b8e4;color:#FFFFFe">TAMBAH COSTUM</h1>
      <h3 align='center' style="background-color:#1d7bb6;color:#FFFFee">- S W E A T E R I N . M E -</h3>
      <div class='container'>
      <a style="background-color:#71b8e4;color:#FFFFFe" href="form-costum"> [ Kembali ke Data Costum ]</a><br>
      <br>
      <form method="post" action="simpan-costum.php" onsubmit="return confirm('Yakin ingin simpan?');">
         <div class="table-responsive">
            <div class="form-group">
               <div class="container">
                  <br>
                  <table border="0" class="table" cellpadding="2" cellspacing="2" align=center>
                     <div class="form-group">
                        <tr>
                           <th>Kode Costum</th>
                           <td colspan="3"><input autofocus maxlength="60" type="text" class="form-control form-control-sm" id="KODE_COSTUM" name="KODE_COSTUM" placeholder="KODE COSTUM"> </td>
                        </tr>
                        <tr>
                           <th>Keterangan</th>
                           <td colspan="3"> <input id="keterangan"  placeholder="KETERANGAN" class="form-control form-control-sm" maxlength="80" type="text" name="KETERANGAN">  </td>
                        </tr>
                        <tr>
                           <th>Harga</th>
                           <td width="1%">Rp</td>
                           <td align="left" width="60%" colspan="2"><input type="text" id="harga" placeholder="0" class="form-control form-control-sm mata-uang" onkeyup="inputTerbilang();" name="HARGA" >
                        </tr>
                        <tr>
                           <th>Status</th>
                           <td colspan="3">
                              <select name="STATUSX" id="STATUSX" class="form-control form-control-sm">
                                 <option value="AKTIF" selected>Aktif</option>
                                 <option value="NON AKTIF">Non AKtif</option>
                              </select>
                           </td>
                        </tr>
                        <tr align='center'>
                           <br>
                           <td colspan="2"><button type="submit" value="simpan" class="btn btn-info btn-lg btn-block">Simpan</button></td>
                           <td colspan="2">
                              <button onclick="autofocuss()" type="reset" class="btn btn-danger btn-lg btn-block">Batal</button>
                           </td>
                        </tr>
                     </div>
               </table>	
            </div>
            </div>
            </div>
      </form>
      <!-- <script src="js/jquery-1.11.2.min.js"></script>-->
      <script src="js/jquery.mask.min.js"></script>
      <script src="js/terbilang.js"></script>
      <script>
         function autofocuss() {
         	document.getElementById("KODE_COSTUM").focus();
         }
          
      </script>
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
      </div>
   </body>
</html>