<?php 
  include ('koneksi.php'); 

  $status = '';
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //KONDEKTUR
    $id_trans_upn = $_POST['id_trans_upn'];
    $id_kondektur = $_POST['id_kondektur'];
    $id_bus = $_POST['id_bus'];
    $id_driver = $_POST['id_driver'];
    $jumlah_km = $_POST['jumlah_km'];
    $tanggal = $_POST['tanggal'];
    
    //query mysql
    $query = "INSERT INTO trans_upn VALUES('$id_trans_upn','$id_kondektur', '$id_bus', '$id_driver', '$jumlah_km', '$tanggal')";  

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
<html>
  <head>
    <title>Form Trans UPN</title>
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
          
          <?php 
              if ($status=='ok') {
                echo '<br><br><div class="alert alert-success" role="alert">Data Kondektur berhasil disimpan</div>';
              }
              elseif($status=='err'){
                echo '<br><br><div class="alert alert-danger" role="alert">Data Kondektur gagal disimpan</div>';
              }
           ?>

          <h2>Form Trans UPN</h2>
          <form action="formDriver.php" method="POST">
            <table>
                <tr>
                    <td width="200">ID Trans UPN</td>
                    <td><input type="text" name="id_trans_upn"></td>
                </tr>
                <tr>
                    <td width="200">ID Kondektur</td>
                    <td><input type="text" name="id_kondektur"></td>
                </tr>
                <tr>
                    <td width="200">ID Bus</td>
                    <td><input type="text" name="id_bus"></td>
                </tr>
                <tr>
                    <td width="200">ID Driver</td>
                    <td><input type="text" name="id_driver"></td>
                </tr>
                <tr>
                    <td width="200">Jumlah km</td>
                    <td><input type="text" name="jumlah_km"></td>
                </tr>
                <tr>
                    <td width="200">Tanggal</td>
                    <td><input type="text" name="tanggal"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><button type="submit" class="btn btn-primary">Simpan</button></td>
                </tr>
            </table>
          </form>
        </main>
  </body>
</html>