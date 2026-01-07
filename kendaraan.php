<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Kendaraan</title>
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
        .form-control, .form-select { background-color: #1a1a1a; border: 1px solid #ff6f00; color: white; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark p-3">
        <div class="container">
            <a class="navbar-brand text-warning fw-bold" href="#">RENTAL KENDARAAN FATHIR</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link active" href="kendaraan.php">Data Kendaraan</a></li>
                    <li class="nav-item"><a class="nav-link" href="pelanggan.php">Pelanggan</a></li>
                    <li class="nav-item"><a class="nav-link" href="transaksi.php">Riwayat Transaksi</a></li>
                    <li class="nav-item"><a class="nav-link text-danger" href="login.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h3 class="text-warning mb-4"><i class="fas fa-car me-2"></i> Manajemen Armada</h3>
        <button class="btn btn-warning fw-bold mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah"><i class="fas fa-plus"></i> Tambah Kendaraan</button>

        <div class="card bg-dark border-secondary">
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>No</th><th>No Polisi</th><th>Jenis</th><th>Merk/Tipe</th><th>Harga/Hari</th><th>Status</th><th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = mysqli_query($koneksi, "SELECT * FROM kendaraan ORDER BY id_kendaraan DESC");
                        $no = 1;
                        while($d = mysqli_fetch_array($query)){
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><span class="badge bg-secondary"><?php echo $d['no_polisi']; ?></span></td>
                            <td><?php echo $d['jenis']; ?></td>
                            <td><?php echo $d['merk']; ?></td>
                            <td>Rp <?php echo number_format($d['harga_per_hari']); ?></td>
                            <td><?php echo ($d['status'] == 'Tersedia') ? "<span class='badge bg-success'>Ready</span>" : "<span class='badge bg-danger'>Disewa</span>"; ?></td>
                            <td>
                                <a href="proses_kendaraan.php?aksi=hapus&id=<?php echo $d['id_kendaraan']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus?')"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTambah">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header"><h5 class="modal-title text-warning">Tambah Kendaraan</h5><button class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
                <form action="proses_kendaraan.php?aksi=tambah" method="POST">
                    <div class="modal-body">
                        <div class="mb-3"><label>No Polisi</label><input type="text" name="no_polisi" class="form-control" required></div>
                        <div class="mb-3"><label>Jenis</label><select name="jenis" class="form-select"><option value="Bus">Bus</option><option value="Minibus">Minibus</option><option value="Motor">Motor</option></select></div>
                        <div class="mb-3"><label>Merk</label><input type="text" name="merk" class="form-control" required></div>
                        <div class="mb-3"><label>Harga</label><input type="number" name="harga" class="form-control" required></div>
                    </div>
                    <div class="modal-footer"><button type="submit" class="btn btn-warning">Simpan</button></div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>