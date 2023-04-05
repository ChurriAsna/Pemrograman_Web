<?php
  include ('koneksi.php');

  $status = '';
  $result = '';

  //melakukan pengecekan apakah ada variable GET yang dikirim
  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      if (isset($_GET['id_trans_upn'])) {

          //query SQL
          $id_trans_upn_upd = $_GET['id_trans_upn'];
          $query = "SELECT * FROM trans_upn WHERE id_trans_upn = '$id_trans_upn_upd'";

          //eksekusi query
          $result = mysqli_query(connection(),$query);
      }
  }

  //melakukan pengecekan apakah ada form yang dipost
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $id_trans_upn = $_POST['id_trans_upn'];
      $id_kondektur = $_POST['id_kondektur'];
      $id_bus = $_POST['id_bus'];
      $id_driver = $_POST['id_driver'];
      $jumlah_km = $_POST['jumlah_km'];
      $tanggal = $_POST['tanggal'];

      //query SQL
      $sql = "UPDATE trans_upn SET id_kondektur='$id_kondektur', id_bus='$id_bus', id_driver='$id_driver', jumlah_km='$jumlah_km', tanggal='$tanggal' WHERE id_trans_upn='$id_trans_upn'";

      //eksekusi query
      $result = mysqli_query(connection(),$sql);
      if ($result) {
        $status = 'ok';
      }
      else{
        $status = 'err';
      }

      //redirect ke halaman lain
      header('Location: tampil.php?status='.$status);
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Update Data Trans UPN</title>
  </head>

  <body>
        <div>
            <br>
            <a href="<?php echo "tampil.php"; ?>">Data Bus</a>
            <br><br>
            <a href="<?php echo "formDriver.php"; ?>">Masukkan data Driver</a>
            <br><br>
            <a href="<?php echo "formKondektur.php"; ?>">Masukkan data Kodektur</a>
            <br><br>
            <a href="<?php echo "formTransupn.php"; ?>">Masukkan data Trasn UPN</a>
        </div>
        <main">
id_kondektur='$id_kondektur', id_bus='$id_bus', id_driver='$id_driver', 
jumlah_km='$jumlah_km', tanggal='$tanggal' WHERE id_trans_upn='$id_trans_upn'
          <h2>Update Data Trans UPN</h2>
          <form action="updateTransupn.php" method="POST">
            <?php while($data = mysqli_fetch_array($result)): ?>
                <table>
                    <tr>
                        <td width="200">ID Trans UPN</td>
                        <td><input type="text" name="id_trans_upn" value="<?php echo $data['id_trans_upn'];  ?>"></td>
                    </tr>
                    <tr>
                        <td width="200">ID Kondektur</td>
                        <td><input type="text" name="id_kondektur" value="<?php echo $data['id_kondektur'];  ?>"></td>
                    </tr>
                    <tr>
                        <td width="200">ID Bus</td>
                        <td><input type="text" name="id_bus" value="<?php echo $data['id_bus'];  ?>"></td>
                    </tr>
                    <tr>
                        <td width="200">ID Driver</td>
                        <td><input type="text" name="id_driver" value="<?php echo $data['id_driver'];  ?>"></td>
                    </tr>
                    <tr>
                        <td width="200">Jumlah km</td>
                        <td><input type="text" name="jumlah_km" value="<?php echo $data['jumlah_km'];  ?>"></td>
                    </tr>
                    <tr>
                        <td width="200">tanggal</td>
                        <td><input type="text" name="tanggal" value="<?php echo $data['tanggal'];  ?>"></td>
                    </tr>
                </table>

            <?php endwhile; ?>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </form>
          
        </main>
  </body>
</html>