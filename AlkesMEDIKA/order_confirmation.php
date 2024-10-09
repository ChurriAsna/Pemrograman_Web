<!-- order_confirmation.php -->
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
require 'includes/config.php';

$order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;
if ($order_id <= 0) {
    header('Location: product.php');
    exit();
}

// Mengambil data pesanan
$stmt = $conn->prepare("SELECT total, payment_method, status, created_at FROM orders WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $order_id, $_SESSION['user_id']);
$stmt->execute();
$stmt->bind_result($total, $payment_method, $status, $created_at);
$stmt->fetch();
$stmt->close();

if (!$total) {
    header('Location: product.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Konfirmasi Pesanan - AlkesMEDIKA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'header.php'; ?>

    <?php
    // Mendapatkan path absolut ke folder 'reports'
    $reports_dir = __DIR__ . '/../reports'; // Sesuaikan jika skrip berada di subfolder

    // Cek apakah folder 'reports'
    if (!is_dir($reports_dir)) {
        if (!mkdir($reports_dir, 0755, true)) {
            die('Gagal membuat direktori reports.');
        }
    }
    ?>
    <div class="container mt-5">
        <h2>Terima Kasih atas Pesanan Anda!</h2>
        <p>Order ID: <?php echo $order_id; ?></p>
        <p>Total Pembayaran: Rp <?php echo number_format($total, 2, ',', '.'); ?></p>
        <p>Metode Pembayaran: <?php echo $payment_method; ?></p>
        <p>Status Pesanan: <?php echo $status; ?></p>
        <p>Tanggal Pesanan: <?php echo $created_at; ?></p>
        <a href="purchase_report.php?order_id=<?php echo $order_id; ?>" class="btn btn-primary">Lihat Laporan Pembelian</a>
    </div>

    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
