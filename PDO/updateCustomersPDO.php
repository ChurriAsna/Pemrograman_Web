<?php
include ('conn.php');

$status = '';
$result = '';
$query = '';

//melakukan pengecekan apakah ada variable GET yang dikirim
if ($_SERVER['REQUEST_METHOD'] === 'GET')
{
    if (isset($_GET['customerNumber'])) 
    {
        //query SQL
        $customerNumber_upd = $_GET['customerNumber'];
        $query = $conn->prepare("SELECT * FROM customers WHERE customerNumber = '$customerNumber_upd'");

        //binding data
        $query->bindParam(':customerNumber',$customerNumber_upd );
        
        //eksekusi query
        $query->execute();
    }
}

  //melakukan pengecekan apakah ada form yang dipost
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
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
    $query = $conn->prepare("UPDATE customers SET customerName='$customerName', contactLastName='$contactLastName', contactFirstName='$contactFirstName', phone='$phone', addressLine1='$addressLine1', addressLine2='$addressLine2', city='$city', state='$state', postalCode='$postalCode', country='$country', salesRepEmployeeNumber='$salesRepEmployeeNumber', creditLimit='$creditLimit'
    WHERE customerNumber='$customerNumber'");

    //binding data
    $query->bindParam(':customerNumber',$customerNumber);
    $query->bindParam(':customerName',$customerName);
    $query->bindParam(':contactLastName',$contactLastName);
    $query->bindParam(':contactFirstName',$contactFirstName);
    $query->bindParam(':phone',$phone);
    $query->bindParam(':addressLine1',$addressLine1);
    $query->bindParam(':addressLine2',$addressLine2);
    $query->bindParam(':city',$city);
    $query->bindParam(':state',$state);
    $query->bindParam(':postalCode',$postalCode);
    $query->bindParam(':country',$country);
    $query->bindParam(':salesRepEmployeeNumber',$salesRepEmployeeNumber);
    $query->bindParam(':creditLimit',$creditLimit);

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
    <h2>Update data customers</h2>
    <form action="updateCustomersPDO.php" methode='POST'>
        
    <?php //$query->execute(string(':customerNumber',$customerNumber_upd)) ?>
    <?php while($data = $query->fetch(PDO::FETCH_ASSOC)): ?>
            <table>
                <tr class="form-group">
                    <td width="200">Customer Number</td>
                    <td><input type="text" name="customerNumber" value="<?php echo $data['customerNumber']; ?>" required="required" readonly></td>
                </tr>
                <tr class="form-group">
                    <td>Customer Name</td>
                    <td><input type="text" name="customerName" value="<?php echo $data['customerName']; ?>" required="required"></td>
                </tr>
                <tr class="form-group">
                    <td>Contact Last Name</td>
                    <td><input type="text" name="contactLastName" value="<?php echo $data['contactLastName']; ?>" required="required"></td>
                </tr>
                <tr class="form-group">
                    <td>Contact First Name</td>
                    <td><input type="text" name="contactFirstName" value="<?php echo $data['contactFirstName']; ?>" required="required"></td>
                </tr>
                <tr class="form-group">
                    <td>Phone</td>
                    <td><input type="text" name="phone" value="<?php echo $data['phone']; ?>" required="required"></td>
                </tr>
                <tr class="form-group">
                    <td>Address Line 1</td>
                    <td><input type="text" name="addressLine1" value="<?php echo $data['addressLine1']; ?>" required="required"></td>
                </tr>
                <tr class="form-group">
                    <td>Address Line 2</td>
                    <td><input type="text" name="addressLine2" value="<?php echo $data['addressLine2']; ?>" required="required"></td>
                </tr>
                <tr class="form-group">
                    <td>City</td>
                    <td><input type="text" name="city" value="<?php echo $data['city']; ?>" required="required"></td>
                </tr>
                <tr class="form-group">
                    <td>State</td>
                    <td><input type="text" name="state" value="<?php echo $data['state']; ?>" required="required"></td>
                </tr>
                <tr class="form-group">
                    <td>Postal Code</td>
                    <td><input type="text" name="postalCode" value="<?php echo $data['postalCode']; ?>" required="required"></td>
                </tr>
                <tr class="form-group">
                    <td>Country</td>
                    <td><input type="text" name="country" value="<?php echo $data['country']; ?>" required="required"></td>
                </tr>
                <tr class="form-group">
                    <td>Sales Rep Employee Number</td>
                    <td><input type="text" name="salesRepEmployeeNumber" value="<?php echo $data['salesRepEmployeeNumber']; ?>" required="required"></td>
                </tr>
                <tr class="form-group">
                    <td>Credit Limit</td>
                    <td><input type="text" name="creditLimit" value="<?php echo $data['creditLimit']; ?>" required="required"></td>
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