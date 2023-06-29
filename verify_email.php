<?php
   header('Content-Type: text/html; charset=utf-8');
   ob_start();
      include "database.php";
   ob_end_clean();
   if( $_GET["token"] != ""){
      $token_user = $_GET["token"];      
      header('Content-Type: text/html; charset=utf-8');
      $sql = "UPDATE accounts SET verified ='1' WHERE token='$token_user'";

      if (mysqli_query($conn, $sql)) {
         echo "Cont activat cu succes!";
      } else {
         echo "Ceva nu a mers bine!";
      }

   }

?>

<style>
   body{
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      font-size: 25px;
      font-weight: bold;
   }
</style>