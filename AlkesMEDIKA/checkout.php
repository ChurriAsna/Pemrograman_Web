<!-- checkout.php -->
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
require 'D:/App/XAMPP/Pasang/htdocs/AlkesMEDIKA/includes/config.php';
//require_once('D:/App/XAMPP/Instalasi/htdocs/AlkesMEDIKA/includes/config.php');

// Mengambil data keranjang belanja dari sesi
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
if (empty($cart)) {
    header('Location: product.php');
    exit();
}

// Menghitung total harga
$total = 0;
foreach ($cart as $item) {
    $total += $item['price'] * $item['quantity'];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Checkout - AlkesMEDIKA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="container mt-5">
        <h2>Checkout</h2>
        <form action="process_checkout.php" method="POST">
            <div class="mb-3">
                <label for="payment_method" class="form-label">Metode Pembayaran</label>
                <select class="form-select" id="payment_method" name="payment_method" required>
                    <option value="">Pilih Metode Pembayaran</option>
                    <option value="Prepaid">Prepaid (Kartu Debit/Kredit)</option>
                    <option value="Postpaid">Postpaid (Bayar di Tempat)</option>
                </select>
            </div>
            <h4>Total Pembayaran: Rp <?php echo number_format($total, 2, ',', '.'); ?></h4>
            <button type="submit" class="btn btn-primary">Bayar Sekarang</button>
        </form>
    </div>

    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
