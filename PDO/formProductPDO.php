<?php 
  include ('conn.php'); 

  $status = '';
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
    
    $query = $conn->prepare("INSERT INTO products VALUES ('$productCode', '$productName', '$productLine', '$productScale', '$productVendor', '$productDescription', '$quantityInStock', '$buyPrice', '$buyPrice')");

    $query->bindParam(':productCode',$productCode);
    $query->bindParam(':productName',$productName);
    $query->bindParam(':productLine',$productLine);
    $query->bindParam(':productScale',$productScale);
    $query->bindParam(':productVendor',$productVendor);
    $query->bindParam(':productDescription',$productDescription);
    $query->bindParam(':quantityInStock',$quantityInStock);
    $query->bindParam(':buyPrice',$buyPrice);
    $query->bindParam(':MSRP',$MSRP);

    //eksekusi query
    if ($query->execute()) {
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

</head>

<body>
    <a href="tampilPDO.php">LIHAT DATA <br><br></a>
    <a href="<?php echo "formCustomersPDO.php"; ?>">TAMBAH DATA CUSTOMERS <br></a>
    <br>
    <a href="<?php echo "formProductPDO.php"; ?>">TAMBAH DATA PRODUCT <br></a>

    <main>

    <?php 
        if ($status=='ok') {
        echo '<br><br><div class="alert alert-success" role="alert">Data Customers berhasil disimpan</div>';
        }
        elseif($status=='err'){
        echo '<br><br><div class="alert alert-danger" role="alert">Data Customers gagal disimpan</div>';
        }
    ?>
    
    <h2>Form Data Product</h2>
    
    <form method="POST" action="formCustomersPDO.php">
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
    </main>
</body>
</html>