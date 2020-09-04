<?php
 if($_SERVER['REQUEST_METHOD'] == 'POST'){
     if(mime_content_type($_FILES['fileUpload']['tmp_name']) != 'text/plain'){
         http_response_code(400);
         echo 'must be a text file';
         exit();
     }else{
        $handle = fopen($_FILES['fileUpload']['tmp_name'], "r");
        $lines = [];
        if($handle){
            while(($line = fgets($handle)) !== false){
                array_push($lines, $line);
            }
            if(!feof($handle)){
                http_response_code(500);
                echo 'failed to read file';
                exit();
            }else{
                $_SESSION['file'] = $lines;
                http_response_code(200);
                exit();
            }
        }else{
            http_response_code(500);
            echo 'failed to read file';
            exit();
        }
    }
 }
?>