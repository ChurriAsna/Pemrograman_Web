<?php
//memanggil file koneksi.php yang berisi koneksi ke database
//dengan include, semua kode dalam file koneksi.php dapat digunakan pada file tampildb.php
include "koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Halaman Utama</title>
</head>
<body>
    <div>
        <br>
        <a href="<?php echo "formCustomers.php"; ?>">Masukkan data customer</a>
        <br>
        <br>
        <a href="<?php echo "formProducts.php"; ?>">Masukkan data produk</a>
        <br>
    </div>
    <h1 align="center" style="margin: 30px 0 30px 0;">TABEL CUSTOMER</h1>
    <div id="Customers"></div>
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
        </tr>
    </thead>
    <tbody>
        <?php 
            //proses menampilkan data dari database:
            //siapkan query SQL
            $query = "SELECT * FROM customers";
            $result = mysqli_query(connection(),$query);
        ?>

        <?php
            $no=1;
            while ($tampil = mysqli_fetch_array($result)){
                echo "
                    <td align='center'>$no</td>
                    <td align='center'>$tampil[customerNumber]</td>
                    <td align='center'>$tampil[customerName]</td>
                    <td align='center'>$tampil[contactLastName]</td>
                    <td align='center'>$tampil[contactFirstName]</td>
                    <td align='center'>$tampil[phone]</td>
                    <td align='center'>$tampil[addressLine1]</td>
                    <td align='center'>$tampil[addressLine2]</td>
                    <td align='center'>$tampil[city]</td>
                    <td align='center'>$tampil[state]</td>
                    <td align='center'>$tampil[postalCode]</td>
                    <td align='center'>$tampil[country]</td>
                    <td align='center'>$tampil[salesRepEmployeeNumber]</td>
                    <td align='center'>$tampil[creditLimit]</td>
                </tr>";
                $no++;
            }
        ?>
    </tbody>
    </table>
    </div>

    <h1 align=center>TABEL PRODUK</h1>
    <div id="Products">
        <table border="3" align = "center" cellpadding = "5" cellspacing="0" style = margin: 30px text-align = center>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Product Code</th>
                    <th>Product Name</th>
                    <th>Product Line</th>
                    <th>Product Scale</th>
                    <th>Product Vendor</th>
                    <th>Product Description</th>
                    <th>Quantity In Stock</th>
                    <th>Buy Price</th>
                    <th>MSRP</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                  //proses menampilkan data dari database:
                  //siapkan query SQL
                  $query = "SELECT * FROM products";
                  $result = mysqli_query(connection(),$query);
                 ?>

                <?php
                    $no=1;
                    while ($tampil = mysqli_fetch_array($result)){
                        echo "
                            <td align='center'>$no</td>
                            <td align='center'>$tampil[productCode]</td>
                            <td align='center'>$tampil[productName]</td>
                            <td align='center'>$tampil[productLine]</td>
                            <td align='center'>$tampil[productScale]</td>
                            <td align='center'>$tampil[productVendor]</td>
                            <td align='justify'>$tampil[productDescription]</td>
                            <td align='center'>$tampil[quantityInStock]</td>
                            <td align='center'>$tampil[buyPrice]</td>
                            <td align='center'>$tampil[MSRP]</td>
                        </tr>";
                        $no++;
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
