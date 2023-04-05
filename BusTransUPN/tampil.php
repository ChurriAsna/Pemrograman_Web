<?php
include "koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>UTS</title>
    <style>
        .red{
            background-color: red;
        }
        .yellow{
            background-color: yellow;
        }
        .green{
            background-color: green;
        }
    </style>
</head>
<body>
    <div>
        <br>
        <a href="<?php echo "formBus.php"; ?>">Masukkan data Bus</a>
        <br><br>
        <a href="<?php echo "formDriver.php"; ?>">Masukkan data Driver</a>
        <br><br>
        <a href="<?php echo "formKondektur.php"; ?>">Masukkan data Kodektur</a>
        <br><br>
        <a href="<?php echo "formTransupn.php"; ?>">Masukkan data Trans UPN</a>
        <br><br>
        <a href="<?php echo "penghasilanDriver.php"; ?>">Penghasilan Driver</a>
        <br><br>
        <a href="<?php echo "penghasilanKondektur.php"; ?>">Penghasilan Kondektur</a>
    </div>

    <main>
        <?php 
            //mengecek apakah proses update dan delete sukses/gagal
            if (@$_GET['status']!==NULL) {
              $status = $_GET['status'];
              if ($status=='ok') {
                echo '<br><br><div class="alert alert-success" role="alert">Data Bus berhasil di-update</div>';
              }
              elseif($status=='err'){
                echo '<br><br><div class="alert alert-danger" role="alert">Data Bus gagal di-update</div>';
              }

            }
        ?>

    <h1 align="center" style="margin: 30px 0 30px 0;">TABEL BUS</h1>

    <form method = "get">
        <label for="status">Filter data bus berdasarkan status : </label>
            <select class="select_filter form-control" id="status_id" name="status" required>
                <option value="all">Pilih status</option>
                <option value="1" <?php if (isset($_GET['status']) && $_GET['status'] == 1) 
                    {
                        echo " selected";
                    } ?>>Beroperasi / Aktif</option>
                <option value="2" <?php if (isset($_GET['status']) && $_GET['status'] == 2) 
                    {
                        echo " selected";
                    } ?>>Cadangan</option>
                <option value="0" <?php if (isset($_GET['status']) && $_GET['status'] == 0) 
                    {
                        echo " selected";
                    } ?>>Dalam Perbaikan / Rusak</option>
            </select>
            <br><input type="submit" class="btn btn-primary" value="Filter">  
    </form>

    <div id="bus"></div>
    <table width="400px" border="3" align = "center" cellpadding = "5" cellspacing="0" style = margin: 30px text-align = center>
        <thead >
            <tr>
                <th>ID BUS</th>
                <th>PLAT</th>
                <th>STATUS</th>
                <th>KM</th>
            </tr>
        </thead>
        <tbody>
        <?php 
            $query = "SELECT * FROM bus INNER JOIN trans_upn";
            $result = mysqli_query(connection(),$query);
        ?>

            <?php $no=1; while($data = mysqli_fetch_array($result)): ?>
            <tr align = "center" class="<?php echo $data['status'] == 1? 'green' : ($data['status']==2? 'yellow' : 'red');?>">
                <td><?php echo $data['id_bus'];?></td>
                <td><?php echo $data['plat'];?></td>
                <td><?php echo $data['status'];?></td>
                <td><?php echo $data['jumlah_km'];?></td>
                <td>
                    <a href="<?php echo "updateBus.php?id_bus=".$data['id_bus']; ?>">update</a>
                    <br><br>
                    <a href="<?php echo "deleteBus.php?id_bus=".$data['id_bus']; ?>">delete</a>
                </td>
            </tr>
            <?php endwhile ?>
        </tbody>
    </table>

    <h1 align="center" style="margin: 30px 0 30px 0;">TABEL DRIVER</h1>
    <div id="driver"></div>
    <table width="500px" border="3" align = "center" cellpadding = "5" cellspacing="0" style = margin: 30px text-align = center>
        <thead>
            <tr>
                <th>ID DRIVER</th>
                <th>NAMA</th>
                <th>NO SIM</th>
                <th>ALAMAT</th>
            </tr>
        </thead>
        <tbody>
        <?php 
            $query = "SELECT * FROM driver";
            $result = mysqli_query(connection(),$query);
        ?>
        <?php while($data = mysqli_fetch_array($result)): ?>
            <tr align="center">
                <td><?php echo $data['id_driver'];?></td>
                <td><?php echo $data['nama'];?></td>
                <td><?php echo $data['no_sim'];?></td>
                <td><?php echo $data['alamat'];?></td>
                <td>
                    <a href="<?php echo "updateDriver.php?id_bus=".$data['id_driver']; ?>">update</a>
                    <br><br>
                    <a href="<?php echo "deleteDriver.php?id_bus=".$data['id_driver']; ?>">delete</a>
                </td>
            </tr>
            <?php endwhile ?>
        </tbody>
    </table>

    
    <h1 align="center" style="margin: 30px 0 30px 0;">TABEL KONDEKTUR</h1>
    <div id="kondektur"></div>
    <table width="400px" border="3" align = "center" cellpadding = "5" cellspacing="0" style = margin: 30px text-align = center>
        <thead>
            <tr>
                <th>ID KONDEKTUR</th>
                <th>NAMA</th>
            </tr>
        </thead>
        <tbody>
        <?php 
            $query = "SELECT * FROM kondektur";
            $result = mysqli_query(connection(),$query);
        ?>
        <?php while($data = mysqli_fetch_array($result)): ?>
            <tr align="center">
                <td><?php echo $data['id_kondektur'];?></td>
                <td><?php echo $data['nama'];?></td>
                <td>
                    <a href="<?php echo "updateKondektur.php?id_bus=".$data['id_kondektur']; ?>">update</a>
                    <br><br>
                    <a href="<?php echo "deleteKondektur.php?id_bus=".$data['id_kondektur']; ?>">delete</a>
                </td>
            </tr>
            <?php endwhile ?>
        </tbody>
    </table>

    <h1 align="center" style="margin: 30px 0 30px 0;">TABEL TRANS UPN</h1>
    <div id="trans_upn"></div>
    <table width="800px" border="3" align = "center" cellpadding = "5" cellspacing="0" style = margin: 30px text-align = center>
        <thead>
            <tr>
                <th>ID TRANS UPN</th>
                <th>ID KONDEKTUR</th>
                <th>ID BUS</th>
                <th>ID DRIVER</th>
                <th>JUMLAH KM</th>
                <th>TANGGAL</th>
            </tr>
        </thead>
        <tbody>
        <?php 
            $query = "SELECT * FROM trans_upn";
            $result = mysqli_query(connection(),$query);
        ?>
        <?php while($data = mysqli_fetch_array($result)): ?>
            <tr align="center">
                <td><?php echo $data['id_trans_upn'];?></td>
                <td><?php echo $data['id_kondektur'];?></td>
                <td><?php echo $data['id_bus'];?></td>
                <td><?php echo $data['id_driver'];?></td>
                <td><?php echo $data['jumlah_km'];?></td>
                <td><?php echo $data['tanggal'];?></td>
                <td>
                    <a href="<?php echo "updateKondektur.php?id_bus=".$data['id_kondektur']; ?>">update</a>
                    <br><br>
                    <a href="<?php echo "deleteKondektur.php?id_bus=".$data['id_kondektur']; ?>">delete</a>
                </td>
            </tr>
            <?php endwhile ?>
        </tbody>
    </table>
    </main>
</body>
</html>