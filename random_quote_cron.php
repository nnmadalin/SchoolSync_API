<?php
   header('Content-Type: application/json; charset=utf-8');
   if (true) {
      include "functions.php";
      $api_key = getEnvValue("API_KEY_QOUTE");

      $category = 'computers';
      $api_url = 'https://api.api-ninjas.com/v1/quotes?category=' . urlencode($category);

      $curl = curl_init();

      curl_setopt_array($curl, array(
         CURLOPT_URL => $api_url,
         CURLOPT_RETURNTRANSFER => true,
         CURLOPT_HTTPHEADER => array(
            'X-Api-Key: ' . $api_key
         )
      ));

      $response = curl_exec($curl);
      $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

      curl_close($curl);

      if ($status_code === 200) {
         ob_start();
            include "database.php";
         ob_end_clean();

         $json = json_decode($response, true);
         $quote = $json[0]["quote"];
         $author = $json[0]["author"];

         $sql = "UPDATE quotes SET quote = '".$quote."', author = '".$author."'";

         mysqli_query($conn, $sql);


         echo "{}";
      } else {
         echo "Error: " . $status_code . " " . $response;
      }
   }
   else{
      echo "Error: Acces interzis!";
   }