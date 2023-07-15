<?php

      header('Content-Type: application/json; charset=utf-8');
      error_reporting(E_ERROR | E_PARSE);

   $token = $_POST["token"];
   include "functions.php";
   $token_valid = getEnvValue("API_KEY");

   if($token == $token_valid){
      $from = "From: noreply@schoolsync.nnmadalin.me" . "\r\n";
      $token_user = $_POST["token_user"];
      $token_user = "https://schoolsync.nnmadalin.me/api/verify_email.php?token=" . $token_user;
      $body = '
         Apasa aici pentru a verifica!
         '.$token_user.'
         
      ';
      
      $to =  $_POST["to"];      
      $mesg = mail($to, 'Verifica email!', $body, $from);
      if( $mesg == true ) {
         $data = ['message' => 'success'];
      }else {
         $data = ['message' => 'error'];
      }
   }
   else{
      $data = ['message' => 'token invalid'];
   }

   echo json_encode( $data );
   
?>