<?php
include ('koneksi.php');
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Penghasilan Driver</title>
  </head>

  <body>
    <div>
        <br>
        <a href="<?php echo "tampil.php"; ?>">Data Tabel</a>
        <br><br>
        <a href="<?php echo "formBus.php"; ?>">Masukkan data Bus</a>
        <br><br>
        <a href="<?php echo "formDriver.php"; ?>">Masukkan data Driver</a>
        <br><br>
        <a href="<?php echo "formKondektur.php"; ?>">Masukkan data Kodektur</a>
        <br><br>
        <a href="<?php echo "formTransupn.php"; ?>">Masukkan data Trasn UPN</a>
    </div>

    <main>
        <h2>Penghasilan Driver</h2>
        <form action="" method="POST">
            <table>
                <tr>
                    <td>ID Driver</td>
                    <td><input type="text" class="form-control" name="id_driver" required="required"></td>
                </tr>
                <tr>
                    <td for="bulan">Pilih Bulan</td>
                    <td>
                        <select name="bulan" class="form-control" id="bulan">
                            <option value="01">Januari</option>
                            <option value="02">Februari</option>
                            <option value="03">Maret</option>
                            <option value="04">April</option>
                            <option value="05">Mei</option>
                            <option value="06">Juni</option>
                            <option value="07">Juli</option>
                            <option value="08">Agustus</option>
                            <option value="09">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" class="btn btn-primary" name="submit" value="Hitung"></td>
                </tr>
            </table>
        </form>

        <?php
          if (isset($_POST['submit'])) {
            $id_driver = $_POST['id_driver'];
            $bulan = $_POST['bulan'];
            $query = "SELECT * FROM trans_upn WHERE id_driver = $id_driver AND MONTH(tanggal) = $bulan";
            $result = mysqli_query(connection(),$query);

            $total_gaji_driver = 0;

            while ($row = mysqli_fetch_array($result)) {
              $id_driver = $row['id_driver'];
              $jumlah_km = $row['jumlah_km'];

              $gaji_driver = $jumlah_km * 3000;

              $total_gaji_driver += $gaji_driver;
            }
            echo"<br><br>";
            echo "<h2 >Penghasilan Driver dengan ID $id_driver pada bulan " . date("F", mktime(0, 0, 0, $bulan, 10)) . "</h2>";
            echo "<div class ='form-control'> Total Gaji Driver: <b>Rp " . number_format($total_gaji_driver, 0, ',', '.') . "</b></div>";
          }
          ?>
    </main>
  </body>
</html>