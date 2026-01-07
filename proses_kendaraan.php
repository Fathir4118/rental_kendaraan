<?php
include 'koneksi.php';
$aksi = $_GET['aksi'];

if($aksi == 'tambah'){
    $nopol = $_POST['no_polisi']; $jenis = $_POST['jenis']; $merk  = $_POST['merk']; $harga = $_POST['harga'];
    mysqli_query($koneksi, "INSERT INTO kendaraan VALUES(NULL, '$nopol', '$jenis', '$merk', '$harga', 'Tersedia')");
} elseif($aksi == 'hapus'){
    mysqli_query($koneksi, "DELETE FROM kendaraan WHERE id_kendaraan='$_GET[id]'");
}
header("location:kendaraan.php");
?>