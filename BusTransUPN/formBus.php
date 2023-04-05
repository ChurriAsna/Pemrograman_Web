<?php
include "koneksi.php";

$result = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST'){

    //BUS
    $id_bus=$_POST['id_bus'];
    $plat=$_POST['plat'];
    $status=$_POST['status'];

    //query mysql
    $query="INSERT INTO Bus VALUES ('$id_bus', '$plat', '$status')";

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
<html lang="en">
<head>
    <title>Form Bus</title>
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
              if ($result=='ok') {
                echo '<br><br><div class="alert alert-success" role="alert">Data Products berhasil disimpan</div>';
              }
              elseif($result=='err'){
                echo '<br><br><div class="alert alert-danger" role="alert">Data Products gagal disimpan</div>';
              }
           ?>

    <h2>Form Bus</h2>
    <form action="formBus.php" method="POST">
    <table>
        <tr>
            <td width="200">ID Bus</td>
            <td><input type="text" name="id_bus"></td>
        </tr>
        <tr>
            <td width="200">Plat</td>
            <td><input type="text" name="plat"></td>
        </tr>
        <tr>
            <td width="200">Status</td>
            <td><input type="text" name="status"></td>
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