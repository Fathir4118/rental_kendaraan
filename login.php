<!DOCTYPE html>
<html>
<head>
    <title>Login Rental</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #1a1a1a; color: white; display: flex; align-items: center; justify-content: center; height: 100vh; }
        .card { background-color: #2d2d2d; border: 5px solid #ff6f00; border-radius: 20px; }
        .btn-orange { background-color: #ff6f00; color: white; font-weight: bold; border: none; }
        .btn-orange:hover { background-color: #e65100; color: white; }
    </style>
</head>
<body>
    <div class="card p-4 shadow-lg" style="width: 600px;">
        <h3 class="text-center mb-4" style="color: #ffca28;">RENTAL KENDARAAN FATHIR</h3>
        <form action="cek_login.php" method="POST">
            <div class="mb-3">
                <label style="color: #ffffffff;"> Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label style="color: #ffffffff;">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button class="btn btn-orange w-100">LOGIN SEKARANG</button>
        </form>
    </div>
</body>
</html>