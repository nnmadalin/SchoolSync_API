<?php
   ob_start();
   include "database.php";
   ob_end_clean();

   $Allowedcommands = array(
      'DELETE',
      'delete',
   );
   $token  = $_POST["token"];
   
   include "functions.php";
   $token_valid = getEnvValue("API_KEY");

   if($data['Database connection'] == 'Failed'){
      $data = ['message' => 'database no connection'];
      echo json_encode( $data );
      die();
   }

   if($token_valid != $token){
      $data = ['message' => 'token invalid'];
      echo json_encode( $data );
      die();
   }

   $command = $_POST['command'];
   $params = json_decode($_POST['params']);

   $temp= explode(' ', $command);
   if(count(array_intersect($Allowedcommands, $temp)) == 0){
      $data = ['message' => 'SQL command error'];
      echo json_encode( $data );
      die();
   }

   $stmt = $conn->prepare($command);
   if(!$stmt){
      $data = ['message' => 'something went wrong - stmt prepare'];
      echo json_encode( $data );
      die();
   }   
   if (!empty($params) && is_object($params)) {
      $paramTypes = '';
      $paramValues = [];
      
      foreach ($params as $key => $value) {
         $paramValues[] = $value;

         if (is_int($value)) {
            $paramTypes .= 'i';
         } elseif (is_float($value)) {
            $paramTypes .= 'd';
         } else {
            $paramTypes .= 's';
         }
      }
      
      $paramPlaceholders = implode(', ', array_fill(0, count($paramValues), '?'));
      $commandWithParams = str_replace('?', $paramPlaceholders, $command);
      $stmt->bind_param($paramTypes, ...$paramValues);      
   }
   
   $data = ['message' => 'something went wrong'];
   
   try{
      if ($stmt->execute()) {
         $data = ['message' => 'delete success'];
         
         echo json_encode( $data );
         die();

      } else {      
         $data = ['message' => 'something went wrong - stmt execute'];
         echo json_encode( $data );
         die();
      }
   }catch(Exception $e){
      $data = ['message' => 'something went wrong - stmt execute catch'];
      echo json_encode( $data );
      die();
   }
   
   echo json_encode( $data );
   die();
