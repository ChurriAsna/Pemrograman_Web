<?php
include "koneksi.php";

$status = '';
$result = '';
if ($_SERVER['REQUEST_METHOD'] === 'GET'){

    if (isset($_GET['customerNumber'])) {
        //query SQL
        $id_bus_upd = $_GET['id_bus'];
        $query = "SELECT * FROM bus WHERE id_bus = '$id_bus_upd'";

        //eksekusi query
        $result = mysqli_query(connection(),$query);
    }
}

//melakukan pengecekan apakah ada form yang dipost
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $id_bus = $_POST['id_bus'];
    $plat = $_POST['plat'];
    $status = $_POST['status'];

    //query SQL
    $sql = "UPDATE bus SET plat='$plat', status='$status' WHERE id_bus='$id_bus'";

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
<html lang="en">
<head>
    <title>Update Bus</title>
</head>
<body>

    <main>

    <h2>Update Data Bus</h2>
    <form action="updateBus.php" method="POST">
    
    <?php while($data = mysqli_fetch_array($result)): ?>
    <table>
        <tr>
            <td width="200">ID Bus</td>
            <td><input type="text" name="id_bus" value="<?php echo $data['id_bus'];  ?>"></td>
        </tr>
        <tr>
            <td width="200">Plat</td>
            <td><input type="text" name="plat" value="<?php echo $data['plat'];  ?>"></td>
        </tr>
        <tr>
            <td width="200">Status</td>
            <td><input type="text" name="status" value="<?php echo $data['status'];  ?>"></td>
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