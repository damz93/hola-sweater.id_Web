<?php
include 'koneksi.php';
$nama_barang = $_GET['nama_barang'];
$query = mysqli_query($koneksi, "select * from t_inventory where NAMA_BARANG='$nama_barang'");
$inv = mysqli_fetch_array($query);
$data = array(
            'kode_barang'      =>  $inv['KODE_BARANG'],
			'spesifikasi'      =>  $inv['SPESIFIKASI'],
			'satuan'      =>  $inv['SATUAN'],
			'qty'      =>  $inv['QTY'],);
 echo json_encode($data);
?>