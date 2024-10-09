<!-- index.php -->
<?php
session_start();
require_once('D:/App/XAMPP/Pasang/htdocs/AlkesMEDIKA/includes/config.php');


// Cek apakah admin sudah login
$isAdminLoggedIn = isset($_SESSION['admin_id']);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>AlkesMEDIKA - Halaman Utama</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">AlkesMEDIKA</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="product.php">Produk</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="categories.php">Kategori</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php">Keranjang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="checkout.php">Checkout</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="guest_book.php">Guest Book</a>
                    </li> -->
                    <?php if ($isAdminLoggedIn): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="admin/dashboard.php">Dashboard Admin</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin/logout.php">Logout</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="admin/login.php">Admin</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h1 class="display-4 mb-4">Selamat Datang di <span class="text-primary">AlkesMEDIKA</span></h1>
                <p>Platform terbaik untuk membeli peralatan medis dan alat kesehatan.</p>
                <p>Jelajahi produk kami dan temukan semua kebutuhan kesehatan Anda dengan mudah dan cepat.</p>
                <a class="btn btn-primary btn-lg" href="product.php">Lihat Produk</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
