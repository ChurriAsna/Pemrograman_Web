<?php 

function connection() {
   // membuat koneksi ke database
   $dbServer = 'localhost';
   $dbUser = 'root';
   $dbPass = '';
   $dbName = "classicmodels";

   $conn = mysqli_connect($dbServer, $dbUser, $dbPass);

   if(! $conn) {
	die('Koneksi gagal: ' . mysqli_error());
   }
   //memilih database yang akan dipakai
   mysqli_select_db($conn,$dbName);

   return $conn;
}
?>