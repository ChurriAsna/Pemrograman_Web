<?php 

  include ('koneksi.php'); 

  $status = '';
  $result = '';

  //melakukan pengecekan apakah ada form yang dipost
  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      if (isset($_GET['id_bus'])) {
        
          //query SQL
          $id_bus_upd = $_GET['id_bus'];
          $query = "DELETE FROM bus WHERE id_bus = '$id_bus_upd'"; 

          //eksekusi query
          $result = mysqli_query(connection(),$query);

          if ($result) {
            $status = 'ok';
          }
          else{
            $status = 'err';
          }

          //redirect ke halaman lain
          header('Location: tampil.php? status='.$status);
      }  
  }