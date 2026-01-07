<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background-color: #1a1a1a; color: white; }
        .navbar { background-color: #000; border-bottom: 3px solid #ff6f00; }
        .nav-link { color: #ffca28 !important; }
        .table { color: white; background-color: #2d2d2d; }
        .table thead { background-color: #ff6f00; color: black; }
        .table-hover tbody tr:hover { background-color: #333; color: #ffca28; }
        .modal-content { background-color: #2d2d2d; color: white; border: 2px solid #ff6f00; }
        .form-control { background-color: #1a1a1a; border: 1px solid #ff6f00; color: white; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark p-3">
        <div class="container">
            <a class="navbar-brand text-warning fw-bold" href="#">RENTAL KENDARAAN FATHIR</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="kendaraan.php">Data Kendaraan</a></li>
                    <li class="nav-item"><a class="nav-link active" href="pelanggan.php">Pelanggan</a></li>
                    <li class="nav-item"><a class="nav-link" href="transaksi.php">Riwayat Transaksi</a></li>
                    <li class="nav-item"><a class="nav-link text-danger" href="login.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h3 class="text-warning mb-4"><i class="fas fa-users me-2"></i> Data Pelanggan</h3>
        <div class="card bg-dark border-secondary">
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr><th>No</th><th>Identitas</th><th>Nama & Kontak</th><th>Alamat</th><th>Status Terkini</th><th>Aksi</th></tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = mysqli_query($koneksi, "SELECT p.*, t.id_transaksi, t.tgl_kembali_rencana, k.merk FROM pelanggan p LEFT JOIN transaksi t ON p.id_pelanggan = t.id_pelanggan AND t.status_transaksi = 'Berjalan' LEFT JOIN kendaraan k ON t.id_kendaraan = k.id_kendaraan ORDER BY p.id_pelanggan DESC");
                        $no = 1;
                        $hari_ini = date('Y-m-d');
                        while($d = mysqli_fetch_array($query)){
                            $status_teks = "<span class='badge bg-secondary'>Tidak Ada Sewa</span>";
                            if($d['id_transaksi'] != NULL){
                                if($hari_ini > $d['tgl_kembali_rencana']){
                                    $status_teks = "<span class='badge bg-danger'>TERLAMBAT: $d[merk]</span>";
                                } else {
                                    $status_teks = "<span class='badge bg-warning text-dark'>Sewa: $d[merk]</span>";
                                }
                            }
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><span class="text-warning fw-bold"><?php echo $d['nik']; ?></span></td>
                            <td><strong><?php echo $d['nama']; ?></strong><br><small class="text-muted"><?php echo $d['no_hp']; ?></small></td>
                            <td><?php echo $d['alamat']; ?></td>
                            <td><?php echo $status_teks; ?></td>
                            <td>
                                <a href="proses_pelanggan.php?aksi=hapus&id=<?php echo $d['id_pelanggan']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus?')"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>