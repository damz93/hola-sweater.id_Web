<?php
	session_start();		
	if($_SESSION['status']!="login"){
		echo "<script>alert('Anda belum login.....');window.location.href='index?pesan=belum_login';</script>";                    
	}			
	else{
		$username = $_SESSION['username'];
		$tgl_hari_inii = date('Y-m-d');
		//$tgl_lengk = date('l, d-m-Y');
		$tgl_lengk =  date('l, d F Y');
		$tahun = date('Y');
		$bulan = date('m');
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/journ_bootstrap.min.css">
		<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
		<script src="js/bootstrap-datepicker.js"></script>
		<link rel="stylesheet" href="css/datepicker.css">
	   
		<style type="text/css">
		#kiri
			{
			width:40%;				
			height:200px;
			padding: 0px;
			float:left;
			}
			#kanan
			{
			width:60%;
			height:200px;
			padding: 0px;
			float:right;
			}
		body {
			padding-left: 80px;
			padding-top: 40px;
			padding-right: 30px;
			padding-bottom: 20px;
			background-color: #d5d5d5;
			}
			.active, .collapsible:hover {
			background-color: #555;
			color: #73607c;
			}
			.collapsible:after {
			color: #ffffff;
			font-weight: bold;
			float: right;
			margin-left: 5px;
			}
			.active:after {
		//	content: "\2212";
			color: #ffffff;
			}
			.collapsible {
			background-color: #d5d5d5;
			font-color: #3a3838;
			cursor: pointer;
			padding: 5px;
			width: 100%;
			border: none;
			outline: none;
			}
			.active, .collapsible:hover {
			background-color: #e7e7e7;
			border: none;
			outline: none;
			border-size: 0px;
			}
			.content {
			padding-top: 0px;
			padding-right: 10px;
			padding-bottom: 5px;
			padding-left: 20px;
			height: 90px;
//			overflow-y: scroll;
			display: none;
			background-color: #c1c1c1;
			}
			/* Style the tab */
			
		</style>
	</head>
<body>
	<?php
		include "koneksi.php";
		$penjualan  = mysqli_query($koneksi, "select SUM(QTY) AS TOT_QTY, SUM(COSTUM) AS TOT_CS from  t_pemasukan2 where MONTH(TGL)='$bulan' AND YEAR(TGL)='$tahun'");
			while($data = mysqli_fetch_array($penjualan)){
							$pcs_trjual = $data['TOT_QTY'];							
							$pcs_trjual = number_format($pcs_trjual,0,',','.');	
							$tot_cos = $data['TOT_CS'];							
							$tot_cost = number_format($tot_cos,0,',','.');	
						}
		$sisa  = mysqli_query($koneksi, "select SUM(QTY) AS TOT_QTY from t_stok WHERE QTY>0");
			while($dat2a = mysqli_fetch_array($sisa)){
							$sisa2 = $dat2a['TOT_QTY'];							
							$sisa_ = number_format($sisa2,0,',','.');	
						}
		$home  = mysqli_query($koneksi, "select * from t_home ORDER BY ID DESC LIMIT 1");
			while($dhome = mysqli_fetch_array($home)){
							$target = $dhome['TARGET'];							
							$kata = $dhome['KATA'];							
							$target_ = number_format($target,0,',','.');	
						}
	?>
	<table style="width:85%" border="0" align="left" cellpadding="0" cellspacing="0">
		
		<tr>
			<td align="left" colspan="2">
				<img src="img/welcome.png" align="left"/></br><p style="font-size:24pt;color:#2d2d2d;text-align:left;font-weight:bold;">&nbsp<?php echo $username; ?></p>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<textarea style="width:100%;font-weight:bold;background-color:#c1c1c1;color:#73607c;font-size:18pt" class="form-control form-control-sm" rows="8" readonly="readonly" cols="4" name="t_area_deks" id="t_area_deks"><?php echo $kata; ?></textarea>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="right"><br>
				<p style="color:#73607c;font-size:14pt;font-weight:bold"><?php echo $tgl_lengk;?></p>
			<td>
		</tr>
		<tr>
			<td align="center" width="100%">
				<button id="btn_intip" type="button" class="collapsible"><p style="font-size:16pt;text-align:center;color:#533f5c"><b>&darr; &nbsp Intip Pencapaian Hari ini Yuk &nbsp &darr;</b></p></button>
				<div class="content">
					<table style="width:95%" border="0" align="center" cellpadding="0" cellspacing="0">
						<tr>
							<td>
								<br>
							</td>
						</tr>
						<tr>
							<td><b>Total Penjualan PCS
							</td>
							<td width="5%"><b>:
							</td>
							<td align="right"><b>
								<?php echo $pcs_trjual; ?>
							</td>
							<td width="20%">
							</td>
							<td><b>Sisa Barang Ready
							</td>
							<td width="5%"><b>:
							</td>
							<td align="right"><b>
								<?php echo $sisa_; ?>
							</td>
						</tr>
						<tr>
							<td><b>Total Costum Sablon
							</td>
							<td width="5%"><b>:
							</td>
							<td align="right"><b>
								<?php echo $tot_cost; ?>
							</td>
							<td width="20%">
							</td>
							<td><b>Target Bulanan
							</td>
							<td width="5%"><b>:
							</td>
							<td align="right"><b>
								<?php echo $target_; ?>
							</td>
						</tr>
					</table>
				</div>
			</td>
		</tr>			
	</table>

	<script>
			var coll = document.getElementsByClassName("collapsible");
			var i;
			
			for (i = 0; i < coll.length; i++) {
			  coll[i].addEventListener("click", function() {
				this.classList.toggle("active");
				var content = this.nextElementSibling;
				if (content.style.display === "block") {
				  content.style.display = "none";
				} else {
				  content.style.display = "block";
				}
			  });
			}
		</script>
</body>
</html>		