<?php
  include ('koneksi.php');

  $status = '';
  $result = '';

  //melakukan pengecekan apakah ada variable GET yang dikirim
  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      if (isset($_GET['id_driver'])) {

          //query SQL
          $id_driver_upd = $_GET['id_driver'];
          $query = "SELECT * FROM driver WHERE id_driver = '$id_driver_upd'";

          //eksekusi query
          $result = mysqli_query(connection(),$query);
      }
  }

  //melakukan pengecekan apakah ada form yang dipost
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $id_driver = $_POST['id_driver'];
      $nama = $_POST['nama'];
      $no_sim = $_POST['no_sim'];
      $alamat = $_POST['alamat'];

      //query SQL
      $sql = "UPDATE driver SET nama='$nama', no_sim='$no_sim', alamat='$alamat' WHERE id_driver='$id_driver'";

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
    <title>Update Driver</title>
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

    <main>
        <h2>Update Data Driver</h2>
        <form action="updateDriver.php" method="POST">

        <?php while($data = mysqli_fetch_array($result)): ?>
        <table>
            <tr>
                <td width="200">ID Driver</td>
                <td><input type="text" name="id_driver" value="<?php echo $data['id_driver'];  ?>"></td>
            </tr>
            <tr>
                <td width="200">Nama</td>
                <td><input type="text" name="nama" value="<?php echo $data['nama'];  ?>"></td>
            </tr>
            <tr>
                <td width="200">No SIM</td>
                <td><input type="text" name="no_sim" value="<?php echo $data['no_sim'];  ?>"></td>
            </tr>
            <tr>
                <td width="200">Alamat</td>
                <td><input type="text" name="alamat" value="<?php echo $data['alamat'];  ?>"></td>
            </tr>
            <?php endwhile; ?>
            <tr>
                <td></td>
                <td><button type="submit" class="btn btn-primary">Simpan</button></td>
            </tr>
        </table>
        </form>
    </main>
  </body>
</html>