<?php 

  include ('koneksi.php'); 

  $status = '';
  $result = '';

  //melakukan pengecekan apakah ada form yang dipost
  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      if (isset($_GET['id_kondektur'])) {

          //query SQL
          $id_kondektur_upd = $_GET['id_kondektur'];
          $query = "DELETE FROM kondektur WHERE id_kondektur = '$id_kondektur_upd'"; 

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
  