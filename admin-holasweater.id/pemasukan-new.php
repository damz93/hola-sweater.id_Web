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
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="css/journ_bootstrap.min.css">
		<title>PEMASUKAN - HOLASWEATER.ID</title>
		<link rel="shortcut icon" href="img/hola_ic.png">
		<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
		<script src="js/bootstrap-datepicker.js"></script>
		
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="css/datepicker.css">
		<link rel="stylesheet" href="css/css-terpakai.css">		
		<style>
			.contentx {
			padding-top: 15px;
			padding-right: 30px;
			padding-bottom: 10px;
			padding-left: 40px;
			height: 420px;
			overflow-y: scroll;
			display: none;
			background-color: #f1f1f1;
			}
			
			
			.active, .collapsible:hover {
			background-color: #555;
			color: #284d58;
			}
			.collapsible:after {
	//		content: '\002B';
			color: #284d58;
			font-weight: bold;
			float: right;
			margin-left: 5px;
			}
			.active:after {
		//	content: "\2212";
			color: #284d58;
			}
			.collapsible {
			background-color: #d5d5d5;
			font-color: #3a3838;
			cursor: pointer;
			padding: 10px;
			width: 100%;
			text-align: right;
			border: none;
			outline: none;
			font-size: 12px;
			}
			.active, .collapsible:hover {
			background-color: #e8e8e8;
			border: none;
			outline: none;
			border-size: 0px;
			}
		</style>
	</head>
	<body>
		<div class="sidebar">
			<img align="center" style="display: block; margin: auto;height:50px;" src="http://holasweater.id/admin-holasweater.id/img/hola_trs.png" alt="logo">
			<br>
			<a class="nav-link" href="menu-utama"><b>Home</b></a>
			<a class="nav-link" href="barang-masuk-new"><b>Stok dan Barang Masuk</b></a>
			<a class="nav-link" href="barang-keluar-new"><b>Barang Keluar</b></a>
			<a class="active" href="pemasukan-new"><b>Pemasukan</b></a>
			<a class="nav-link" href="pengeluaran-new"><b>Pengeluaran</b></a>
			<a class="nav-link" href="laporan-new"><b>Summary & Report</b></a>
			<a class="nav-link" href="pengaturan-new"><b>Preferences</b></a>
			<div class="user" align="center" hidden>
				<table style="padding-bottom:30px" class="responsive" style="width:100%;" border="0" cellpadding="2" cellspacing="2" align="center">
					<tr>
						<td style="width:20%;" align="center">
							<img src="http://holasweater.id/admin-holasweater.id/img/user_.png" class="responsive" style="height:60px;display: block; margin: auto;">
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
						<td align="center">	<button type="button" class="btn btn-primary btn-sm"><a href="logout" style="color:#FFFFFe">Logout</button></a>
						</td>
					</tr>
				</table>
			</div>
		</div>
		<div class="content">
		<?php
					error_reporting(0);
				include 'koneksi.php';
				session_start();		
				$tgl_hari_ini = date('d F Y');	
				//$tgl_hari_inii = date('yyyy-mm-dd');
				$tgl_hari_inii = date("Y/m/d");
				
		
				
				$data_pemasukan = mysqli_query($koneksi,"select max(ID) as ID from t_pemasukan2");
				 while($d = mysqli_fetch_array($data_pemasukan)){
					$jummasuk        = $d['ID'];					
				 }
				if ($jummasuk == 0) {
					$kode_pemasukan = "INC-00000000001";
				}
				else{
					$jummasuk++;			
					if (strlen($jummasuk)== 1){
						$kode_pemasukan = "INC-00000000000".$jummasuk;				
					}
					else if (strlen($jummasuk)== 2){
						$kode_pemasukan = "INC-0000000000".$jummasuk;
					}
					else if (strlen($jummasuk)== 3){
						$kode_pemasukan = "INC-000000000".$jummasuk;
					}
					else if (strlen($jummasuk)== 4){
						$kode_pemasukan = "INC-00000000".$jummasuk;
					}
					else if (strlen($jummasuk)== 5){
						$kode_pemasukan = "INC-0000000".$jummasuk;
					}
					else if (strlen($jummasuk)== 6){
						$kode_pemasukan = "INC-000000".$jummasuk;
					}
					else if (strlen($jummasuk)== 7){
						$kode_pemasukan = "INC-00000".$jummasuk;
					}
					else if (strlen($jummasuk)== 8){
						$kode_pemasukan = "INC-0000".$jummasuk;
					}
					else if (strlen($jummasuk)== 9){
						$kode_pemasukan = "INC-000".$jummasuk;
					}
					else if (strlen($jummasuk)== 10){
						$kode_pemasukan = "INC-00".$jummasuk;
					}
					else if (strlen($jummasuk)== 11){
						$kode_pemasukan = "INC-0".$jummasuk;
					}
					else if (strlen($jummasuk)== 12){
						$kode_pemasukan = "INC-".$jummasuk;
					}
				}
				?> <h2 style="color:#284d58">Pemasukan</h2>
    <p hidden>Click on the buttons inside the tabbed menu:</p>
    <div class="tab">
	<?php
			if ($_SESSION['level']!="OWNER" AND $_SESSION['level']!="ADMIN" AND $_SESSION['level']!="OWNER"){
				  echo "<script>document.getElementById('btn_history').click();</script>";
			}
			else{
			?>
      <button class="tablinks" onclick="kategori_pemasukan(event, 'online')">
        <h5><b>Online</b></h5>
      </button>
      <button class="tablinks" onclick="kategori_pemasukan(event, 'offline')">
        <h5><b>Offline</b></h5>
      </button>
      <button class="tablinks" onclick="kategori_pemasukan(event, 'reseller')">
        <h5><b>Reseller</b></h5>
      </button>
			<?php } ?>
      <button class="tablinks active" onclick="kategori_pemasukan(event, 'history')">
      <h5>  <b>History Pemasukan</b></h5>
      </button>
    </div>
    <div id="online" class="tabcontent">
      <h4 style="color:#284d58">Input Pemasukan Online Store</h3>
      <br>
      <br>
	  <div class="kirkan">
      <form method="post" action="simpan-pemasukan.php" autocomplete="off" onsubmit="return sebelum1()">
        <table class="table table-borderless" style="width:100%" border="0" cellpadding="2" cellspacing="2" align="left">
          <tr>
            <th>Kode Pemasukan</th>
            <td width="5%">:</td>
            <td colspan="2">
              <label name="KODE_PEMASUKANx" id="kode_pemasukanx" style="color:black;font-size:12pt">
                <b> <?php echo $kode_pemasukan ?> </b>
                <label>
				<input hidden class="form-control form-control-sm" readonly maxlength="30" type="text" name="KODE_PEMASUKAN" value="<?php echo $kode_pemasukan ?>">
            </td>
          </tr>
          <tr>
            <th>Tanggal</th>
            <td width="5%">:</td>
            <td colspan="2">
              <label name="tgl_hari_ini" id="tgl_hari_ini" style="color:black;font-size:12pt">
                <b> <?php echo $tgl_hari_ini ?> </b>
                <label>
            </td>
          </tr>
          <tr>
            <th colspan="3" align="left">
              <h4 style="color:#000000">Rincian Pemasukan</h4>
            </th>
          </tr>
          <tr hidden>
            <th>&nbsp &nbsp Sumber Dana</th>
            <td width="5%"></td>
            <td>
              <select class="form-control form-control-sm" name="JENIS" id="jenis" onchange="autofocus2()" autofocus>
                <option value="TIKTOK SHOP">Tiktok Shop</option>
                <option value="TIKTOK SHOP AFILIATE">Tiktok Shop Afiliate</option>
                <option value="SHOPEE">Shopee</option>
              </select>
            </td>
          </tr>
          
          <tr>
            <th>&nbsp &nbsp Sumber Dana</th>
            <td width="5%"></td>
            <td>
              <select class="form-control form-control-sm" name="JENIS" id="jenis" onchange="autofocus2()" autofocus>
               <?php
									include "koneksi.php";
									$data = mysqli_query($koneksi,"select KATEGORI from t_kategori_pemasukan order by KATEGORI ASC");
									while($d = mysqli_fetch_array($data)){
										$kat = $d['KATEGORI'];
										echo '<option value="'.$kat.'">'.$kat.'</option>';
									}							
									?>
              </select>
            </td>
			<td width="10%" align="left"> <a href="#"><img src="img/pluss.png" width="40" height="40" data-toggle="modal" data-target="#contact-modal"></a></td>
          </tr>
          <tr>
            <th colspan="3" align="left">&nbsp &nbsp Jumlah Terjual</th>
          </tr>
          <tr>
            <th>&nbsp &nbsp &nbsp &nbsp PCS</th>
            <td width="5%" align="right"></td>
            <td colspan="2">
              <input type="text" value="0" id="qty" class="form-control form-control-sm mata-uang" onkeyup="inputTerbilang();" name="QTY">
            </td>
          </tr>
          <tr>
            <th>&nbsp &nbsp &nbsp &nbsp Costum</th>
            <td width="5%" align="right"></td>
            <td colspan="2">
              <input type="text" value="0" id="costum" class="form-control form-control-sm mata-uang" onkeyup="inputTerbilang();" name="COSTUM">
            </td>
          </tr>
          <tr>
            <th>&nbsp &nbsp Pembayaran Diterima</th>
            <td width="5%" align="right">
              <label>Rp</label>
            </td>
            <td colspan="2">
              <input type="text" value="0" id="total_pembayaran" class="form-control form-control-sm mata-uang" onkeyup="inputTerbilang();" name="TOTAL_PEMBAYARAN">
              </th>
          </tr>
          <tr>
            <th>&nbsp &nbsp Oleh</th>
            <td width="5%"></td>
            <td colspan="2">
              <input class="form-control form-control-sm" id="dari1" placeholder="Dari" maxlength="120" type="text" name="DARI">
              </th>
          </tr>
          <tr>
            <th>&nbsp &nbsp Catatan</th>
            <td width="5%"></td>
            <td colspan="2">
              <textarea rows="4" cols="50" class="form-control form-control-sm" id="keterangan1" placeholder="Catatan" maxlength="300" type="text" name="KETERANGAN"></textarea>
              </th>
          </tr>
          <tr hidden>
            <th>Tanggal Transaksi</th>
            <td width="5%"></td>
            <td colspan="2">
              <input autofocus placeholder="Tanggal Transaksi(dd/MM/yyyy)" class="form-control form-control-sm datepicker" maxlength="30" type="text" name="tgl_transaksi" value="<?php echo $tgl_hari_inii; ?>" id="tgl_transaksi">
            </td>
          </tr>
          <tr>
            <td>
              <br>
            </td>
          </tr>
          <tr hidden>
            <th>Payment Method</th>
            <td width="5%"></td>
            <td colspan="2">
              <input class="form-control form-control-sm" id="payment4" placeholder="Transfer, EDC, Tunai ...." maxlength="120" type="text" name="PAYMENT4">
              </th>
          </tr>
          <tr hidden>
            <th>Payment Method</th>
            <td width="5%"></td>
            <td colspan="2">
              <select class="form-control form-control-sm" name="PAYMENT" id="payment" onchange="autofocus3()" autofocus>
                <option value="EDC">EDC</option>
                <option value="TRANSFER" selected>Transfer</option>
                <option value="TUNAI">Tunai</option>
              </select>
              </th>
          </tr>
          <tr hidden>
            <th>No. Ref Pembayaran</th>
            <td width="5%"></td>
            <td colspan="2">
              <input value="0" class="form-control form-control-sm" id="noref" placeholder="No-Ref" maxlength="120" type="text" name="NOREF">
              </th>
          </tr>
          <tr align='center'>
            <td colspan="2">
			
              <button onclick="autofocuss()" type="reset" class="btn btn-secondary btn-sm btn-block">Batal</button>
              </td>
            <td colspan="2">
			  <button type="submit" value="simpan" class="btn btn-primary btn-sm btn-block">Proses</button>
			  
          </tr>
          </tr>
        </table>
      </form>
    </div>
    </div>
    <div id="offline" class="tabcontent">
      <h4 style="color:#284d58">Input Pemasukan Offline Store</h3>
      <br>
      <br>
	  <div class="kirkan">
      <form method="post" action="simpan-pemasukan.php" autocomplete="off" onsubmit="return sebelum2()">
        <table class="table table-borderless" style="width:100%" border="0" cellpadding="2" cellspacing="2" align="left">
          <tr>
            <th>Kode Pemasukan</th>
            <td width="5%">:</td>
            <td colspan="2">
              <label name="KODE_PEMASUKANx" id="kode_pemasukanx" style="color:black;font-size:12pt">
                <b> <?php echo $kode_pemasukan ?> </b>
                <label>
				<input hidden class="form-control form-control-sm" readonly maxlength="30" type="text" name="KODE_PEMASUKAN" value="<?php echo $kode_pemasukan ?>">
            </td>
          </tr>
          <tr>
            <th>Tanggal</th>
            <td width="5%">:</td>
            <td colspan="2">
              <label name="tgl_hari_ini" id="tgl_hari_ini" style="color:black;font-size:12pt">
                <b> <?php echo $tgl_hari_ini ?> </b>
                <label>
            </td>
          </tr>
          <tr>
            <th colspan="3" align="left">
              <h4 style="color:#000000">Rincian Pemasukan</h4>
            </th>
          </tr>
          <tr>
            <th>&nbsp &nbsp Sumber Dana</th>
            <td width="5%"></td>
            <td colspan="2">
			  <label name="JENISx" id="jenisx" style="color:black;font-size:12pt">
                <b>Offline Store</b>
                <label>
			  <input hidden class="form-control form-control-sm" readonly maxlength="30" type="text" name="JENIS" value="OFFLINE STORE">
            </td>
          </tr>
          <tr>
            <th colspan="3" align="left">&nbsp &nbsp Jumlah Terjual</th>
          </tr>
          <tr>
            <th>&nbsp &nbsp &nbsp &nbsp PCS</th>
            <td width="5%" align="right"></td>
            <td colspan="2">
              <input type="text" value="0" id="qty" class="form-control form-control-sm mata-uang" onkeyup="inputTerbilang();" name="QTY">
            </td>
          </tr>
          <tr>
            <th>&nbsp &nbsp &nbsp &nbsp Costum</th>
            <td width="5%" align="right"></td>
            <td colspan="2">
              <input type="text" value="0" id="costum" class="form-control form-control-sm mata-uang" onkeyup="inputTerbilang();" name="COSTUM">
            </td>
          </tr>
          <tr>
            <th>&nbsp &nbsp Pemasukan Transfer</th>
            <td width="5%" align="right">
              <label>Rp</label>
            </td>
            <td colspan="2">
              <input type="text" value="0" id="pem_trf" class="form-control form-control-sm mata-uang" onkeyup="total_kembali();" name="PEM_TRF">
              </th>
          </tr>
          <tr>
            <th>&nbsp &nbsp Pemasukan EDC</th>
            <td width="5%" align="right">
              <label>Rp</label>
            </td>
            <td colspan="2">
              <input type="text" value="0" id="pem_edc" class="form-control form-control-sm mata-uang" onkeyup="total_kembali();" name="PEM_EDC">
              </th>
          </tr>
          <tr>
            <th>&nbsp &nbsp Setoran Tunai</th>
            <td width="5%" align="right">
              <label>Rp</label>
            </td>
            <td colspan="2">
              <input type="text" value="0" id="pem_tni" class="form-control form-control-sm mata-uang" onkeyup="total_kembali();" name="PEM_TNI">
              </th>
          </tr>
          <tr>
            <th>&nbsp &nbsp Pembayaran Diterima</th>
            <td width="5%" align="right">              
            </td>
            <td colspan="2">
              <input hidden type="text" value="0" id="total_pembayaran_ofl" class="form-control form-control-sm mata-uang" onkeyup="inputTerbilang();" name="TOTAL_PEMBAYARAN">:
			  <b><label style="font-size:20pt;" name="totalnya" id="totalnya">Rp0</label></b>
              </th>
          </tr>
          <tr>
            <th>&nbsp &nbsp Terima Dari</th>
            <td width="5%"></td>
            <td colspan="2">
              <input class="form-control form-control-sm" id="dari2" placeholder="Dari" maxlength="120" type="text" name="DARI">
              </th>
          </tr>
          <tr>
            <th>&nbsp &nbsp Catatan</th>
            <td width="5%"></td>
            <td colspan="2">
              <textarea rows="4" cols="50" class="form-control form-control-sm" id="keterangan2" placeholder="Catatan" maxlength="300" type="text" name="KETERANGAN"></textarea>
              </th>
          </tr>
          <tr hidden>
            <th>Tanggal Transaksi</th>
            <td width="5%"></td>
            <td colspan="2">
              <input autofocus placeholder="Tanggal Transaksi(dd/MM/yyyy)" class="form-control form-control-sm datepicker" maxlength="30" type="text" name="tgl_transaksi" value="<?php echo $tgl_hari_inii; ?>" id="tgl_transaksi">
            </td>
          </tr>
          <tr>
            <td>
              <br>
            </td>
          </tr>
          <tr hidden>
            <th>Payment Method</th>
            <td width="5%"></td>
            <td colspan="2">
              <input class="form-control form-control-sm" id="payment4" placeholder="Transfer, EDC, Tunai ...." maxlength="120" type="text" name="PAYMENT4">
              </th>
          </tr>
          <tr hidden>
            <th>Payment Method</th>
            <td width="5%"></td>
            <td colspan="2">
              <select class="form-control form-control-sm" name="PAYMENT" id="payment" onchange="autofocus3()" autofocus>
                <option value="EDC">EDC</option>
                <option value="TRANSFER" selected>Transfer</option>
                <option value="TUNAI">Tunai</option>
              </select>
              </th>
          </tr>
          <tr hidden>
            <th>No. Ref Pembayaran</th>
            <td width="5%"></td>
            <td colspan="2">
              <input value="0" class="form-control form-control-sm" id="noref" placeholder="No-Ref" maxlength="120" type="text" name="NOREF">
              </th>
          </tr>
          <tr align='center'>
            <td colspan="2">
			
              <button onclick="autofocuss()" type="reset" class="btn btn-secondary btn-sm btn-block">Batal</button>
              </td>
            <td colspan="2">
			  <button type="submit" value="simpan" class="btn btn-primary btn-sm btn-block">Proses</button>
			  
          </tr>
          </tr>
        </table>
      </form>
	  </div>
    </div>
    <div id="reseller" class="tabcontent">
      <h4 style="color:#284d58">Input Pemasukan Reseller</h3>
      <br>
      <br>
	  <div class="kirkan">
		  <form method="post" action="simpan-pemasukan.php" autocomplete="off" onsubmit="return sebelum3()">
			<table class="table table-borderless" style="width:100%" border="0" cellpadding="2" cellspacing="2" align="left">
			  <tr>
				<th>Kode Pemasukan</th>
				<td width="5%">:</td>
				<td colspan="2">
				  <label name="KODE_PEMASUKANx" id="kode_pemasukanx" style="color:black;font-size:12pt">
					<b> <?php echo $kode_pemasukan ?> </b>
					<label>
					<input hidden class="form-control form-control-sm" readonly maxlength="30" type="text" name="KODE_PEMASUKAN" value="<?php echo $kode_pemasukan ?>">
				</td>
			  </tr>
			  <tr>
				<th>Tanggal</th>
				<td width="5%">:</td>
				<td colspan="2">
				  <label name="tgl_hari_ini" id="tgl_hari_ini" style="color:black;font-size:12pt">
					<b> <?php echo $tgl_hari_ini ?> </b>
					<label>
				</td>
			  </tr>
			  <tr>
				<th colspan="3" align="left">
				  <h4 style="color:#000000">Rincian Pemasukan</h4>
				</th>
			  </tr>
			  <tr>
				<th>&nbsp &nbsp Sumber Dana</th>
				<td width="5%"></td>
				<td colspan="2">
				  <label name="JENISx" id="jenisx" style="color:black;font-size:12pt">
					<b>Reseller</b>
					<label>
				  <input hidden class="form-control form-control-sm" readonly maxlength="30" type="text" name="JENIS" value="RESELLER">
				</td>
			  </tr>
				<th colspan="3" align="left">&nbsp &nbsp Jumlah Terjual</th>
			  </tr>
			  <tr>
				<th>&nbsp &nbsp &nbsp &nbsp PCS</th>
				<td width="5%" align="right"></td>
				<td colspan="2">
				  <input type="text" value="0" id="qty" class="form-control form-control-sm mata-uang" onkeyup="inputTerbilang();" name="QTY">
				</td>
			  </tr>
			  <tr>
				<th>&nbsp &nbsp &nbsp &nbsp Costum</th>
				<td width="5%" align="right"></td>
				<td colspan="2">
				  <input type="text" value="0" id="costum" class="form-control form-control-sm mata-uang" onkeyup="inputTerbilang();" name="COSTUM">
				</td>
			  </tr>
			  <tr>
				<th>&nbsp &nbsp Pembayaran Diterima</th>
				<td width="5%" align="right">
				  <label>Rp</label>
				</td>
				<td colspan="2">
				  <input type="text" value="0" id="total_pembayaran" class="form-control form-control-sm mata-uang" onkeyup="inputTerbilang();" name="TOTAL_PEMBAYARAN">
				  </th>
			  </tr>
			  <tr>
				<th>&nbsp &nbsp Terima Dari</th>
				<td width="5%"></td>
				<td colspan="2">
				  <input class="form-control form-control-sm" id="dari3" placeholder="Dari" maxlength="120" type="text" name="DARI">
				  </th>
			  </tr>
			  <tr>
				<th>&nbsp &nbsp Catatan</th>
				<td width="5%"></td>
				<td colspan="2">
				  <textarea rows="4" cols="50" class="form-control form-control-sm" id="keterangan3" placeholder="Catatan" maxlength="300" type="text" name="KETERANGAN"></textarea>
				  </th>
			  </tr>
			  <tr hidden>
				<th>&nbsp &nbsp Tanggal Transaksi</th>
				<td width="5%"></td>
				<td colspan="2">
				  <input autofocus placeholder="Tanggal Transaksi(dd/MM/yyyy)" class="form-control form-control-sm datepicker" maxlength="30" type="text" name="tgl_transaksi" value="<?php echo $tgl_hari_inii; ?>" id="tgl_transaksi">
				</td>
			  </tr>
			  <tr>
				<td>
				  <br>
				</td>
			  </tr>
			  <tr hidden>
				<th>Payment Method</th>
				<td width="5%"></td>
				<td colspan="2">
				  <input class="form-control form-control-sm" id="payment4" placeholder="Transfer, EDC, Tunai ...." maxlength="120" type="text" name="PAYMENT4">
				  </th>
			  </tr>
			  <tr hidden>
				<th>Payment Method</th>
				<td width="5%"></td>
				<td colspan="2">
				  <select class="form-control form-control-sm" name="PAYMENT" id="payment" onchange="autofocus3()" autofocus>
					<option value="EDC">EDC</option>
					<option value="TRANSFER" selected>Transfer</option>
					<option value="TUNAI">Tunai</option>
				  </select>
				  </th>
			  </tr>
			  <tr hidden>
				<th>No. Ref Pembayaran</th>
				<td width="5%"></td>
				<td colspan="2">
				  <input value="0" class="form-control form-control-sm" id="noref" placeholder="No-Ref" maxlength="120" type="text" name="NOREF">
				  </th>
			  </tr>
			  <tr align='center'>
				<td colspan="2">
				
				  <button onclick="autofocuss()" type="reset" class="btn btn-secondary btn-sm btn-block">Batal</button>
				  </td>
				<td colspan="2">
				  <button type="submit" value="simpan" class="btn btn-primary btn-sm btn-block">Proses</button>
				  
			  </tr>
			  </tr>
			</table>
		  </form>
		</div>
    </div>
    <div style="display: block;" id="history" class="tabcontent">
      <h4 style="color:#284d58">History Pemasukan</h3>
      <br>
      <br>
	  
	  				<div class="table-responsive">
      <table id="tabel1" class="table table-hover" border="0" cellpadding="0" cellspacing="1">
        <thead align="center">
          <tr style="background-color:#585657;color:#FFFFFF;" align='center'>
            <th>No.</th>
            <!--<th>KODE PEMASUKAN</th>			 -->
            <th>Tanggal Input</th>
            <th>Sumber Pemasukan</th>
            <th>PCS Terjual</th>
            <th>Pembayaran</th>
            <th>Terima Dari</th>
            <th>Action</th>
          </tr>
        </thead> <?php 
            include 'koneksi.php';
            $no=1;
			 function formatTanggal($date){
                    // ubah string menjadi format tanggal
                    return date('d-M-Y', strtotime($date));
                    }	
            $data = mysqli_query($koneksi,"select * from t_pemasukan2 order by ID DESC");
            while($d = mysqli_fetch_array($data)){
				//$tgl = $d['WAKTU'];
				//$tgl = formatTanggal($d['TGL']);  
				$date_ = date_create($d['TGL']);
				$tgl2 = date_format($date_,'d-m-y');  
				//$tgl2 = date_format($d['TGL'],'d-M-Y');  
				//date_format($date,"d/m/Y");
                $hari = date('l', strtotime($d['TGL']));
                $semua = $hari.", ".$tgl;
				$tgl_tamp = substr($tgl,0,10);
				$kod_inp = $d['KODE_TRANSAKSI'];				
				$jenis = $d['JENIS'];
				$dari = $d['DARI'];
				$tott = $d['TOTAL'];		            
            	$tott_tamp = "Rp".number_format($tott,0,",",".");				
				$paymn = $d['PAYMENT'];
				$noref = $d['NOREF'];
				$notes= $d['NOTES'];				
				$cost = $d['COSTUM'];
				$costtamp = number_format($cost,0,",",".");
				$qty = $d['QTY'];
				$cost = $d['COSTUM'];
				$tot_qc = $qty + $cost;
				$tot_qc_tamp = number_format($tot_qc,0,",",".");
				//$qtytamp = number_format($qty,0,",",".");
				$keter = $d['NOTES'];			
				
            	?> 
			<tr align='center'>
			
			  <td> <?php echo $no++; ?> </td>
			  <!--<td><?php echo $kod_inp; ?></td>-->
			  <td> <?php echo $tgl2; ?> </td>
			  <td> <?php echo $jenis; ?> </td>
			  <td> <?php echo $tot_qc_tamp; ?> </td>
			  <td align='right'> <?php echo $tott_tamp; ?> </td>
			  <td align='left'> <?php echo $dari; ?> </td>
			  <td>				
				<a target="_BLANK" href='detail-pemasukan-new?kode_input=<?php echo $kod_inp; ?>' title="Lihat Detail Pemasukan" onclick="return confirm('Pilih OK untuk melihat detail...')">
				  <img src="img/show.png" height="100%">
				</a>|
				<a href='hapus-pemasukan?kode_input=<?php echo $kod_inp; ?>' title="Hapus Pemasukan" onclick="return confirm('Pilih OK untuk menghapus...')">
				  <img src="img/delete.png" height="100%">
				</a>
			  </td>
			</tr> <?php 
            }
            ?>
      </table>
	  </div>
      <script type="text/javascript">
        $(document).ready(function() {
          //$("#tabel1").tablesorter();
          $("#tabel1").DataTable({
            "paging": true,
            "ordering": true,
            "info": true,
            // });
            //$("#tabel1").DataTable({
            "language": {
              "decimal": "",
              "emptyTable": "Tidak ada data yang tersedia di tabel",
              "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ Inputan",
              "infoEmpty": "Menampilkan 0 sampai 0 dari 0 Inputan",
              "infoFiltered": "(difilter dari _MAX_ total Inputan)",
              "infoPostFix": "",
              "thousands": ".",
              "lengthMenu": "Menampilkan _MENU_ Data Pemasukan",
              "loadingRecords": "memuat...",
              "processing": "Sedang di proses...",
              "search": "Pencarian:",
              "zeroRecords": "Arsip tidak ditemukan",
              "paginate": {
                "first": "Pertama",
                "last": "Terakhir",
                "next": "Selanjutnya",
                "previous": "Kembali"
              },
              "aria": {
                "sortAscending": ": aktifkan urutan kolom ascending",
                "sortDescending": ": aktifkan urutan kolom descending"
              }
            }
          });
        });
      </script>
    </div>
    <script>
      function kategori_pemasukan(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
          tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
          tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
      }
    </script>
    <script src="js/jquery.mask.min.js"></script>
    <script src="js/terbilang.js"></script>
    <script>
      function inputTerbilang() {
        //membuat inputan otomatis jadi mata uang
        $('.mata-uang').mask('0.000.000.000', {
          reverse: true
        });
		
		var qty = document.getElementById('qty').value;
		var costum = document.getElementById('costum').value;
		var tot_pem = document.getElementById('total_pembayaran').value;
				if (qty == ""){
					document.getElementById("qty").value = "0";
				}
				if (costum == ""){
					document.getElementById("costum").value = "0";
				}
				if (tot_pem == ""){
					document.getElementById("total_pembayaran").value = "0";
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
	<script>
		function autofocuss() {
			document.getElementById("jenis").focus();
		}			
	</script>		
	<script type="text/javascript">
			function total_kembali(){		  
				 $('.mata-uang').mask('0.000.000.000', {reverse: true});
			//	alert('y');
				var total_tf = document.getElementById('pem_trf').value;
				if (total_tf == ""){
					total_tf = "0";
					document.getElementById("pem_trf").value = "0";
				}
				else{
					total_tf = total_tf.replace(".","");
					total_tf = total_tf.replace(".","");
					total_tf = total_tf.replace(".","");
				}
				var total_edc = document.getElementById('pem_edc').value;
				if (total_edc == ""){
					total_edc = "0";
					document.getElementById("pem_edc").value = "0";
				}
				else{
					total_edc = total_edc.replace(".","");
					total_edc = total_edc.replace(".","");
					total_edc = total_edc.replace(".","");
				}
				
				var total_tni = document.getElementById('pem_tni').value;
				if (total_tni == ""){
					total_tni = "0";
					document.getElementById("pem_tni").value = "0";
				}
				else{
					total_tni = total_tni.replace(".","");
					total_tni = total_tni.replace(".","");
					total_tni = total_tni.replace(".","");
				}
				var total = parseInt(total_tf) + parseInt(total_edc) + parseInt(total_tni);
				document.getElementById("total_pembayaran_ofl").value = total;
				var hemm = total.toFixed().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
				document.getElementById("totalnya").innerHTML = "Rp"+hemm;				
				
			}		         
		</script>
		<script>
			function sebelum1() {         	
			  var dari = document.getElementById("dari1").value; 
			  var keter = document.getElementById("keterangan1").value; 
			  if(dari==""){
				  alert('Input dari/Oleh...');	
				  document.getElementById("dari1").focus();
				  return false;
			  }
			  else if(keter==""){
				  alert('Input catatan...');	
				  document.getElementById("keterangan1").focus();
				  return false;
			  }
			 
				else{
					return confirm('Yakin ingin simpan?');        	 
				}
			}			
		</script>	
		<script>
			function sebelum2() {         	
			  var dari = document.getElementById("dari2").value; 
			  var keter = document.getElementById("keterangan2").value; 
			  if(dari==""){
				  alert('Input dari/Oleh...');	
				  document.getElementById("dari2").focus();
				  return false;
			  }
			  else if(keter==""){
				  alert('Input catatan...');	
				  document.getElementById("keterangan2").focus();
				  return false;
			  }
			 
				else{
					return confirm('Yakin ingin simpan?');        	 
				}
			}			
		</script>	
		<script>
			function sebelum3() {         	
			  var dari = document.getElementById("dari3").value; 
			  var keter = document.getElementById("keterangan3").value; 
			  if(dari==""){
				  alert('Input dari/Oleh...');	
				  document.getElementById("dari3").focus();
				  return false;
			  }
			  else if(keter==""){
				  alert('Input catatan...');	
				  document.getElementById("keterangan3").focus();
				  return false;
			  }
			 
				else{
					return confirm('Yakin ingin simpan?');        	 
				}
			}			
		</script>	 
		<div id="contact-modal" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h3>Tambah Sumber Pemasukan</h3>
					</div>
					<table id="tabel1" class="table table-hover" style="width:85%" border="1" cellpadding="0" cellspacing="1" align="center">
						<tr style="background-color:#585657;color:#FFFFFF;" align='center'>
							<td align='center'>No.</th>
							<td align='center'>Sumber Pemasukan</th>
							<td align='center'>Aksi</th>
						</tr>
						<?php
							include "koneksi.php";
							$no=1;
							$data = mysqli_query($koneksi,"select ID,KATEGORI from t_kategori_pemasukan order by KATEGORI ASC");
								while($d = mysqli_fetch_array($data)){
							$id = $d['ID'];
								
							?>
						<tr align="center">
							<td><?php echo $no++; ?></td>
							<td align="left"><?php echo $d['KATEGORI']; ?></td>
							<td align="center"> <a href='hapus-kategori-pemasukan?id=<?php echo $id; ?>' title="Hapus Sumber Pemasukan" onclick="return confirm('Pilih OK untuk menghapus Sumber Pemasukan')"><img src="img/delete.png" height="100%" ></a><?php } ?></td>
						</tr>
					</table>
					<form id="contactForm" name="contact" role="form">
						<div class="modal-body">
							<div class="form-group">
								<label for="name">Sumber Pemasukan:</label>
								<input type="text" name="kategoriy" id="kategoriy" placeholder="Input Sumber Pemasukan" onkeyup="cek_kat();" class="form-control">                        
								<input hidden readonly="readonly" type="text" value="0" id="kategoriy2" name="kategoriy2">
							</div>
						</div>
						<div class="modal-footer">					
							<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
							<button  value="simpan" onclick="input_pemasukanx()" name="input_pemasukan" id="input_pemasukan" class="btn btn-primary">Tambah</button>	
						</div>
					</form>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			function cek_kat(){        			   		   
				var kategori = $('#kategoriy').val();
				if (kategori!=""){
				//alert(a);   
					$.ajax({
					url: 'list-kat-pemasukan.php',
					method: 'GET',
					data: { kategori : kategori},
					success	: function(data){
									//document.getElementById("myForm").reset();									
						var json = data,
						obj = JSON.parse(json);
						$('#kategoriy2').val(obj.kategori);	     
						 var kod1 = $('#kategoriy').val(); 
					 var kod2 = $('#kategoriy2').val(); 
					 if (kod1 == kod2){
						 alert('Sumber Pemasukan sudah ada....');                    
						 document.getElementById("kategoriy").focus();    
						 document.getElementById("kategoriy").value = "-"; 
					 }
					},
					error: function(response){
						console.log(response.responseText);
					}
					});	
				}
			}			 
		</script>
		<script type="text/javascript">
			function input_pemasukanx(){				
				var kategori = $('#kategoriy').val();
				if (kategori!=""){
					$.ajax({
					  method: "POST",
					   url: "simpan-kategori-pemasukan-new.php",
					  data: { kategori : kategori,type:"insert"},
					  success	: function(data){
								location.reload(true);		
								//	alert('Data tersimpan');  
								
								},
								error: function(response){
									console.log(response.responseText);
								}
					});					
				}		
			 }
		</script>
		</div>
		<div class="navbar_bot">
			<?php include "bantuan/footer.php" ?>
		</div>
	</body>
</html>