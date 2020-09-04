<?php
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        include __DIR__.'/connect.php';
        $sql="DROP TABLE user_deal;DROP TABLE users;DROP TABLE deals;";
        if($db->multi_query($sql)){
            unset($_SESSION['file']);
            http_response_code(201);
        }else{
            http_response_code(400);
            echo 'could not clear';
        }
    }
?>