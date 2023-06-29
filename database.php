<?php
   header('Content-Type: application/json; charset=utf-8');
   error_reporting(E_ERROR | E_PARSE);

   $servername = "localhost";
   $username = "nnmadali_schoolsync";
   $password = "";
   $dbname = "nnmadali_schoolsync";

   $conn = new mysqli($servername, $username, $password, $dbname);
   mysqli_set_charset($conn, "utf8");

   $data;

   if ($conn->connect_error) {
      $data = ['Database connection' => 'Failed'];
      http_response_code(500);
   }
      $data = ['Database connection' => 'Success'];
   
   echo json_encode($data);
?>
