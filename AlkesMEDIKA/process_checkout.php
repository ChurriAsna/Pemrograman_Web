<?php
// error reporting di PHP agar Anda dapat melihat semua error yang muncul
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// process_checkout.php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require 'includes/config.php';
require 'vendor/autoload.php'; // Untuk library PDF dan PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use setasign\FPDF\FPDF;

// Cek apakah metode pembayaran dipilih
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $payment_method = $_POST['payment_method'];
    if (!in_array($payment_method, ['Prepaid', 'Postpaid'])) {
        die('Metode pembayaran tidak valid.');
    }

    // Mengambil data keranjang
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

    // Mulai transaksi
    $conn->begin_transaction();

    try {
        // Menyimpan pesanan ke tabel orders
        $stmt = $conn->prepare("INSERT INTO orders (user_id, total, payment_method, status) VALUES (?, ?, ?, 'Pending')");
        if (!$stmt) {
            throw new Exception("Gagal mempersiapkan pernyataan orders: " . $conn->error);
        }
        $stmt->bind_param("ids", $_SESSION['user_id'], $total, $payment_method);
        if (!$stmt->execute()) {
            throw new Exception("Gagal memasukkan pesanan: " . $stmt->error);
        }
        $order_id = $stmt->insert_id;
        $stmt->close();

        // Menyimpan detail pesanan ke tabel order_items
        $stmt = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
        if (!$stmt) {
            throw new Exception("Gagal mempersiapkan pernyataan order_items: " . $conn->error);
        }

        foreach ($cart as $product_id => $item) {
            // Validasi product_id
            if (empty($product_id) || !is_numeric($product_id)) {
                throw new Exception("Product ID tidak valid.");
            }

            // Validasi apakah product_id ada di tabel products
            $prod_check = $conn->prepare("SELECT id FROM products WHERE id = ?");
            if (!$prod_check) {
                throw new Exception("Gagal mempersiapkan pernyataan produk: " . $conn->error);
            }
            $prod_check->bind_param("i", $product_id);
            $prod_check->execute();
            $result = $prod_check->get_result();
            if ($result->num_rows == 0) {
                throw new Exception("Product ID $product_id tidak valid.");
            }
            $prod_check->close();

            // Bind parameter dan eksekusi insert
            $stmt->bind_param("iiid", $order_id, $product_id, $item['quantity'], $item['price']);
            if (!$stmt->execute()) {
                throw new Exception("Gagal memasukkan order item: " . $stmt->error);
            }

            // Mengurangi stok produk
            $update_stmt = $conn->prepare("UPDATE products SET stock = stock - ? WHERE id = ?");
            if (!$update_stmt) {
                throw new Exception("Gagal mempersiapkan pernyataan update stok: " . $conn->error);
            }
            $update_stmt->bind_param("ii", $item['quantity'], $product_id);
            if (!$update_stmt->execute()) {
                throw new Exception("Gagal memperbarui stok produk: " . $update_stmt->error);
            }
            $update_stmt->close();
        }
        $stmt->close();

        // Jika metode pembayaran Prepaid, integrasi dengan Payment Gateway
        if ($payment_method === 'Prepaid') {
            // Contoh sederhana: redirect ke halaman pembayaran PayPal
            // Anda harus mengganti dengan integrasi API yang sebenarnya
            header('Location: paypal_payment.php?order_id=' . $order_id);
            exit();
        }

        // Untuk Postpaid, langsung set status ke Approved
        if ($payment_method === 'Postpaid') {
            $stmt = $conn->prepare("UPDATE orders SET status = 'Approved' WHERE id = ?");
            if (!$stmt) {
                throw new Exception("Gagal mempersiapkan pernyataan update status: " . $conn->error);
            }
            $stmt->bind_param("i", $order_id);
            if (!$stmt->execute()) {
                throw new Exception("Gagal memperbarui status pesanan: " . $stmt->error);
            }
            $stmt->close();
        }

        // Commit transaksi
        $conn->commit();

        // Mengosongkan keranjang
        unset($_SESSION['cart']);

        // Redirect ke halaman konfirmasi pesanan
        $_SESSION['success'] = "Checkout berhasil!";
        header('Location: order_confirmation.php?order_id=' . $order_id);
        exit();
    } catch (Exception $e) {
        // Rollback transaksi jika ada error
        $conn->rollback();
        $_SESSION['error'] = "Checkout gagal: " . $e->getMessage();
        header('Location: cart.php');
        exit();
        }
} else {
    header('Location: checkout.php');
    exit();
}

    // Mengambil data pesanan
    $stmt = $conn->prepare("SELECT p.name, oi.quantity, oi.price FROM order_items oi JOIN products p ON oi.product_id = p.id WHERE oi.order_id = ?");
    if (!$stmt) {
        throw new Exception("Gagal mempersiapkan pernyataan order_items: " . $conn->error);
    }
    $stmt->bind_param("i", $order_id);
    if (!$stmt->execute()) {
        throw new Exception("Gagal mengambil data order_items: " . $stmt->error);
    }
    $result = $stmt->get_result();
    $order_items = [];
    while ($row = $result->fetch_assoc()) {
        $order_items[] = $row;
    }
    $stmt->close();

    // Mengambil data pesanan
    $stmt = $conn->prepare("SELECT total, payment_method, created_at, status FROM orders WHERE id = ?");
    if (!$stmt) {
        throw new Exception("Gagal mempersiapkan pernyataan orders: " . $conn->error);
    }
    $stmt->bind_param("i", $order_id);
    if (!$stmt->execute()) {
        throw new Exception("Gagal mengambil data orders: " . $stmt->error);
    }
    $stmt->bind_result($total, $payment_method, $created_at, $status);
    $stmt->fetch();
    $stmt->close();

    // Mendapatkan path absolut ke folder 'reports'
    $reports_dir = __DIR__ . '/../reports'; // Sesuaikan jika skrip berada di subfolder lain

    // Cek dan buat direktori jika belum ada
    if (!is_dir($reports_dir)) {
        if (!mkdir($reports_dir, 0755, true)) {
            throw new Exception('Gagal membuat direktori reports.');
        }
    }

?>
