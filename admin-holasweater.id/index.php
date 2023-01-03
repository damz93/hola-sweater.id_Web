<?php
	error_reporting(0);
	ini_set('display_errors', 0);
	include("koneksi.php");
	session_start();
	
	?>
<html>
	<head>
		<title>HALAMAN LOGIN - HOLASWEATER.ID</title>
		<link rel="shortcut icon" href="img/hola_ic.png">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/journ_bootstrap.min.css">
		
		<style>body,html{
			height:100%;
			margin:0
			}
		.bg{
		//	background-image: url("img/bg_wood.png");
			background-color: #ebebeb;
			opacity:.9;
			height:80%;
			background-position:center;
			background-repeat:no-repeat;
			background-size:cover}
		</style>
		
	  <style>.header{
	    margin: auto;
                width: 100%;
                padding: 15px;
                text-align:center;
                color: #FFFFFF;
				height:auto;
                padding: 30px;
                background:#284d58 ;
			height:auto;
	  }
	  </style>
	  <style>.responsive{width:100%;max-width:420px;height:auto}</style>
	</head>
	<body>
		<div class="header">  
			<img src="http://holasweater.id/admin-holasweater.id/img/hola_trs.png" class="responsive" style="display: block; margin: auto;">						
			<br> 
		</div>
		<div class="bg">
		<br>
			<div id="login">
				<div class="container">
					<div id="login-row" class="row justify-content-center align-items-center">
						<div id="login-column" class="col-md-6">
							<div id="login-box" class="col-md-12">
								<form id="login-form" class="form" action="cek_login" autocomplete="off" method="post">
									<div class="table-responsive">
										<div class="form-group">
											<div class="container">
												<table border="0" style="background-color:#f4f4f4" class="table table-borderless" cellpadding="2" cellspacing="2" align=center>
													<div class="form-group">
														<tr>
															<td colspan="2">
																<div class="alert alert-secondary" style="background-color:#6bcdec" role="alert">
																	<h6 align="center" valign="middle" style="font-size:20pt;color:#f4f4f4"><b>L O G I N</b></h6>
																</div>
															</td>
														</tr>
														<!--<label for="username" class="text-info">Username:</label><br>-->
														<tr>
															<td colspan="2">
																<input type="text" name="username" id="username"  class="form-control form-control-sm" placeholder="Username" autofocus>													
															</td>
														</tr>
														<tr>
															<td colspan="2">
																<input type="password" name="password" id="password"  class="form-control form-control-sm" placeholder="Password">										
															</td>
														</tr>
														<tr>
															<td colspan="2">
																<select class="form-control" name="level">
																	<option selected>Pilih Departement</option>
																	<option value="ACCOUNTING">Accounting</option>
																	<option value="ADMIN">Admin</option>
																	<option value="OWNER">CEO</option>
																	<option value="OFFLINE STORE">Offline Store</option>
																	<option value="ONLINE STORE">Online Store</option>
																	<option value="PURCHASING">Purchasing</option>
																	<option value="STAFF">Staff</option>
																	<option value="WAREHOUSE">Warehouse</option>
																	<option value="WEB DEVELOPER">Web Developer</option>
																</select>
															</td>
														</tr>
														<tr>
															<td width="100%">
																<input type="submit" name="submit" class="btn btn-primary btn-block" value="Login">
															</td>
															<td hidden width="50%">
																<button type="reset" onclick="focuss()" class="btn btn-danger btn-block">Cancel</button>
															</td>
														</tr>
													</div>				
												</table>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script>
            function focuss() {
            	document.getElementById("username").focus();
            }
             
         </script>
	</body>
</html>