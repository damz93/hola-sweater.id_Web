<?php
   include "koneksi.php";
   ?>
<!DOCTYPE html>
<html>
   <head>
      <script data-ad-client="ca-pub-5256228815542923" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <title>Menu Utama - S W E A T E R I N . M E</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="shortcut icon" href="img/tokonline.png">
      <!--	<link rel="stylesheet" href="css/freelancer.min.css">
         <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
         <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
         <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
         <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
         
         <script data-ad-client="ca-pub-5256228815542923" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>   
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
         -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <style type="text/css">
         {
         padding: 0;margin: 0;
         }
         .html, body{
         height: 100%;
         }
         .main{
         height: 90%;
         }
         .main-content{
         padding: 0%;
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
      <style>
         body, html {
         height: 100%;
         margin: 0;
         }
         .bg {
         /* The image used */
         background-image: url("img/bg_.png");
         /* Full height */
         height:85%; 
         /* Center and scale the image nicely */
         background-position: center;
         background-repeat: no-repeat;
         background-size: cover;
         }
      </style>
	  
	<style>
	.responsive {
	  width: 100%;
	  max-width: 200px;
	  height: auto;
	}
	</style>
	<style>
		.footer {
		   position: fixed;
		   left: 0;
		   bottom: 0;
		   width: 100%;
		   background-color: white;
		   color: white;
		   text-align: right;
		}
	</style>
   </head>
   <body>   
			<?php 
				error_reporting(0);
				session_start();					
				if($_SESSION['status']!="login"){
					echo "<script>alert('Anda belum login.....');window.location.href='index.php?pesan=belum_login';</script>";                    
				}
			?>   
   <div>   
         <nav class='navbar navbar-inverse'>
            <div class='container-fluid'>
               <div class='navbar-header'>
                  <a class='navbar-brand' href='#'><b>Pemberitahuan Order Costum >>> </b></a>
               </div>
               <ul class='nav navbar-nav navbar-right'>
                  <li class='dropdown'>
                     <a href='#' class='dropdown-toggle' data-toggle='dropdown'>
                     <span class='label label-pill label-danger count' style='border-radius:10px;'> 
                     </span> <span class='glyphicon glyphicon-envelope style='font-size:18px;'></span></a>
                     <ul class='dropdown-menu'></ul>
                  </li>
               </ul>
            </div>
         </nav>
		</div>
      <div class="bg">
         <div class="main">
            <div class="main-content">
               <div class="table-responsive">
                  <table style="width:90%;height:70%" border="0" class="table" cellpadding="2" cellspacing="2" align="center">
                     <tr style="height:30%">
                        <td style="width:15%" valign="center" align="center">
                           <a href="form-stok" title="Data Stok">
                              <img src="img/product.png" class="responsive" style="display: block; margin: auto;">
                              <figcaption class="figure-caption" align='center'>
                                 <h5><b>DATA STOK</b></h5>
                              </figcaption>
                           </a>
                        </td>
                        <td style="width:15%" valign="center" align="center">
                           <a href="form-order" title="Data Order">
                              <img src="img/order.png" class="responsive" style="display: block; margin: auto;">
                              <figcaption class="figure-caption" align='center'>
                                 <h5><b>DATA ORDER COSTUM</b></h5>
                              </figcaption>
                           </a>
                        </td>
                        <td hidden style="width:15%" valign="center" align="center">
                           <a href="form-transaksi" title="Data Transaksi">
                              <img src="img/sales.png" class="responsive" style="display: block; margin: auto;">
                              <figcaption class="figure-caption" align='center'>
                                 <h5><b>DATA TRANSAKSI</b></h5>
                              </figcaption>
                           </a>
                        </td>
                        <td style="width:15%" valign="center" align="center">
                           <a href="form-stok-keluar" title="Data STOK Keluar">
                              <img src="img/shop.png" class="responsive" style="display: block; margin: auto;">
                              <figcaption class="figure-caption" align='center'>
                                 <h5><b>DATA STOK KELUAR</b></h5>
                              </figcaption>
                           </a>
                        </td>
                        <td style="width:15%" valign="center" align="center">
                           <a href="form-diskon" title="Data Diskon">
                              <img src="img/discount.png" class="responsive" style="display: block; margin: auto;">
                              <figcaption class="figure-caption" align='center'>
                                 <h5><b>DATA DISKON</b></h5>
                              </figcaption>
                           </a>
                        </td>
                        <td style="width:15%" valign="center" align="center">
                           <a href="form-reseller" title="Data Reseller">
                              <img src="img/reseller.png" class="responsive" style="display: block; margin: auto;">
                              <figcaption class="figure-caption" align='center'>
                                 <h5><b>DATA RESELLER</b></h5>
                              </figcaption>
                           </a>
                        </td>
                     </tr>
                     <tr style="height:30%">
                        <td style="width:15%" valign="center" align="center">
                           <a href="form-pilih-inventory" title="Data Inventory">
                              <img src="img/inventory.png" class="responsive" style="display: block; margin: auto;">
                              <figcaption class="figure-caption" align='center'>
                                 <h5><b>DATA INVENTORY</b></h5>
                              </figcaption>
                           </a>
                        </td>
                        <td style="width:15%" valign="center" align="center">
                           <a href="form-pemasukan" title="Data Pemasukan">
                              <img src="img/income.png" class="responsive" style="display: block; margin: auto;">
                              <figcaption class="figure-caption" align='center'>
                                 <h5><b>DATA PEMASUKAN</b></h5>
                              </figcaption>
                           </a>
                        </td>
						<td style="width:15%" valign="center" align="center">
                           <a href="form-pengeluaran" title="Data Pengeluaran">
                              <img src="img/spendng.png" class="responsive" style="display: block; margin: auto;">
                              <figcaption class="figure-caption" align='center'>
                                 <h5><b>DATA PENGELUARAN</b></h5>
                              </figcaption>
                           </a>
                        </td>
                        <td style="width:15%" valign="center" align="center">
                           <a href="form-laporan" title="Data Report">
                              <img src="img/report.png" class="responsive" style="display: block; margin: auto;">
                              <figcaption class="figure-caption" align='center'>
                                 <h5><b>DATA REPORT</b></h5>
                              </figcaption>
                           </a>
                        </td>
                        <td style="width:15%" valign="center" align="center">
                           <a href="form-user" title="Data User">
                              <img src="img/user.png" class="responsive" style="display: block; margin: auto;">
                              <figcaption class="figure-caption" align='center'>
                                 <h5><b>DATA USER</b></h5>
                              </figcaption>
                           </a>
                        </td>
                        <td hidden style='width:15%' valign='center' align='center'>
                           <a href='logout' title='Logout'>
                              <img src='img/exit.png' class="responsive"  style='display: block; margin: auto;' >
                              <figcaption class='figure-caption' align='center'>
                                 <h5><b>LOGOUT</b></h5>
                              </figcaption>
                           </a>
                        </td>
                     </tr>
                  </table>
               </div>
            </div>
         </div>
      </div>
      <script>
         $(document).ready(function(){
          
          function load_unseen_notification(view = '')
          {
         $.ajax({
         url:"tampil_notif.php",
         method:"POST",
         data:{view:view},
         dataType:"json",
         success:function(data)
         {
          $('.dropdown-menu').html(data.notification);
          if(data.unseen_notification > 0)
          {
           $('.count').html(data.unseen_notification);
         }
          }
         });
         }
         
         load_unseen_notification();  
         
         $(document).on('click', '.dropdown-toggle', function(){
         $('.count').html('');
         load_unseen_notification('yes');
         });
         
         setInterval(function(){ 
         load_unseen_notification();; 
         }, 200);
         
         });
      </script>
	<div class="footer">  
		<p style="font-size:120%;" align="right"><b>			
			<a style="background-color:#71b8e4;color:#FFFFFe" href="logout"> _L O G O U T_ </a><br>
		</b></p>
	</div>
   </body>
</html>