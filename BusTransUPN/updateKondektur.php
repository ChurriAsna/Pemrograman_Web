<?php
  include ('koneksi.php');

  $status = '';
  $result = '';

  //melakukan pengecekan apakah ada variable GET yang dikirim
  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      if (isset($_GET['id_kondektur'])) {

          //query SQL
          $id_kondektur_upd = $_GET['id_kondektur'];
          $query = "SELECT * FROM kondektur WHERE id_kondektur = '$id_kondektur_upd'";

          //eksekusi query
          $result = mysqli_query(connection(),$query);
      }
  }

  //melakukan pengecekan apakah ada form yang dipost
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $id_konduetur = $_POST['id_kondektur'];
      $nama = $_POST['nama'];

      //query SQL
      $sql = "UPDATE kondektur SET nama='$nama' WHERE id_kondektur='$id_kondektur'";

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
    <title>Update Kondektur</title>
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

          <h2>Update Data Kondektur</h2>
          <form action="updateKondektur.php" method="POST">
            <?php while($data = mysqli_fetch_array($result)): ?>
                <table>
                    <tr>
                        <td width="200">ID Kondektur</td>
                        <td><input type="text" name="id_kondektur" value="<?php echo $data['id_kondektur'];  ?>"></td>
                    </tr>
                    <tr>
                        <td width="200">Nama</td>
                        <td><input type="text" name="nama" value="<?php echo $data['nama'];  ?>"></td>
                    </tr>
                </table>

            <?php endwhile; ?>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </form>
          
        </main>
  </body>
</html>