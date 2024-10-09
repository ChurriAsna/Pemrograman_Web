<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk AlkesMEDIKA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php
// product.php
session_start();
require_once('D:/App/XAMPP/Pasang/htdocs/AlkesMEDIKA/includes/config.php');

// Mengambil semua produk dengan kategori
$sql = "SELECT p.id, p.name, p.description, p.price, p.image, p.stock, c.name AS category_name 
        FROM products p 
        JOIN categories c ON p.category_id = c.id";
$result = $conn->query($sql);
?>
<?php include 'header.php'; ?>
<div class="container mt-5">
    <div class="row">
        <!-- Kolom Kiri untuk Card Produk -->
        <div class="col-lg-8">
            <h2>Produk</h2><br>
            <div class="row">
                <?php if($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <div class="col-md-6 mb-4"> <!-- Mengubah ukuran kolom menjadi 6 untuk dua card per baris -->
                            <div class="card mb-4">
                                <img src="assets/img/<?= htmlspecialchars($row['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($row['name']) ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?= htmlspecialchars($row['name']) ?></h5>
                                    <p class="card-text"><?= htmlspecialchars($row['description']) ?></p>
                                    <p class="card-text"><strong>Harga: Rp <?= number_format($row['price'], 2, ',', '.') ?></strong></p>
                                    <a href="product_detail.php?id=<?= $row['id'] ?>" class="btn btn-primary">View</a>
                                    <a href="add_to_cart.php?id=<?= $row['id'] ?>" class="btn btn-success">Buy</a>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>Tidak ada produk tersedia.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Kolom Kanan untuk Informasi Tambahan -->
        <div class="col-lg-4">
            <div class="card mb-4 h-100">
                <div class="card-body">
                    <h2>Kategori Produk</h2> <br>
                    <ul class="list-group">
                        <li class="list-group-item">Peralatan medis</li>
                        <li class="list-group-item">Peralatan medis habis pakai</li>
                        <li class="list-group-item">Peralatan bedah</li>
                    </ul>
                </div>
            </div>
            
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
