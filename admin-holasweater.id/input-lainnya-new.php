<html>
	<head>
		<title>t</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Input Stok Keluar - S W E A T E R I N . M E</title>
		<link rel="shortcut icon" href="img/tokonline.png">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/freelancer.min.css">
		<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
		<script data-ad-client="ca-pub-5256228815542923" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>	
	</head>
	<body>
		
		 <script type="text/javascript">
			function isi_otomatis(){			   				
				var kode_barang = $("#kode_barang").val();
				var jenis_barang,warna,sizee,qty,semua;
					$.ajax({
						url: 'list-cekbarang-new.php',
						type: 'get',
						data     : 'kode='+kode_barang,
						success: function (data) {
							 var json = data,
							 obj = JSON.parse(json);					
							jenis_barang = (obj.jenis_barangx);
							warna = (obj.warnax);
							sizee = (obj.sizex);	
							$('#kuantitasxx').val(obj.qtyx);
							$('#qty').val("1");	
							document.getElementById("qty").focus();
							var semua = jenis_barang+"\n"+warna+"\n"+sizee;
							$('#keterangan').val(semua);	
						}
					});
				
			}					
		</script>
	</body>
</html>