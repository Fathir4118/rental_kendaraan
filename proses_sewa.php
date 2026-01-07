<?php
include 'koneksi.php';

$tipe_pelanggan = $_POST['tipe_pelanggan'];
$id_pelanggan_final = "";

if($tipe_pelanggan == 'lama') {
    // SKENARIO A: Pelanggan Lama
    $id_pelanggan_final = $_POST['id_pelanggan_lama'];
    if(empty($id_pelanggan_final)){
        echo "<script>alert('Harap pilih nama pelanggan!'); window.history.back();</script>"; exit;
    }
} else {
    // SKENARIO B: Pelanggan Baru
    $nama   = $_POST['nama_baru'];
    $nik    = $_POST['nik_baru'];
    $hp     = $_POST['hp_baru'];
    $alamat = $_POST['alamat_baru'];

    // Cek NIK
    $cek_nik = mysqli_query($koneksi, "SELECT id_pelanggan FROM pelanggan WHERE nik='$nik'");
    if(mysqli_num_rows($cek_nik) > 0){
        $data_pel = mysqli_fetch_assoc($cek_nik);
        $id_pelanggan_final = $data_pel['id_pelanggan'];
    } else {
        $insert = mysqli_query($koneksi, "INSERT INTO pelanggan VALUES (NULL, '$nik', '$nama', '$hp', '$alamat')");
        if($insert){
            $id_pelanggan_final = mysqli_insert_id($koneksi);
        } else {
            die("Gagal Simpan Pelanggan: " . mysqli_error($koneksi));
        }
    }
}

// Proses Transaksi
$id_kendaraan = $_POST['kendaraan'];
$tgl_pinjam   = $_POST['tgl_pinjam'];
$tgl_kembali  = $_POST['tgl_kembali'];

$simpan = mysqli_query($koneksi, "INSERT INTO transaksi VALUES (NULL, '$id_pelanggan_final', '$id_kendaraan', '$tgl_pinjam', '$tgl_kembali', NULL, 0, 0, 'Berjalan')");

if($simpan){
    mysqli_query($koneksi, "UPDATE kendaraan SET status='Disewa' WHERE id_kendaraan='$id_kendaraan'");
    header("location:transaksi.php?pesan=sukses");
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>