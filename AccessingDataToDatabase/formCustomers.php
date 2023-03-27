<?php 
//memanggil file koneksi.php yang berisi koneksi ke database
//dengan include, semua kode dalam file koneksi.php dapat digunakan pada file tampildb.php
  include ('koneksi.php'); 

  $status = '';
  //melakukan pengecekan apakah ada form yang dipost
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    //Customers
    $customerNumber = $_POST['customerNumber'];
    $customerName = $_POST['customerName'];
    $contactLastName = $_POST['contactLastName'];
    $contactFirstName = $_POST['contactFirstName'];
    $phone = $_POST['phone'];
    $addressLine1 = $_POST['addressLine1'];
    $addressLine2 = $_POST['addressLine2'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $postalCode = $_POST['postalCode'];
    $country = $_POST['country'];
    $salesRepEmployeeNumber = $_POST['salesRepEmployeeNumber'];
    $creditLimit = $_POST['creditLimit'];
    
    //query SQL
    $query = "INSERT INTO customers VALUES('$customerNumber', '$customerName', '$contactLastName', 
    '$contactFirstName', '$phone', '$addressLine1', '$addressLine2', '$city', '$state', 
    '$postalCode', '$country', '$salesRepEmployeeNumber', '$creditLimit')"; 

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
    <title>Form Customer</title>
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

    <h2>Form Data Customer</h2>
    
    <form method="POST" action="formCustomers.php">
    <table>
        <tr class="form-group">
            <td width="200">Customer Number</td>
            <td><input type="text" name="customerNumber"></td>
        </tr>
        <tr class="form-group">
            <td>Customer Name</td>
            <td><input type="text" name="customerName"></td>
        </tr>
        <tr class="form-group">
            <td>Contact Last Name</td>
            <td><input type="text" name="contactLastName"></td>
        </tr>
        <tr class="form-group">
            <td>Contact First Name</td>
            <td><input type="text" name="contactFirstName"></td>
        </tr>
        <tr class="form-group">
            <td>Phone</td>
            <td><input type="text" name="phone"></td>
        </tr>
        <tr class="form-group">
            <td>Address Line 1</td>
            <td><input type="text" name="addressLine1"></td>
        </tr>
        <tr class="form-group">
            <td>Address Line 2</td>
            <td><input type="text" name="addressLine2"></td>
        </tr>
        <tr class="form-group">
            <td>City</td>
            <td><input type="text" name="city"></td>
        </tr>
        <tr class="form-group">
            <td>State</td>
            <td><input type="text" name="state"></td>
        </tr>
        <tr class="form-group">
            <td>Postal Code</td>
            <td><input type="text" name="postalCode"></td>
        </tr>
        <tr class="form-group">
            <td>Country</td>
            <td><input type="text" name="country"></td>
        </tr>
        <tr class="form-group">
            <td>Sales Rep Employee Number</td>
            <td><input type="text" name="salesRepEmployeeNumber"></td>
        </tr>
        <tr class="form-group">
            <td>Credit Limit</td>
            <td><input type="text" name="creditLimit"></td>
        </tr>
        <tr>
            <td></td>
            <td><button type="submit" class="btn btn-primary">Simpan</button></td>
        </tr>
    </table>
    </form>

</body>
</html>