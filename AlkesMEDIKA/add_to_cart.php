<?php
// add_to_cart.php
session_start();
require_once 'includes/config.php';

if (!isset($_GET['id'])) {
    header("Location: product.php");
    exit();
}

$product_id = intval($_GET['id']);

// Mengambil detail produk
$stmt = $conn->prepare("SELECT id, name, price, stock FROM products WHERE id = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows == 0){
    header("Location: product.php");
    exit();
}

$product = $result->fetch_assoc();
$stmt->close();

// Memeriksa stok
if($product['stock'] < 1){
    $_SESSION['error'] = "Produk sedang tidak tersedia.";
    header("Location: product.php");
    exit();
}

// Menambahkan ke keranjang
if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = [];
}

if(isset($_SESSION['cart'][$product_id])){
    if($_SESSION['cart'][$product_id]['quantity'] < $product['stock']){
        $_SESSION['cart'][$product_id]['quantity'] += 1;
    } else {
        $_SESSION['error'] = "Jumlah pesanan melebihi stok.";
    }
} else {
    $_SESSION['cart'][$product_id] = [
        'name' => $product['name'],
        'price' => $product['price'],
        'quantity' => 1
    ];
}

$_SESSION['success'] = "Produk berhasil ditambahkan ke keranjang.";
header("Location: cart.php");
exit();
?>
