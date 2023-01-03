
<!DOCTYPE html>
<html>
   <head>
      
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>	  
	  <link rel="stylesheet" href="css/journ_bootstrap.min.css">
      <style>
		body, html {
			 height: 100%;
			 margin: 0;
			font-family: "Lato", sans-serif;
         }
	
		 div.ex1{
			padding-left: 50px;
			padding-top: 50px;
			padding-right: 30px;
			padding-bottom: 50px;
         }
		 div.user{
			padding-top: 100px;
			padding-left: 80px;
			width: 60%;
         }
		 h1{
			padding-top: 15px;			
         }
		 button{
			width:100%;
			background-color:#fa8d70;
         }
			img.responsive {
			  width: 100%;
			  max-width: 150px;
			  height: auto;
			}
			img {
			  opacity: 0.6;
			}

			img:hover {
			  opacity: 1.0;
			}
		 
	  </style>
	  
	  <style>
	  
		/* Fixed sidenav, full height */
		.sidenav {
		  width: 100%;
		  position: fixed;
		  z-index: 1;
		  top: 0;
		  left: 0;
		  background-color: #c1c1c1;
		  overflow-x: hidden;
		  padding-top: 20px;
		  padding-left: 40px;
		}

		/* Style the sidenav links and the dropdown button */
		.sidenav a, .dropdown-btn {
		  padding: 6px 8px 6px 16px;
		  text-decoration: none;
		  font-size: 18px;
		  color: #3a3838;
		  display: block;
		  border: none;
		  background: none;
		  width: 100%;
		  text-align: left;
		  cursor: pointer;
		  outline: none;
		}

		/* On mouse-over */
		
		
		.sidenav a:hover, .dropdown-btn:hover {
		  background-color: #73607c;
		  color:#ffffff;
		}
		.sidenav-nav > .active > a { 
			background-color: #73607c ; 
		}
		.sidenav a:active{
		  background-color: #73607c;
		  color:#ffffff;
		}
		.sidenav a:after{
		  background-color: #73607c;
		  color:#ffffff;
		}
		.sidenav btn{
		  background-color: #73607c;
		  color:#ffffff;
		}
		.sidenav btn:hover {
		  background-color: #fa8d70;
		  color:#ffffff;
		}
		/* Main content */
		.main {
		  margin-left: 200px; /* Same as the width of the sidenav */
		  font-size: 18px; /* Increased text to enable scrolling */
		  padding: 0px 10px;
		}

		/* Add an active class to the active dropdown button */
		.active {
		  background-color: #73607c;
		  color: #ffffff;
		}

		/* Dropdown container (hidden by default). Optional: add a lighter background color and some left padding to change the design of the dropdown content */
		.dropdown-container {
		  display: none;
		  background-color: #d3c3db;
		  padding-left: 8px;
		}

		/* Optional: Style the caret down icon */
		.fa-caret-down {
		  float: right;
		  padding-right: 8px;
		}

		/* Some media queries for responsiveness */
		@media screen and (max-height: 450px) {
		  .sidenav {padding-top: 15px;}
		  .sidenav a {font-size: 18px;}
		}
		.btn-danger {
			color: #fff;
			background-color: #fc8e6f;
			border-color: #fc8e6f; /*set the color you want here*/
		}
	  </style>
   </head>
   <body style="background-color: #c1c1c1;">   
	
		<div class="ex1">
			<ul class="nav flex-column">
			  <li class="dropdown">
				<a class="nav-link active" href="utama_new" target="kanan"><b>Home</b></a>				
			  </li>
			  <li class="nav-item">
				<a class="nav-link" href="form-stok" target="kanan"><b>Stok dan Barang Masuk</b></a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" href="form-stok-keluar" target="kanan"><b>Barang Keluar</b></a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" href="pemasukan_new.php" target="kanan"><b>Pemasukan</b></a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" href="form-pengeluaran" target="kanan"><b>Pengeluaran</b></a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" href="form-laporan" target="kanan"><b>Summary & Report</b></a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" href="form-user" target="kanan"><b>Preferences</b></a>
			  </li>
			</ul>   
		</div>
		
		   <?php 
				error_reporting(0);
				session_start();					
				if($_SESSION['status']!="login"){
					echo "<script>alert('Anda belum login.....');window.location.href='index.php?pesan=belum_login';</script>";                    
				}
				else{
			?>   
		<div class="sidenav">
			<h1 style="color:#73607c"> <b>holasweater.id</b></h1>
			<br>
		  <a class="nav-link active" href="utama-neww" target="kanan"><b>Home</b></a>	
		  <a class="nav-link" href="barang-masuk-neww" target="kanan"><b>Stok dan Barang Masuk</b></a>
		  <a class="nav-link" href="barang-keluar-neww" target="kanan"><b>Barang Keluar</b></a>
		  <a class="nav-link" href="pemasukan-neww" target="kanan"><b>Pemasukan</b></a>
		  <a class="nav-link" href="pengeluaran-neww" target="kanan"><b>Pengeluaran</b></a>
		  <a class="nav-link" href="laporan-neww" target="kanan"><b>Summary & Report</b></a>
		  <a class="nav-link" href="pengaturan-neww" target="kanan"><b>Preferences</b></a>
		  <button hidden class="dropdown-btn"><b>Dropdown</b>
			<i class="fa fa-caret-down"></i>
		  </button>
		  <div class="dropdown-container">
			<a href="#">Link 1</a>
			<a href="#">Link 2</a>
			<a href="#">Link 3</a>
		  </div>		
		</div>
		<div class="user" align="center">
		   <table style="width:100%;" border="0" class="#" cellpadding="2" cellspacing="2" align="center">
			  <tr>
				 <td style="width:20%;" align="center">
					<img src="img/user_.png" class="responsive" style="width:45%;display: block; margin: auto;">
				 </td>
			  </tr>
			  <tr>
				 <td align="center">
					<h5 style="color:#3a3838">
					   <b><?php echo $_SESSION['nama_lengkap']; ?></b>
					</h5>
					<h6 style="color:#3a3838">
					   <?php echo $_SESSION['level']; ?>
					</h6>
				 </td>
			  </tr>
			  <tr>
				 <td align="center" style="width:100%">
					<a href="logout" target="_BLANK" onclick="window.close();" class="butn"> <button type="button" class="btn btn-primary">Logout</button></a>					
				 </td>
			  </tr>
		   </table>
		</div>
		
		<script>
			/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
			var dropdown = document.getElementsByClassName("dropdown-btn");
			var i;

			for (i = 0; i < dropdown.length; i++) {
			  dropdown[i].addEventListener("click", function() {
			  this.classList.toggle("active");
			  var dropdownContent = this.nextElementSibling;
			  if (dropdownContent.style.display === "block") {
			  dropdownContent.style.display = "none";
			  } else {
			  dropdownContent.style.display = "block";
			  }
			  });
			}			
			</script>			
			
				<?php } ?>
		

	</body>
</html>