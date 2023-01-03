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
		<title>PENGELUARAN - HOLASWEATER.ID</title>
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
			<a class="nav-link" href="pemasukan-new"><b>Pemasukan</b></a>
			<a class="active" href="pengeluaran-new"><b>Pengeluaran</b></a>
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
				$kode_aktifnya="";
				session_start();		
				$tgl_hari_ini = date('d F Y');	
				//$tgl_hari_inii = date('yyyy-mm-dd');
				$tgl_hari_inii = date("Y/m/d");
				
		
				
				$data_pengeluaran = mysqli_query($koneksi,"select max(ID) as ID from t_pengeluaran");
				 while($d = mysqli_fetch_array($data_pengeluaran)){
					$jummasuk        = $d['ID'];					
				 }
				if ($jummasuk == 0) {
					$kode_pengeluaran = "PRC-00000000001";
				}
				else{
					$jummasuk++;			
					if (strlen($jummasuk)== 1){
						$kode_pengeluaran = "PRC-00000000000".$jummasuk;				
					}
					else if (strlen($jummasuk)== 2){
						$kode_pengeluaran = "PRC-0000000000".$jummasuk;
					}
					else if (strlen($jummasuk)== 3){
						$kode_pengeluaran = "PRC-000000000".$jummasuk;
					}
					else if (strlen($jummasuk)== 4){
						$kode_pengeluaran = "PRC-00000000".$jummasuk;
					}
					else if (strlen($jummasuk)== 5){
						$kode_pengeluaran = "PRC-0000000".$jummasuk;
					}
					else if (strlen($jummasuk)== 6){
						$kode_pengeluaran = "PRC-000000".$jummasuk;
					}
					else if (strlen($jummasuk)== 7){
						$kode_pengeluaran = "PRC-00000".$jummasuk;
					}
					else if (strlen($jummasuk)== 8){
						$kode_pengeluaran = "PRC-0000".$jummasuk;
					}
					else if (strlen($jummasuk)== 9){
						$kode_pengeluaran = "PRC-000".$jummasuk;
					}
					else if (strlen($jummasuk)== 10){
						$kode_pengeluaran = "PRC-00".$jummasuk;
					}
					else if (strlen($jummasuk)== 11){
						$kode_pengeluaran = "PRC-0".$jummasuk;
					}
					else if (strlen($jummasuk)== 12){
						$kode_pengeluaran = "PRC-".$jummasuk;
					}
				}
				?>   <h2 style="color:#284d58">Pengeluaran</h2>
    <div class="tab">
	<?php
			if ($_SESSION['level']!="OWNER" AND $_SESSION['level']!="PURCHASING" AND $_SESSION['level']!="OWNER"){
				  echo "<script>document.getElementById('btn_history').click();</script>";
			}
			else{
			?>
      <button class="tablinks" id="btn_input" onclick="kategori_pengeluaran(event, 'input_pengeluaran')">
        <b>Input Pengeluaran</b>
			<?php } ?>
      </button>
      <button class="tablinks" id="btn_history" onclick="kategori_pengeluaran(event, 'history')">
        <b>History Pengeluaran</b>
      </button>
    </div>
    <div id="input_pengeluaran" class="tabcontent">
       <h4 style="color:#284d58">Input Pengeluaran</h3>
      <br>
      <br>	  
      <form method="post" action="simpan-pengeluaran-new.php" autocomplete="off" onsubmit="return sebelum1()">
        <table class="table table-borderless" style="width:80%" border="0" cellpadding="2" cellspacing="2" align="left">
          <tr>
            <th>Nomor Pengeluaran</th>
            <td width="5%">:</td>
            <td colspan="2">
              <label name="KODE_PENGELUARANx" id="kode_pengeluaranx" style="color:black;font-size:12pt">
                <b> <?php echo $kode_pengeluaran ?> </b>
                <label>
				<input hidden class="form-control form-control-sm" readonly maxlength="30" type="text" name="KODE_PENGELUARAN" value="<?php echo $kode_pengeluaran ?>">
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
              <h4 style="color:#000000">Rincian Pengeluaran</h4>
            </th>
          </tr>
          <tr>
            <th>&nbsp &nbsp Divisi</th>
            <td width="5%"></td>
            <td colspan="2">
              <select class="form-control form-control-sm" name="DIVISI" id="divisi" onchange="autofocuss3()" autofocus>
					<option value="0" selected>Pilih Divisi</option>
					<option value="OFFLINE STORE">Offline Store</option>
					<option value="MARKETING">Marketing</option>
					<option value="TIKTOK LIVE">Tiktok Live</option>
					<option value="AFILIATE">Afiliate</option>
					<option value="WAREHOUSE">Warehouse</option>
					<option value="KONVEKSI">Konveksi</option>
					<option value="PURCHASING UMUM">Puchasing UMUM</option>
              </select>
            </td>
          </tr>
           <tr>
            <th>&nbsp &nbsp Jenis Pengeluaran</th>
            <td width="5%"></td>
            <td colspan="2">
              <select class="form-control form-control-sm" name="JENIS" id="jenis" onchange="autofocuss2()" autofocus>
					<option value="0" selected>Pilih Jenis</option>
					<option value="IKLAN DAN PEMASARAN">Iklan dan Pemasaran</option>
					<option value="GAJI/ TUNJANGAN KARYAWAN">Gaji/ Tunjangan Karyawan</option>
					<option value="BAHAN BAKU">Bahan Baku</option>
					<option value="BIAYA SEWA/ KONTRAK">Biaya Sewa/ Kontrak</option>
					<option value="PENGADAAN ALAT">Pengadaan Alat</option>
					<option value="MAINTENANCE DAN PENGEMBANGAN">Maintenance dan Pengembangan</option>
					<option value="AKOMODASI DAN PERJALANAN">Akomodasi dan Perjalanan</option>
					<option value="OPERASIONAL">Operasional</option>

              </select>
            </td>
          </tr>
          <tr>
            <th>&nbsp &nbsp Detail Pengeluaran</th>
            <td width="5%"></td>
            <td colspan="2">
              <textarea rows="4" cols="50" class="form-control form-control-sm" id="detail" placeholder="Detail" maxlength="300" type="text" name="DETAIL"></textarea>
              </th>
          </tr>
          <tr>
            <th>&nbsp &nbsp Total Tagihan</th>
            <td width="5%" align="right">
              <label>Rp</label>
            </td>
            <td colspan="2">
              <input type="text" value="0" id="total_pembayaran" class="form-control form-control-sm mata-uang" onkeyup="inputTerbilang();" name="TOTAL_PEMBAYARAN">
              </th>
          </tr>
          <tr>
            <th>&nbsp &nbsp Diajukan Oleh</th>
            <td width="5%"></td>
            <td colspan="2">
              <input class="form-control form-control-sm" id="oleh" placeholder="Oleh" maxlength="120" type="text" name="OLEH">
              </th>
          </tr>
          <tr align='center'>
            <td>
			</td>
            <td>
              <button onclick="autofocuss()" type="reset" class="btn btn-secondary btn-lg btn-block">Batal</button>
              </td>
            <td colspan="2">
			  <button type="submit" value="simpan" class="btn btn-primary btn-lg btn-block">Proses</button>
			  
          </tr>
          </tr>
        </table>
      </form>
    </div>
    
    <div style="display: block;" id="history" class="tabcontent">
      <h4 style="color:#284d58">Tampilkan History Pengeluaran</h3>
      <br>
      <br>
	  
	  <div class="table-responsive">
      <table id="tabel1" class="table table-hover" border="0" cellpadding="0" cellspacing="1">
	  
        <thead align="center">
          <tr style="background-color:#585657;color:#FFFFFF;" align='center'>
            <th>No.</th>
            <th>Tanggal Input</th>
            <th>Divisi</th>
            <th>Keperluan</th>
            <th>Detail</th>
            <th>Banyaknya</th>
            <th>Action</th>
          </tr>
        </thead> <?php 
            include 'koneksi.php';
            $no=1;
			 function formatTanggal($date){
                    // ubah string menjadi format tanggal
                    return date('d-M-Y', strtotime($date));
                    }	
            $data = mysqli_query($koneksi,"select * from t_pengeluaran order by ID DESC");
            while($d = mysqli_fetch_array($data)){
				$date_ = date_create($d['TGL']);
				$tgl2 = date_format($date_,'d-m-Y');  
                $hari = date('l', strtotime($d['TGL']));
                $semua = $hari.", ".$tgl;
				$tgl_tamp = substr($tgl,0,10);
				
				$kode_aktifnya = 'HISTORY';
				$kod_inp = $d['KODE_PENGELUARAN'];
				$keperl = $d['KATEGORI'];
				$divisi = $d['DIVISI'];
				$detail = $d['NOTES'];
				$detail2 = substr($detail,0,53);
				//UNTUK OLEH
				$oleh_perm = $d['PERMINTAAN'];
				$nom = $d['NOMINAL'];
				$nomtamp = "Rp".number_format($nom,0,",",".");
				
            	?> 
			<tr align='center'>
			
			  <td> <?php echo $no++; ?>. </td>
			  <td> <?php echo $tgl2; ?> </td>
			  <td> <?php echo $divisi; ?> </td>
			  <td align='left'>  <?php echo $keperl; ?> </td>
			  <td align='left'> 
						<?php echo $detail2; ?> 
				</td>
			  <td align='right'> <?php echo $nomtamp; ?> </td>
			  <td>
				<a target="_BLANK" href='detail-pengeluaran-new?kode_transaksi=<?php echo $kod_inp; ?>' title="Lihat Detail Pengeluaran" onclick="return confirm('Pilih OK untuk melihat detail...')">
				  <img src="img/show.png" height="100%">
				</a>|
				<a target="_BLANK" href='cetak-pengeluaran-new?kode_transaksi=<?php echo $kod_inp; ?>' title="Cetak Nota Transaksi" onclick="return confirm('Pilih OK untuk mencetak...')"><img src="img/print.png" height="100%" ></a>|
				<a href='hapus-pengeluaran-new?kode_transaksi=<?php echo $kod_inp; ?>' title="Hapus Pengeluaran" onclick="return confirm('Pilih OK untuk menghapus...')">
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
              "lengthMenu": "Menampilkan _MENU_ Data Pengeluaran",
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
      function kategori_pengeluaran(evt, cityName) {
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
		
		var tot_pem = document.getElementById('total_pembayaran').value;				
		if (tot_pem == "" || tot_pem == "0"){
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
			function sebelum1() {         	
			  var jenis = document.getElementById("jenis").value; 
			  var detail = document.getElementById("detail").value; 
			  var tottt = document.getElementById("total_pembayaran").value; 
			  var oleh = document.getElementById("oleh").value; 
			  if(jenis==0){
				  alert('Pilih Jenis...');	
				  document.getElementById("jenis").focus();
				  return false;
			  }
			  else if(detail==""){
				  alert('Input Detail...');	
				  document.getElementById("detail").focus();
				  return false;
			  }
			  else if(tottt=="0"){
				  alert('Tagihan 0?');	
				  document.getElementById("total_pembayaran").focus();
				  return false;
			  }
			 
			  else if(oleh==""){
				  alert('Input Oleh...');	
				  document.getElementById("oleh").focus();
				  return false;
			  }
				else{
					return confirm('Yakin ingin simpan?');        	 
				}
			}			
		</script>	
		
  <input hidden type="text" id="tempat_cek" maxlength="12" value="<?php echo $kode_aktifnya; ?>" name="tempat_cek" class="form-control form-control-lg" readonly=readonly>
		<script type="text/javascript">
		  var kode_aktif = $('#tempat_cek').val();
		 // alert(kode_aktif);
			  if (kode_aktif=="HISTORY"){
				  document.getElementById("btn_history").click();
			  }			  
			  else{
				  document.getElementById("btn_input").click();
				  document.getElementById("jenis").focus();
			  }
			  function kategori(){
				  alert('c');
			  }
		</script>
		
		<script>
			function autofocuss() {
				//dedy alim
				document.getElementById("jenis").focus();
			}			
		</script>
		<script>
			function autofocuss3() {
				//dedy alim
				document.getElementById("jenis").focus();
			}			
		</script>
		<script>
			function autofocuss2() {
				//dedy alim
				document.getElementById("detail").focus();
			}			
		</script>
	</div>
		<div class="navbar_bot">
			<?php include "bantuan/footer.php" ?>
		</div>
	</body>
</html>