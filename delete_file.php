<?php
   header('Content-Type: application/json; charset=utf-8');
   $token =  $_POST["token"];
   
   include "functions.php";
   $token_valid = getEnvValue("API_KEY");

   $directory = "../attachments/";
   $directory =  $directory . $_POST["token_user"] . "/" . $_POST["file"];
   if ($token_valid != $token) {
      $data =  ['message' => 'token invalid'];
   } else {
      if (is_dir($directory)){
         $files = glob($directory . '/*');
         foreach ($files as $file) {
            unlink($file); 
         }

         @rmdir($directory);
         $data =  ['message' => 'success'];
         
      }
   }

?>
