<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Rental</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* TEMA HITAM - OREN - KUNING */
        body { background-color: #1a1a1a; color: white; font-family: sans-serif; }
        .navbar { background-color: #000; border-bottom: 3px solid #ff6f00; }
        .nav-link { color: #ffca28 !important; font-weight: bold; }
        
        /* Hero Section */
        .hero {
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80');
            background-size: cover;
            padding: 80px 20px;
            border-radius: 0 0 20px 20px;
            border-bottom: 5px solid #ff6f00;
        }
        
        .card-stat { background: #2d2d2d; color: white; border-radius: 10px; border-left: 5px solid #ff6f00; transition: 0.3s; }
        .card-stat:hover { transform: translateY(-5px); background: #333; }
        
        .btn-orange { background-color: #ff6f00; color: white; font-weight: bold; border: none; padding: 15px 30px; font-size: 1.2rem; }
        .btn-orange:hover { background-color: #e65100; color: white; }

        /* Modal Style */
        .modal-content { background-color: #2d2d2d; color: white; border: 2px solid #ff6f00; }
        .form-control, .form-select { background-color: #1a1a1a; border: 1px solid #ff6f00; color: white; }
        .form-control:focus { background-color: #000; color: #ffca28; border-color: #ffca28; box-shadow: none; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark p-3">
        <div class="container">
            <a class="navbar-brand text-warning fw-bold" href="#"><i class="fas fa-car-side me-2"></i>RENTAL KENDARAAN FATHIR</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="index.php">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="kendaraan.php">Data Kendaraan</a></li>
                    <li class="nav-item"><a class="nav-link" href="pelanggan.php">Pelanggan</a></li>
                    <li class="nav-item"><a class="nav-link" href="transaksi.php">Riwayat Transaksi</a></li>
                    <li class="nav-item"><a class="nav-link text-danger" href="login.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid p-0 mb-4">
        <div class="hero text-center text-white">
            <h1 class="display-4 fw-bold text-warning">BUTUH KENDARAAN?</h1>
            <p class="lead mb-4">Sewa Mobil & Motor dengan Mudah, Cepat, dan Terpercaya.</p>
            <button type="button" class="btn btn-orange rounded-pill shadow-lg" data-bs-toggle="modal" data-bs-target="#modalSewa">
                <i class="fas fa-key me-2"></i> SEWA KENDARAAN SEKARANG
            </button>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <?php
            $total = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM kendaraan"));
            $disewa = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM kendaraan WHERE status='Disewa'"));
            $tersedia = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM kendaraan WHERE status='Tersedia'"));
            ?>
            <div class="col-md-4">
                <div class="card card-stat p-4 mb-3 shadow">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="fw-bold"><?php echo $total; ?></h3>
                            <span class="text-secondary small">Total Armada</span>
                        </div>
                        <i class="fas fa-car fa-2x text-muted"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-stat p-4 mb-3 shadow" style="border-left-color: #ffca28;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="fw-bold text-warning"><?php echo $disewa; ?></h3>
                            <span class="text-secondary small">Sedang Disewa</span>
                        </div>
                        <i class="fas fa-clock fa-2x text-warning"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-stat p-4 mb-3 shadow" style="border-left-color: #00ff00;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="fw-bold text-success"><?php echo $tersedia; ?></h3>
                            <span class="text-secondary small">Unit Tersedia</span>
                        </div>
                        <i class="fas fa-check-circle fa-2x text-success"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalSewa">
        <div class="modal-dialog">
            <div class="modal-content shadow-lg">
                <div class="modal-header">
                    <h5 class="modal-title text-warning fw-bold"><i class="fas fa-file-signature"></i> FORMULIR PENYEWAAN</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="proses_sewa.php" method="POST">
                        
                        <div class="mb-3 text-center">
                            <div class="btn-group w-100" role="group">
                                <input type="radio" class="btn-check" name="tipe_pelanggan" id="radioBaru" value="baru" checked onchange="gantiTipe('baru')">
                                <label class="btn btn-outline-warning" for="radioBaru">Pelanggan Baru</label>

                                <input type="radio" class="btn-check" name="tipe_pelanggan" id="radioLama" value="lama" onchange="gantiTipe('lama')">
                                <label class="btn btn-outline-warning" for="radioLama">Sudah Terdaftar</label>
                            </div>
                        </div>

                        <div id="form_baru" class="p-3 mb-3" style="border: 1px dashed #ff6f00; border-radius: 10px; background: #222;">
                            <h6 class="text-warning mb-3">Isi Data Pelanggan Baru</h6>
                            <div class="mb-2"><input type="text" name="nama_baru" id="nama_baru" class="form-control" placeholder="Nama Lengkap" required></div>
                            <div class="row">
                                <div class="col-6 mb-2"><input type="number" name="nik_baru" id="nik_baru" class="form-control" placeholder="NIK (KTP)" required></div>
                                <div class="col-6 mb-2"><input type="number" name="hp_baru" id="hp_baru" class="form-control" placeholder="No. HP" required></div>
                            </div>
                            <div class="mb-2"><textarea name="alamat_baru" id="alamat_baru" class="form-control" placeholder="Alamat Domisili" rows="2" required></textarea></div>
                        </div>

                        <div id="form_lama" class="p-3 mb-3" style="display: none; border: 1px solid #ff6f00; border-radius: 10px; background: #222;">
                            <h6 class="text-warning mb-3">Cari Data Pelanggan</h6>
                            <select name="id_pelanggan_lama" id="id_pelanggan_lama" class="form-control form-select">
                                <option value="">-- Pilih Nama Pelanggan --</option>
                                <?php
                                $all_pel = mysqli_query($koneksi, "SELECT * FROM pelanggan ORDER BY nama ASC");
                                while($p = mysqli_fetch_array($all_pel)){
                                    echo "<option value='$p[id_pelanggan]'>$p[nama] - (NIK: $p[nik])</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="text-muted small" style="color: #ffffffff;">Pilih Armada (Tersedia)</label>
                            <select name="kendaraan" class="form-control form-select-lg" required>
                                <option value="">-- Pilih Kendaraan --</option>
                                <?php
                                $k = mysqli_query($koneksi, "SELECT * FROM kendaraan WHERE status='Tersedia'");
                                while($kn = mysqli_fetch_array($k)){
                                    echo "<option value='$kn[id_kendaraan]'>$kn[jenis] - $kn[merk] ($kn[no_polisi]) - Rp ".number_format($kn['harga_per_hari'])."/hari</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-6 mb-3"><label class="text-muted small">Tgl Pinjam</label><input type="date" name="tgl_pinjam" class="form-control" value="<?php echo date('Y-m-d'); ?>" required></div>
                            <div class="col-6 mb-3"><label class="text-muted small">Rencana Kembali</label><input type="date" name="tgl_kembali" class="form-control" required></div>
                        </div>

                        <button type="submit" class="btn btn-orange w-100 py-3 fw-bold">KONFIRMASI SEWA</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // FUNGSI INI YANG DIPERBAIKI
        function gantiTipe(tipe) {
            if(tipe == 'baru') {
                // Tampilkan Form Baru, Sembunyikan Form Lama
                document.getElementById('form_baru').style.display = 'block';
                document.getElementById('form_lama').style.display = 'none';
                
                // NYALAKAN required untuk SEMUA inputan baru
                document.getElementById('nama_baru').required = true;
                document.getElementById('nik_baru').required = true;
                document.getElementById('hp_baru').required = true;     // <-- Tambahan Penting
                document.getElementById('alamat_baru').required = true; // <-- Tambahan Penting
                
                // MATIKAN required untuk inputan lama
                document.getElementById('id_pelanggan_lama').required = false;
                document.getElementById('id_pelanggan_lama').value = ""; // Reset pilihan
            } else {
                // Tampilkan Form Lama, Sembunyikan Form Baru
                document.getElementById('form_baru').style.display = 'none';
                document.getElementById('form_lama').style.display = 'block';
                
                // NYALAKAN required untuk inputan lama
                document.getElementById('id_pelanggan_lama').required = true;
                
                // MATIKAN required untuk SEMUA inputan baru
                document.getElementById('nama_baru').required = false;
                document.getElementById('nik_baru').required = false;
                document.getElementById('hp_baru').required = false;     // <-- Tambahan Penting
                document.getElementById('alamat_baru').required = false; // <-- Tambahan Penting
            }
        }
    </script>
</body>
</html>