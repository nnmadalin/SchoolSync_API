<?php

      header('Content-Type: application/json; charset=utf-8');
      error_reporting(E_ERROR | E_PARSE);

   ob_start();
      include "database.php";
   ob_end_clean();

   $toke = $_POST["token"];
   
   include "functions.php";
   $token_valid = getEnvValue("API_KEY");

   if($toke == $toke_valid){
      $token_user = $_POST["token_user"];
      $new_pass = generateRandomString(16);
      $hash =  hash("sha256", $new_pass);
      $body = '
         SchoolSync
         
         Parola noua este: '.$new_pass.'
      ';
      
      try{
         $sql = "UPDATE accounts SET password = '".$hash."' WHERE token='$token_user'";
         mysqli_query($conn, $sql);
      }catch (Exception $e){;};

      $to =  $_POST["to"];      
      $mesg = mail($to, 'SchoolSync - parola noua!', $body, $from);
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
   


   function generateRandomString($length) {
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $string = '';
      $characterCount = strlen($characters);
      
      for ($i = 0; $i < $length; $i++) {
         $randomIndex = rand(0, $characterCount - 1);
         $string .= $characters[$randomIndex];
      }
      
      return $string;
   }
?>