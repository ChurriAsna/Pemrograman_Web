<!-- navbar.php -->
<?php
//session_start();
require 'includes/config.php';

// Cek apakah admin sudah login
$isAdminLoggedIn = isset($_SESSION['admin_id']);
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">AlkesMEDIKA</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="products.php">Produk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="categories.php">Kategori</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cart.php">Keranjang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="checkout.php">Checkout</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="guest_book.php">Guest Book</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <?php if ($isAdminLoggedIn): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="admin/dashboard.php">Dashboard Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin/logout.php">Logout</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="admin/login.php">Login Admin</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
