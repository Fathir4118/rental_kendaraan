<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background-color: #1a1a1a; color: white; font-family: sans-serif; }
        .navbar { background-color: #000; border-bottom: 3px solid #ff6f00; }
        .nav-link { color: #ffca28 !important; font-weight: bold; }
        
        .table { color: white; background-color: #2d2d2d; }
        .table thead { background-color: #ff6f00; color: black; }
        .table-hover tbody tr:hover { background-color: #333; color: #ffca28; }
        
        .card-header { background-color: #ff6f00; color: black; font-weight: bold; }
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
                    <li class="nav-item"><a class="nav-link" href="pelanggan.php">Pelanggan</a></li>
                    <li class="nav-item"><a class="nav-link active" href="transaksi.php">Riwayat Transaksi</a></li>
                    <li class="nav-item"><a class="nav-link text-danger" href="login.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="text-warning"><i class="fas fa-list-alt me-2"></i> Data Transaksi</h3>
            <a href="index.php" class="btn btn-outline-warning btn-sm"><i class="fas fa-plus"></i> Sewa Baru (Dashboard)</a>
        </div>

        <div class="card bg-dark border-warning mb-5">
            <div class="card-header"><i class="fas fa-clock me-2"></i> SEDANG BERJALAN</div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pelanggan</th>
                            <th>Kendaraan</th>
                            <th>Tgl Pinjam</th>
                            <th>Rencana Kembali</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $data = mysqli_query($koneksi, "SELECT * FROM transaksi JOIN pelanggan ON transaksi.id_pelanggan = pelanggan.id_pelanggan JOIN kendaraan ON transaksi.id_kendaraan = kendaraan.id_kendaraan WHERE status_transaksi = 'Berjalan' ORDER BY id_transaksi DESC");
                        $no = 1;
                        while($d = mysqli_fetch_array($data)){
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><strong><?php echo $d['nama']; ?></strong><br><small class="text-muted"><?php echo $d['no_hp']; ?></small></td>
                            <td><?php echo $d['merk']; ?> <span class="badge bg-secondary"><?php echo $d['no_polisi']; ?></span></td>
                            <td><?php echo date('d/m/Y', strtotime($d['tgl_pinjam'])); ?></td>
                            <td><?php echo date('d/m/Y', strtotime($d['tgl_kembali_rencana'])); ?></td>
                            <td><span class="badge bg-warning text-dark">Dipinjam</span></td>
                            <td>
                                <a href="proses_kembali.php?id=<?php echo $d['id_transaksi']; ?>" class="btn btn-success btn-sm" onclick="return confirm('Proses pengembalian kendaraan ini?')">
                                    <i class="fas fa-check-circle"></i> Kembalikan
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card bg-dark border-secondary">
            <div class="card-header bg-secondary text-white"><i class="fas fa-history me-2"></i> RIWAYAT SELESAI</div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0 text-white-50">
                    <thead>
                        <tr>
                            <th>Pelanggan</th>
                            <th>Kendaraan</th>
                            <th>Tgl Kembali (Real)</th>
                            <th>Denda</th>
                            <th>Total Bayar</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $data_log = mysqli_query($koneksi, "SELECT * FROM transaksi JOIN pelanggan ON transaksi.id_pelanggan = pelanggan.id_pelanggan JOIN kendaraan ON transaksi.id_kendaraan = kendaraan.id_kendaraan WHERE status_transaksi = 'Selesai' ORDER BY id_transaksi DESC LIMIT 10");
                        while($log = mysqli_fetch_array($data_log)){
                        ?>
                        <tr>
                            <td><?php echo $log['nama']; ?></td>
                            <td><?php echo $log['merk']; ?></td>
                            <td><?php echo date('d/m/Y', strtotime($log['tgl_kembali_real'])); ?></td>
                            <td>Rp <?php echo number_format($log['denda']); ?></td>
                            <td class="text-warning fw-bold">Rp <?php echo number_format($log['total_bayar']); ?></td>
                            <td><span class="badge bg-success">Selesai</span></td>
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