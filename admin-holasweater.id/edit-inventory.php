<?php
   include 'koneksi.php';
   $kode_barang         = $_GET['kode_barang'];
   $barang  = mysqli_query($koneksi, "select * from t_inventory where KODE_BARANG='$kode_barang'");
   $row        = mysqli_fetch_array($barang);
   
   $kode_barang = $row['KODE_BARANG'];
	$nama_barang = $row['NAMA_BARANG'];
	$spesf = $row['SPESIFIKASI'];
	$satuan = $row['SATUAN'];
   $qty=number_format($row['QTY'],0,",",".");
   
   // membuat data jurusan menjadi dinamis dalam bentuk array
   //$jurusan    = array('TEKNIK INFORMATIKA','TEKNIK ELEKTRO','REKAMEDIS');
   // membuat function untuk set aktif radio button
   /*function active_radio_button($value,$input){
       // apabilan value dari radio sama dengan yang di input
       $result =  $value==$input?'checked':'';
       return $result;
   }*/
   ?>
<!DOCTYPE html>
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <title>Edit Inventory - S W E A T E R I N . M E</title>
      <link rel="shortcut icon" href="img/tokonline.png">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="css/freelancer.min.css">
      <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
      <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
      <link rel="shortcut icon" href="img/logo_ghm2.png">
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
         if ($_SESSION['status']!="login") {
			echo "<script>alert('Anda belum login.....');window.location.href='index?pesan=belum_login';</script>";
		}
		else if ($_SESSION['level']!="OWNER" AND $_SESSION['level']!="OWNER" AND $_SESSION['level']!="SPV GUDANG"){
			echo "<script>alert('Anda tidak memiliki akses.....');window.location.href='javascript:history.go(-1)';</script>";
		}
		else {
			
		}
      ?>
      <h1 align='center' style="background-color:#71b8e4;color:#FFFFFe">EDIT INVENTORY</h1>
      <h3 align='center' style="background-color:#1d7bb6;color:#FFFFee">- S W E A T E R I N . M E -</h3>
      <div class='container'>
         <a style="background-color:#71b8e4;color:#FFFFFe" href="form-inventory"> [ Kembali ke Data Inventory ]</a><br>
         <br>
         <form method="post" action="update-inventory" onsubmit="return confirm('Yakin ingin update?');">
            <div class="table-responsive">
               <div class="form-group">
                  <div class="container">
                     <br>
                     <table border="0" class="table" cellpadding="2" cellspacing="2" align=center>
                        <div class="form-group">
                           <tr>
                              <th>Kode Barang</th>
                              <td colspan="2"><input readonly value="<?php echo $row['KODE_BARANG'];?>" name="KODE_BARANG" class="form-control form-control-sm"></td>
                           </tr>
                           <tr>
                              <th>Nama Barang</th>
                              <td colspan="2"><input autofocus maxlength="30" class="form-control form-control-sm" type="text" value="<?php echo $row['NAMA_BARANG'];?>" name="NAMA_BARANG"></td>
                           </tr>
                           <tr>
                              <th>Spesifikasi</th>
                              <td colspan="2"><input class="form-control form-control-sm" maxlength="30" type="text" value="<?php echo $spesf;?>" name="SPESIFIKASI"></td>
                           </tr>
                           <tr>
                              <th>Satuan</th>
                              <td colspan="2"><input class="form-control form-control-sm" autofocus maxlength="30" type="text" value="<?php echo $satuan;?>" name="SATUAN"></td>
                           </tr>
                           <tr>
                              <th>Stok Sekarang</th>
                              <td colspan="2">   <input readonly type='text' id="terbilang-input" class="form-control form-control-sm mata-uang" onkeyup="inputTerbilang();" maxlength="5" value="<?php echo $qty;?>" name="QTY"> </td>
                           </tr>
						   
						   
                           <tr align='center'>
                              <td colspan="3"><button type="submit" value="simpan" class="btn btn-info btn-lg btn-block">Update</button></td>
                           </tr>
                        </div>
                     </table>
                  </div>
               </div>
            </div>
         </form>
         <script src="js/jquery-1.11.2.min.js"></script>
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
      </div>
   </body>
</html>