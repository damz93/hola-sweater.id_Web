<?php
   include 'koneksi.php';
   $id         = $_GET['id'];
   $user  = mysqli_query($koneksi, "select * from t_user where ID='$id'");
   $row        = mysqli_fetch_array($user);
   $level = $row['LEVEL'];
   ?>
<!DOCTYPE html>
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <title>Edit User - HOLASWEATER.ID</title>      
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
		 .btn-primary {
			color: #fff;
			background-color: #fa8d70;
			border-color: #fa8d70; /*set the color you want here*/
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
				else if($_SESSION['level']!="OWNER"){
					echo "<script>alert('Anda tidak memiliki akses.....');window.location.href='javascript:history.go(-1)';</script>";                    
				}
			?>
	  <h1 align='left' style="color:#585657">EDIT USER</h1>
         <div class='container'>
            <br>
			<br>
			<h5 style="color:#73607c">Edit User : <?php echo $row['USERNAME'];?></h3>
			<br>		
			
			<form action="update-user-new" onsubmit="return cek_update_user();" method="post" autocomplete="off">
			<div class="container">
				<table style="width:65%" border="0" align="left" cellpadding="0" cellspacing="0">
					<div class="form-group">
						<tr>
							<td align="left" style="width:25%">
								<b>User ID</b>
							</td>
							<td align="center" style="width:5%">
								<b>:</b>
							</td>
							<td align="left">
								<input readonly value="<?php echo $row['USERNAME'];?>" name="USERNAME" class="form-control form-control-sm">
							</td>
							<td style="width:15%">						
							</td>
						</tr>
						<tr>
							<td align="left" style="width:25%">
								<b>Nama Lengkap</b>
							</td>
							<td align="center" style="width:5%">
								<b>:</b>
							</td>
							<td align="left">
								<input autofocus maxlength="60" type="text" value="<?php echo $row['NAMA'];?>" name="NAMA_LENGKAP" id='nama_lengkap' class="form-control form-control-sm">
							</td>
							<td style="width:15%">						
							</td>
						</tr>
						<tr>
							<td align="left" style="width:25%">
								<b>Nickname</b>
							</td>
							<td align="center" style="width:5%">
								<b>:</b>
							</td>
							<td align="left">
								<input maxlength="40" type="text" value="<?php echo $row['NICKNM'];?>" name="NICKNM" id='nicname' class="form-control form-control-sm">
							</td>
							<td style="width:15%">						
							</td>
						</tr>
						<tr>
							<td align="left" style="width:25%">
								<b>Tanggal Lahir</b>
							</td>
							<td align="center" style="width:5%">
								<b>:</b>
							</td>
							<td align="left">
								<input maxlength="30" type="text" id='tgl_lahir' value="<?php echo $row['TGL_LAHIR'];?>" name="TGL_LAHIR" class="form-control form-control-sm datepicker">
							</td>
							<td style="width:15%">						
							</td>
						</tr>
						<tr>
							<td align="left" style="width:25%">
								<b>Whatsapp</b>
							</td>
							<td align="center" style="width:5%">
								<b>:</b>
							</td>
							<td align="left">
								<input class="form-control form-control-sm" id="wassap" value="<?php echo $row['WA_'];?>" placeholder="08XXX" maxlength="20" type="number" name="WA_">	
							</td>
							<td style="width:15%">						
							</td>
						</tr>
						<tr>
							<td align="left" style="width:25%">
								<b>Alamat</b>
							</td>
							<td align="center" style="width:5%">
								<b>:</b>
							</td>
							<td align="left">
								<textarea rows="4" cols="50" class="form-control form-control-sm" value="" id="alamat" placeholder="Alamat" maxlength="300" type="text" name="ALAMAT"><?php echo $row['ALAMAT'];?></textarea>
							</td>
							<td style="width:15%">						
							</td>
						</tr>
						<tr>
							<td align="left" style="width:25%">
								<b>Jabatan</b>
							</td>
							<td align="center" style="width:5%">
								<b>:</b>
							</td>
							<td align="left">
								<select name="LEVELX" id="LEVELX" class="form-control form-control-sm">
                                       <option value="ACCOUNTING" <?php if($level=="ACCOUNTING") echo 'selected="selected"'; ?> >Accounting</option>
                                       <option value="ADMIN" <?php if($level=="ADMIN") echo 'selected="selected"'; ?> >Admin</option>
                                       <option value="OFFLINE STORE" <?php if($level=="OFFLINE STORE") echo 'selected="selected"'; ?> >Offline Store</option>
                                       <option value="ONLINE STORE" <?php if($level=="ONLINE STORE") echo 'selected="selected"'; ?> >Online Store</option>
                                       <option value="PURCHASING" <?php if($level=="PURCHASING") echo 'selected="selected"'; ?> >Purchasing</option>
                                       <option value="STAFF" <?php if($level=="STAFF") echo 'selected="selected"'; ?> >Staff</option>
                                       <option value="WAREHOUSE" <?php if($level=="WAREHOUSE") echo 'selected="selected"'; ?> >Warehouse</option>					   
                                    </select>		
							</td>
							<td style="width:15%">						
							</td>
						</tr>
						<tr>
							<td align="left" style="width:25%">
								<b>Password</b>
							</td>
							<td align="center" style="width:5%">
								<b>:</b>
							</td>
							<td align="left">
								<input type='password' id='password' maxlength="40" type="text" value="<?php echo $row['PASSWORD'];?>" name="PASSWORD" class="form-control form-control-sm">
							</td>
							<td style="width:15%">						
							</td>
						</tr>
						<tr>
							<td><br><br>
							</td>
						</tr>
						<tr>
							<td align="left" style="width:25%">
								<b></b>
							</td>
							<td align="right" colspan="2">
								<button style="width:60%" type="submit" class="btn btn-primary btn-lg" name="update_data_user">Update </button>	
							</td>
							<td style="width:15%">						
							</td>
						</tr>
					</div>
				</table>
				</div>
			</form>
			
			
			
         </div>
      </div>
	  <script>				
			function cek_update_user(){
				var cnama_lengkap = document.getElementById('nama_lengkap').value;
				var cnicname = document.getElementById('nicname').value;
				var ctgl_lahir = document.getElementById('tgl_lahir').value;
				var cwassap = document.getElementById('wassap').value;
				var calamat = document.getElementById('alamat').value;
				var cpassword = document.getElementById('password').value;
				
				if(cnama_lengkap == ''){
					alert('Nama Lengkap kosong...');
					document.getElementById('nama_lengkap').focus();
					return false;
				}
				else if(cnicname == ''){
					alert('Nickname kosong...');
					document.getElementById('nicname').focus();
					return false;
				}
				else if(ctgl_lahir == ''){
					alert('Tanggal Lahir kosong...');
					document.getElementById('tgl_lahir').focus();
					return false;
				}
				else if(cwassap == ''){
					alert('Whatsapp kosong...');
					document.getElementById('wassap').focus();
					return false;
				}
				else if(calamat == ''){
					alert('Alamat kosong...');
					document.getElementById('alamat').focus();
					return false;
				}
				else if(cpassword == ''){
					alert('Password kosong...');
					document.getElementById('password').focus();
					return false;
				}
				else{
					return confirm('Pilih OK untuk update user');         
				}
												
			}
		</script>		
		
	
		<script type="text/javascript">
			$(function() {
			  $(".tgl_transaksi").datepicker({
			    format: 'yyyy/mm/dd',
			    autoclose: true,
			    minViewMode: 3,
			    todayHighlight: true,
			  });
			});
		</script>
		<script type="text/javascript">
			$(function() {
			  $(".datepicker").datepicker({
			    format: 'yyyy-mm-dd',
			    autoclose: true,
			    todayHighlight: true,
			  });
			});
		</script>
   </body>
</html>