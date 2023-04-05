<?php 

  include ('koneksi.php'); 

  $status = '';
  $result = '';

  //melakukan pengecekan apakah ada form yang dipost
  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      if (isset($_GET['id_driver'])) {

          //query SQL
          $id_driver_upd = $_GET['id_driver'];
          $query = "DELETE FROM driver WHERE id_driver = '$id_driver_upd'"; 

          //eksekusi query
          $result = mysqli_query(connection(),$query);

          if ($result) {
            $status = 'ok';
          }
          else{
            $status = 'err';
          }

          //redirect ke halaman lain
          header('Location: tampil.php?status='.$status);
      }  
  }
  