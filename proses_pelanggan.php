<?php
include 'koneksi.php';
$aksi = $_GET['aksi'];

if($aksi == 'hapus'){
    $id = $_GET['id'];
    mysqli_query($koneksi, "DELETE FROM transaksi WHERE id_pelanggan='$id'");
    mysqli_query($koneksi, "DELETE FROM pelanggan WHERE id_pelanggan='$id'");
}
header("location:pelanggan.php");
?>