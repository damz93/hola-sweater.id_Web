<?php
include 'koneksi.php';
$kode_barang = $_GET['kode'];
$query = mysqli_query($koneksi, "select * from t_stok where KODE_BARANG='$kode_barang' AND NOTES='GUDANG'");
$barang = mysqli_fetch_array($query);
$data = array(
            'kode_barangx'      =>  $barang['KODE_BARANG'],
			'jenis_barangx'      =>  $barang['JENIS_BARANG'],
			'warnax'      =>  $barang['WARNA'],
			'sizex'      =>  $barang['SIZE_'],
			'qtyx'      =>  $barang['QTY'],);
 echo json_encode($data);
?>