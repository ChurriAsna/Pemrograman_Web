<?php 

function connection() {
   // membuat koneksi ke database system
   $dbServer = 'localhost';
   $dbUser = 'root';
   $dbPass = '';
   $dbName = "transupn";

   $conn = mysqli_connect($dbServer, $dbUser, $dbPass);

   if(! $conn) {
      die('Connection Failed: ' . mysqli_error());
   } else {
   }
   
   //memilih database yang akan dipakai
   mysqli_select_db($conn,$dbName);
	
   return $conn;
}