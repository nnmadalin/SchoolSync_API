<?php
   header('Content-Type: application/json; charset=utf-8');
   $token =  $_POST["token"];
   $toke_valid = "W!WSAnXZLOhyQ6lpt=adAhsOaF5Q...";
   $directory = "../attachments/";
   $directory =  $directory . $_POST["token_user"] . "/" . $_POST["file"];
   if ($toke_valid != $token) {
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
