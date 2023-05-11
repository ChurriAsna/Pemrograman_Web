<?php
include ('conn.php');

$status = '';
$result = '';
$query = '';

//melakukan pengecekan apakah ada variable GET yang dikirim
if ($_SERVER['REQUEST_METHOD'] === 'GET') 
{
    if (isset($_GET['productCode'])) 
    {
        //query SQL
        $productCode_upd = $_GET['productCode'];
        $query = $conn->prepare("SELECT * FROM products WHERE productCode = '$productCode_upd'");
        
        //binding data
        $query->bindParam(':productCode',$productCode);
        
        //eksekusi query
        $query->execute(); 
    }
}

//melakukan pengecekan apakah ada form yang dipost
if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
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
    $query = $conn->prepare("UPDATE products SET productName='$productName', productLine='$productLine', productScale='$productScale', productVendor='$productScale',productDescription='$productDescription', quantityInStock='$quantityInStock', buyPrice='$buyPrice', MSRP='$MSRP' 
    WHERE productCode='$productCode'");
    
    //binding data
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
    if ($query->execute()) 
    {
        $status = 'ok';
    }
    else
    {
        $status = 'err';
    }

    //redirect ke halaman lain
    header('Location: tampilPDO.php?status='.$status);
  }

?>


<!DOCTYPE html>
<html>
  <head>

  </head>

  <body>
    <a href="tampilPDO.php">LIHAT DATA <br><br></a>
    <a href="<?php echo "formCustomersPDO.php"; ?>">TAMBAH DATA CUSTOMERS <br></a>
    <br>
    <a href="<?php echo "formProductPDO.php"; ?>">TAMBAH DATA PRODUCT <br></a>

    <main>
    <h2>Update data product</h2>
    <form action="updateProductPDO.php" methode='POST'>
    <?php while($data = $query->fetch(PDO::FETCH_ASSOC)): ?>
            <table>
                <tr class="form-group">
                    <td width="200">Product Code</td>
                    <td><input type="text" name="productCode" value="<?php echo $data['productCode']; ?>" required="required" readonly></td>
                </tr>
                <tr class="form-group">
                    <td>Product Name</td>
                    <td><input type="text" name="productName" value="<?php echo $data['productName']; ?>" required="required"></td>
                </tr>
                <tr class="form-group">
                    <td>Product Line</td>
                    <td><input type="text" name="productLine" value="<?php echo $data['productLine']; ?>" required="required"></td>
                </tr>
                <tr class="form-group">
                    <td>Product Scale</td>
                    <td><input type="text" name="productScale" value="<?php echo $data['productScale']; ?>" required="required"></td>
                </tr>
                <tr class="form-group">
                    <td>Product Vendor</td>
                    <td><input type="text" name="productVendor" value="<?php echo $data['productVendor']; ?>" required="required"></td>
                </tr>
                <tr class="form-group">
                    <td>Product Description</td>
                    <td><input type="text" name="productDescription" value="<?php echo $data['productDescription']; ?>" required="required"></td>
                </tr>
                <tr class="form-group">
                    <td>Quantity In Stock</td>
                    <td><input type="text" name="quantityInStock" value="<?php echo $data['quantityInStock']; ?>" required="required"></td>
                </tr>
                <tr class="form-group">
                    <td>Buy Price</td>
                    <td><input type="text" name="buyPrice" value="<?php echo $data['buyPrice']; ?>" required="required"></td>
                </tr>
                <tr class="form-group">
                    <td>MSRP</td>
                    <td><input type="text" name="MSRP" value="<?php echo $data['MSRP']; ?>" required="required"></td>
                </tr>
            </table>
            <?php endwhile; ?>
                <tr>
                    <td></td>
                    <td><input type="submit" value="Simpan" name="simpan"></td>
                </tr>
    </form>
    </main>
  </body>
</html>