<?php
   
   if($_SERVER['REQUEST_METHOD'] == 'GET'){
      include __DIR__.'/connect.php';

      $usersTable = "CREATE TABLE IF NOT EXISTS `task3`.`users` 
         ( `id` INT NOT NULL , 
         `name` VARCHAR(255) NOT NULL , 
         PRIMARY KEY (`id`))";
      
      $dealsTable = "CREATE TABLE IF NOT EXISTS `task3`.`deals` 
         ( `id` INT NOT NULL , 
         `name` VARCHAR(255) NOT NULL , 
         PRIMARY KEY (`id`))";

      $user_dealTable = "CREATE TABLE IF NOT EXISTS `task3`.`user_deal` 
         ( `id` INT NOT NULL AUTO_INCREMENT , 
         `user_id` VARCHAR(255) NOT NULL , 
         `deal_id` VARCHAR(255) NOT NULL , 
         `accept` INT NOT NULL , 
         `refuse` INT NOT NULL , 
         `hour` DATETIME NOT NULL , 
         PRIMARY KEY (`id`), 
         FOREIGN KEY(user_id) 
         REFERENCES users(id), 
         FOREIGN KEY(deal_id) 
         REFERENCES deals(id))";

      if($db->query($usersTable) === False){
         http_response_code(500);
      }
      else if($db->query($dealsTable) === False){
         http_response_code(500);
      }
      else if($db->query($user_dealTable) === False){  
         http_response_code(500);
      }
      else{
         http_response_code(201);
      }
   }
   
?>