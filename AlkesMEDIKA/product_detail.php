<?php
// product_detail.php
session_start();
require_once 'includes/config.php';

if (!isset($_GET['id'])) {
    header("Location: product.php");
    exit();
}

$product_id = intval($_GET['id']);

// Mengambil detail produk
$stmt = $conn->prepare("SELECT p.id, p.name, p.description, p.price, p.image, p.stock, c.name AS category_name 
                        FROM products p 
                        JOIN categories c ON p.category_id = c.id 
                        WHERE p.id = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows == 0){
    header("Location: product.php");
    exit();
}

$product = $result->fetch_assoc();
$stmt->close();
?>

<?php include 'header.php'; ?>

<h2><?= htmlspecialchars($product['name']) ?></h2>

<div class="row">
    <div class="col-md-6">
        <img src="assets/img/<?= htmlspecialchars($product['image']) ?>" class="img-fluid" alt="<?= htmlspecialchars($product['name']) ?>">
    </div>
    <div class="col-md-6">
        <h4>Deskripsi Produk</h4>
        <p><?= nl2br(htmlspecialchars($product['description'])) ?></p>
        <h4>Harga: Rp <?= number_format($product['price'], 2, ',', '.') ?></h4>
        <h4>Stok: <?= htmlspecialchars($product['stock']) ?></h4>
        <?php if($product['stock'] > 0): ?>
            <a href="add_to_cart.php?id=<?= $product['id'] ?>" class="btn btn-success">Tambah ke Keranjang</a>
        <?php else: ?>
            <button class="btn btn-secondary" disabled>Stok Habis</button>
        <?php endif; ?>
    </div>
</div>

<?php include 'footer.php'; ?>
