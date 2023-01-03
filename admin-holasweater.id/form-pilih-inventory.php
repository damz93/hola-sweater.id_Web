<html>
   <head>
      <script data-ad-client="ca-pub-5256228815542923" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <title>Pilih Inventory - S W E A T E R I N . M E</title>
      <link rel="shortcut icon" href="img/tokonline.png">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/freelancer.min.css">
        <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.min.js
            "></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
        <script data-ad-client="ca-pub-5256228815542923" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js">
		</script>	  
		 <style>
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
				else if ($_SESSION['level']!="OWNER" AND $_SESSION['level']!="SPV GUDANG" AND $_SESSION['level']!="GUDANG"){
					echo "<script>alert('Anda tidak memiliki akses.....');window.location.href='javascript:history.go(-1)';</script>";
				}
		?>
            <h1 align='center' style="background-color:#71b8e4;color:#FFFFFe">PILIH INVENTORY</h1>
            <h3 align='center' style="background-color:#1d7bb6;color:#FFFFee">- S W E A T E R I N . M E -</h3>
            <br>
            <a style="background-color:#1d7bb6;color:#FFFFFe" href="utama"> KE MENU UTAMA </a></br>
            <br>		
            <br>		
            <br>		
            <br>						           
			<table id="tabel1" class="table table-striped" border="1" cellpadding="0" cellspacing="1">
				<thead align="center">
				<tr align='center' class="table-info">		   
					<th><h1><a style="background-color:#71b8e4;color:#FFFFFe" href="form-inventory"> [[[ FORM INVENTORY ]]] </a></h1></th>
					<th><h1><a style="background-color:#71b8e4;color:#FFFFFe" href="form-log-inventory"> [[[ FORM LOG INVENTORY ]]] </a></h1></th>	
				</tr>
			</table>
        </div>
    </body>
</html>