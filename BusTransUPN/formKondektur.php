<?php 
  include ('koneksi.php'); 

  $status = '';
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //KONDEKTUR
    $id_kondektur = $_POST['id_kondektur'];
    $nama = $_POST['nama'];
    
    //query mysql
    $query = "INSERT INTO kondektur VALUES('$id_kondektur', '$nama')"; 

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
    <title>Form Kondektur</title>
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

          <h2>Form Kondektur</h2>
          <form action="formKondektur.php" method="POST">
            <table>
                <tr>
                    <td width="200">ID Kondekut</td>
                    <td><input type="text" name="id_kondektur"></td>
                </tr>
                <tr>
                    <td width="200">Nama</td>
                    <td><input type="text" name="nama"></td>
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