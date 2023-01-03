<?php
include 'koneksi.php';
$username = $_GET['username'];
$query = mysqli_query($koneksi, "select * from t_user where USERNAME='$username'");
$kod_trans = mysqli_fetch_array($query);
$data = array(
            'username'      =>  $kod_trans['USERNAME'],);
 echo json_encode($data);
?>