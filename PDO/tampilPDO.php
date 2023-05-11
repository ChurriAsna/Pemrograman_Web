<?php
include ('conn.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>PDO</title>
</head>

<body>
    <a href="formCustomersPDO.php">TAMBAH DATA CUSTOMERS<p> </p></a>
    <br>
    <a href="formProductPDO.php">TAMBAH DATA PRODUCT<p> </p></a>
    
    <main>
        <?php 
            if (@$_GET['status']!==NULL) {
              $status = $_GET['status'];
              if ($status=='ok') {
                echo '<br><br><div class="alert alert-success" role="alert">Data Perusahaan berhasil di-update</div>';
              }
              elseif($status=='err'){
                echo '<br><br><div class="alert alert-danger" role="alert">Data Perusahaan gagal di-update</div>';
              }
            }
        ?>

        <main>
            <h1 align="center" style="margin: 30px 0 30px 0;">TABEL CUSTOMER</h1>
            <table border="3" align = "center" cellpadding = "5" cellspacing="0" style = margin: 30px text-align = center>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Customer Number</th>
                        <th>Customer Name</th>
                        <th>Contact Last Name</th>
                        <th>Contact First Name</th>
                        <th>Phone</th>
                        <th>Address Line 1</th>
                        <th>Address Line 2</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Postal Code</th>
                        <th>Country</th>
                        <th>Sales RepEmployee Number	</th>
                        <th>Credit Limit</th>
                    </tr><td></td>
                </thead>

                <tbody>
                    <?php
                        $no=1;
                        $query = "SELECT * FROM customers";
                        
                        $result =  $conn->query($query);
                    ?>
                    
                    <?php while($data = $result->fetch(PDO::FETCH_ASSOC) ): ?>
                        <tr>
                            <td><?php echo $data['customerNumber']; ?></td>
                            <td><?php echo $data['customerName']; ?></td>
                            <td><?php echo $data['contactLastName']; ?></td>
                            <td><?php echo $data['contactFirstName']; ?></td>
                            <td><?php echo $data['phone']; ?></td>
                            <td><?php echo $data['addressLine1']; ?></td>
                            <td><?php echo $data['addressLine2']; ?></td>
                            <td><?php echo $data['city']; ?></td>
                            <td><?php echo $data['state']; ?></td>
                            <td><?php echo $data['postalCode']; ?></td>
                            <td><?php echo $data['country']; ?></td>
                            <td><?php echo $data['salesRepEmployeeNumber']; ?></td>
                            <td><?php echo $data['creditLimit']; ?></td>
                            <td>
                                <a href="<?php echo "updateCustomersPDO.php?customerNumber=".$data['customerNumber']; ?>">UPDATE</a>
                                <a href="<?php echo "deleteCustomersPDO.php?customerNumber=".$data['customerNumber']; ?>">DELETE</a>
                            </td>
                        </tr>
                    <?php $no++; ?>
                    <?php endwhile ?>
                </tbody>
            </table>

            <h1 align="center" style="margin: 30px 0 30px 0;">TABEL PRODUCT</h1>
            <table border="3" align = "center" cellpadding = "5" cellspacing="0" style = margin: 30px text-align = center>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Produk</th>
                        <th>Nama Produk</th>
                        <th>Jenis Produk</th>
                        <th>Ukuran Skala Produk</th>
                        <th>Vendor Produk</th>
                        <th>Deskripsi Produk</th>
                        <th>Jumlah Stock</th>
                        <th>Harga Beli</th>
                        <th>MSRP</th>
                    </tr><td></td>
                </thead>

                <tbody>
                    <?php
                        $no=1;
                        $query1 = "SELECT * FROM products";
                        
                        $result1 =  $conn->query($query1);
                    ?>
                    
                    <?php while($data = mysqli_fetch_array($result1)): ?>
                        <tr>
                            <td><?php echo $data['productCode']; ?></td>
                            <td><?php echo $data['productName']; ?></td>
                            <td><?php echo $data['productLine']; ?></td>
                            <td><?php echo $data['productScale']; ?></td>
                            <td><?php echo $data['productVendor']; ?></td>
                            <td><?php echo $data['productDescription']; ?></td>
                            <td><?php echo $data['quantityInStock']; ?></td>
                            <td><?php echo $data['buyPrice']; ?></td>
                            <td><?php echo $data['MSRP']; ?></td>
                            <td>
                                <a href="<?php echo "updateProductsPDO.php?productCode=".$data['productCode']; ?>">UPDATE DATA PRODUK</a>
                                <a href="<?php echo "deleteProductsPDO.php?productCode=".$data['productCode']; ?>">DELETE DATA PRODUK</a>
                            </td>
                        </tr>
                    <?php $no++; ?>
                    <?php endwhile ?>
                </tbody>
            </table>
        </main>
    </main>
</body>
</html>