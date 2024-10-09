<?php
// update_cart.php
session_start();
require_once 'includes/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['quantities'])) {
    foreach($_POST['quantities'] as $id => $quantity){
        $id = intval($id);
        $quantity = intval($quantity);
        
        // Memeriksa apakah produk masih tersedia
        $stmt = $conn->prepare("SELECT stock FROM products WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($stock);
        $stmt->fetch();
        $stmt->close();
        
        if($quantity > $stock){
            $_SESSION['error'] = "Jumlah pesanan untuk produk ID $id melebihi stok yang tersedia.";
            header("Location: cart.php");
            exit();
        }
        
        if(isset($_SESSION['cart'][$id])){
            $_SESSION['cart'][$id]['quantity'] = $quantity;
        }
    }
    $_SESSION['success'] = "Keranjang belanja diperbarui.";
}

header("Location: cart.php");
exit();
?>
