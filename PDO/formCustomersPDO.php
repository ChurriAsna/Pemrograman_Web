<?php
include ('conn.php');

$status = '';
//pengecekan apakah ada form yang di post
if ($_SERVER['REQUEST_METHOD'] ==='POST') {
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
    $query = $conn->prepare("INSERT INTO customers VALUES('$customerNumber', '$customerName', '$contactLastName', '$contactFirstName', '$phone', '$addressLine1', '$addressLine2', '$city', '$state', '$postalCode', '$country', '$salesRepEmployeeNumber', '$creditLimit')");

    //binding data
    $query->bindParam(':customerNumber', $customerNumber);
    $query->bindParam(':customerName', $customerName);
    $query->bindParam(':contactLastName', $contactLastName);
    $query->bindParam(':contactFirstName', $contactFirstName);
    $query->bindParam(':phone', $phone);
    $query->bindParam(':addressLine1', $addressLine1);
    $query->bindParam(':addressLine2', $addressLine2);
    $query->bindParam(':city', $city);
    $query->bindParam(':state', $state);
    $query->bindParam(':postalCode', $postalCode);
    $query->bindParam(':country', $country);
    $query->bindParam(':salesRepEmployeeNumber', $salesRepEmployeeNumber);
    $query->bindParam(':creditLimit', $creditLimit);

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

    <h2>Form Data Customer</h2>
    
    <form method="POST" action="formCustomersPDO.php">
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
            <td><input type="submit" value="Simpan" name="simpan"></td>
        </tr>
    </table>
    </form>
    </main>
</body>
</html>