<?php
include 'koneksi.php';

$id_transaksi = $_GET['id'];
$tgl_hari_ini = date('Y-m-d');

$query = mysqli_query($koneksi, "SELECT * FROM transaksi JOIN kendaraan ON transaksi.id_kendaraan = kendaraan.id_kendaraan WHERE id_transaksi='$id_transaksi'");
$data = mysqli_fetch_array($query);

$tgl_rencana = $data['tgl_kembali_rencana'];
$harga_per_hari = $data['harga_per_hari'];
$id_kendaraan = $data['id_kendaraan'];

// Hitung Harga
$selisih_hari = (strtotime($tgl_hari_ini) - strtotime($data['tgl_pinjam'])) / (60 * 60 * 24);
if($selisih_hari < 1) $selisih_hari = 1;
$total_harga = $selisih_hari * $harga_per_hari;

// Hitung Denda
$denda = 0;
if($tgl_hari_ini > $tgl_rencana){
    $telat = (strtotime($tgl_hari_ini) - strtotime($tgl_rencana)) / (60 * 60 * 24);
    $denda = $telat * 100000; // Denda 100rb/hari
}

$total_bayar = $total_harga + $denda;

mysqli_query($koneksi, "UPDATE transaksi SET tgl_kembali_real='$tgl_hari_ini', denda='$denda', total_bayar='$total_bayar', status_transaksi='Selesai' WHERE id_transaksi='$id_transaksi'");
mysqli_query($koneksi, "UPDATE kendaraan SET status='Tersedia' WHERE id_kendaraan='$id_kendaraan'");

echo "<script>alert('Kendaraan Kembali! Total Bayar: Rp ".number_format($total_bayar)."'); window.location='transaksi.php';</script>";
?>