<?php
   header('Content-Type: application/json; charset=utf-8');
   include "functions.php";
   $token_valid = getEnvValue("API_KEY");

   $token =  $_POST["token"];

   if ($token_valid != $token) {
      $data =  ['message' => 'token invalid'];
   } else {
      $data =  ['message' => 'token valid'];
   }

?>
