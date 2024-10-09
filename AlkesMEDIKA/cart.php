<?php
// cart.php
// session_start();
// require_once 'includes/config.php';

// $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
// $total = 0;
// ?>
<!--------------------------------------------------------------------------------------------------
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
require 'D:/App/XAMPP/Pasang/htdocs/AlkesMEDIKA/includes/config.php';

// Mengambil data keranjang belanja dari sesi
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$total = 0;
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

<?php include 'header.php'; ?>

<h2>Keranjang Belanja</h2>

<?php if(isset($_SESSION['success'])): ?>
    <div class="alert alert-success">
        <?= htmlspecialchars($_SESSION['success']) ?>
        <?php unset($_SESSION['success']); ?>
    </div>
<?php endif; ?>

<?php if(isset($_SESSION['error'])): ?>
    <div class="alert alert-danger">
        <?= htmlspecialchars($_SESSION['error']) ?>
        <?php unset($_SESSION['error']); ?>
    </div>
<?php endif; ?>

<?php if(!empty($cart)): ?>
    <form action="update_cart.php" method="POST">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($cart as $id => $item): 
                    $subtotal = $item['price'] * $item['quantity'];
                    $total += $subtotal;
                ?>
                    <tr>
                        <td><?= array_search($id, array_keys($cart)) + 1 ?></td>
                        <td><?= htmlspecialchars($item['name']) ?></td>
                        <td>
                            <input type="number" name="quantities[<?= $id ?>]" value="<?= htmlspecialchars($item['quantity']) ?>" min="1" max="100" class="form-control">
                        </td>
                        <td>Rp <?= number_format($item['price'], 2, ',', '.') ?></td>
                        <td>Rp <?= number_format($subtotal, 2, ',', '.') ?></td>
                        <td>
                            <a href="remove_from_cart.php?id=<?= $id ?>" class="btn btn-danger btn-sm">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="4" class="text-end"><strong>Total Belanja</strong></td>
                    <td colspan="2"><strong>Rp <?= number_format($total, 2, ',', '.') ?></strong></td>
                </tr>
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary">Update Keranjang</button>
        <a href="checkout.php" class="btn btn-success">Checkout</a>
    </form>
<?php else: ?>
    <p>Keranjang belanja Anda kosong.</p>
<?php endif; ?>

<?php include 'footer.php'; ?>
