<?php
	error_reporting(0);
	ini_set('display_errors', 0);
	include("koneksi.php");
	session_start();
	
	?>
<html>
	<head>
		<title>Halaman Login - S W E A T E R I N . M E</title>
		<link rel="shortcut icon" href="img/tokonline.png">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/freelancer.min.css">
		<script data-ad-client="ca-pub-5256228815542923" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
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
			<div class="text-center">
				<img align="center" src="img/sweatrin.png" class="img-thumbnail" alt="Cinque Terre" width="450" height="450"> 				
			</div>
			<?php/*
				if (isset($_GET['pesan'])) {
				    if ($_GET['pesan'] == "gagal") {
				        echo "<h6 align=center>Login gagal! username dan password salah!</h6>";
				    } else if ($_GET['pesan'] == "logout") {
				        echo "<h6 align=center>Anda telah berhasil logout</h6>";
				    } else if ($_GET['pesan'] == "belum_login") {
				        echo "<h6 align=center>Anda harus login untuk mengakses halaman admin</h6>";
				    }
				}*/
				?>
			<div id="login">
				<div class="container">
					<div id="login-row" class="row justify-content-center align-items-center">
						<div id="login-column" class="col-md-6">
							<div id="login-box" class="col-md-12">
								<form id="login-form" class="form" action="cek_login" autocomplete="off" method="post">
									<div class="table-responsive">
										<div class="form-group">
											<div class="container">
												<table border="0" class="table" cellpadding="2" cellspacing="2" align=center>
													<div class="form-group">
														<tr>
															<td colspan="2">
																<div class="alert alert-primary" role="alert">
																	<p align="center" valign="center"><b>L O G I N</b></p>
																</div>
															</td>
														</tr>
														<!--<label for="username" class="text-info">Username:</label><br>-->
														<tr>
															<td colspan="2">
																<input type="text" name="username" id="username"  class="form-control form-control-sm" placeholder="Username" autofocus>													
															</td>
														</tr>
														<!--<label for="password" class="text-info">Password:</label><br>-->
														<tr>
															<td colspan="2">
																<input type="password" name="password" id="password"  class="form-control form-control-sm" placeholder="Password">										
															</td>
														</tr>
														<tr>
															<td colspan="2">
																<select class="form-control" name="level">
																	<option selected>Pilih Departement</option>
																	<option value="KASIR">Kasir</option>
																	<option value="OWNER">Owner</option>
																	<option value="SPV KASIR">SPV Kasir</option>						
																</select>
															</td>
														</tr>
														<tr>
															<td width="50%">
																<!--     <label for="remember-me" class="text-info"><span>Remember me</span> <span><input id="remember-me" name="remember-me" type="checkbox"></span></label><br>-->
																<input type="submit" name="submit" class="btn btn-info btn-block" value="Login">
															</td>
															<td width="50%">
																<button type="reset" onclick="focuss()" class="btn btn-danger btn-block">Cancel</button>
															</td>
														</tr>
													</div>
													<!--  <div id="register-link" class="text-right">
														<a href="#" class="text-info">Register here</a>
														</div>-->															
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