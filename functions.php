<?php

function getEnvValue($key) {
   $envFile = '.env';

   if (file_exists($envFile)) {
      $envData = file_get_contents($envFile);
      $lines = explode(PHP_EOL, $envData);

      foreach ($lines as $line) {
         $parts = explode('===', $line, 2);

         if (count($parts) === 2) {
            $envKey = trim($parts[0]);
            $value = trim($parts[1]);

            if ($envKey === $key) {
                  return $value;
            }
         }
      }
   }

   return null;
}