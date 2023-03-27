<?php 
//memanggil file koneksi.php yang berisi koneksi ke database
//dengan include, semua kode dalam file koneksi.php dapat digunakan pada file tampildb.php
  include ('koneksi.php'); 

  $status = '';
  //melakukan pengecekan apakah ada form yang dipost
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    //Products
    $productCode = $_POST['productCode'];
    $productName = $_POST['productName'];
    $productLine = $_POST['productLine'];
    $productScale = $_POST['productScale'];
    $productVendor = $_POST['productVendor'];
    $productDescription = $_POST['productDescription'];
    $quantityInStock = $_POST['quantityInStock'];
    $buyPrice = $_POST['buyPrice'];
    $MSRP = $_POST['MSRP'];
    
    //query SQL
    $query = "INSERT INTO products VALUES ('$productCode', '$productName', '$productLine', 
    '$productScale', '$productVendor', '$productDescription', '$quantityInStock', 
    '$buyPrice', '$buyPrice')";
    
    //eksekusi query
    $result = mysqli_query(connection(),$query);
    if ($result) {
        $status = 'ok';
    }
    else{
        $status = 'err';
    }
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Form Product</title>
</head>
<body>
    <div>
        <br>
        <a href="<?php echo "tampildb.php"; ?>">Tampilkan data</a>
        <br>
        <br>
        <a href="<?php echo "formCustomers.php"; ?>">Masukkan data customer</a>
        <br>
        <br>
        <a href="<?php echo "formProducts.php"; ?>">Masukkan data produk</a>
        <br>
    </div>

    <?php 
    if ($status=='ok') {
        echo '<br><br><div class="alert alert-success" role="alert">Data Customers berhasil disimpan</div>';
        }
    elseif($status=='err'){
        echo '<br><br><div class="alert alert-danger" role="alert">Data Customers gagal disimpan</div>';
    }
    ?>

    <h2>Form Data Product</h2>
    
    <form method="POST" action="formCustomers.php">
    <table>
        <tr class="form-group">
            <td width="200">Product Code</td>
            <td><input type="text" name="productCode"></td>
        </tr>
        <tr class="form-group">
            <td>Product Name</td>
            <td><input type="text" name="productName"></td>
        </tr>
        <tr class="form-group">
            <td>Product Line</td>
            <td><input type="text" name="productLine"></td>
        </tr>
        <tr class="form-group">
            <td>Product Scale</td>
            <td><input type="text" name="productScale"></td>
        </tr>
        <tr class="form-group">
            <td>Product Vendor</td>
            <td><input type="text" name="productVendor"></td>
        </tr>
        <tr class="form-group">
            <td>Product Description</td>
            <td><input type="text" name="productDescription"></td>
        </tr>
        <tr class="form-group">
            <td>Quantity In Stock</td>
            <td><input type="text" name="quantityInStock"></td>
        </tr>
        <tr class="form-group">
            <td>Buy Price</td>
            <td><input type="text" name="buyPrice"></td>
        </tr>
        <tr class="form-group">
            <td>MSRP</td>
            <td><input type="text" name="MSRP"></td>
        </tr>
        <tr>
            <td></td>
            <td><button type="submit" class="btn btn-primary">Simpan</button></td>
        </tr>
    </table>
    </form>
    
</body>
</html>