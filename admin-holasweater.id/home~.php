<?php 
				error_reporting(0);
				session_start();					
				if($_SESSION['status']!="login"){
					echo "<script>alert('Anda belum login.....');window.location.href='index.php?pesan=belum_login';</script>";
				}
?>   
<!DOCTYPE html>
<html>
    <head>		
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <title>HOME - HOLASWEATER.ID</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="shortcut icon" href="img/hola_ic.png">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
      <link rel="stylesheet" href="css/journ_bootstrap.min.css">
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	  <style>
	  frame.a{
			padding-left: 30px;
			padding-top: 20px;
			padding-right: 0px;
			padding-bottom: 20px;
         }
			
		 </style>
   </head>
    <frameset cols="25%,*">
            <frame src="menu.php" name="kiri" noresize="noresize">
            <frame style="background-color:#d5d5d5" src="utama-neww" name="kanan" class="a">
    </frameset>
</html>