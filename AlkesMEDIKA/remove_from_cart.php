<?php
// remove_from_cart.php
session_start();

if(isset($_GET['id'])){
    $id = intval($_GET['id']);
    if(isset($_SESSION['cart'][$id])){
        unset($_SESSION['cart'][$id]);
        $_SESSION['success'] = "Produk berhasil dihapus dari keranjang.";
    }
}

header("Location: cart.php");
exit();
?>
