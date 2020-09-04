<?php
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        include __DIR__.'/connect.php';

        if(!isset($_SESSION['file'])){
            http_response_code(400);
            echo 'no file imported';
            exit();
        }else{
            $lines = $_SESSION['file'];
            $sql = '';

            for($i=1; $i<count($lines); $i++){
                $fields = explode(',', $lines[$i]);

                $userFields = explode('@', $fields[0]);
                $userName = trim($userFields[0]);
                $userId = trim($userFields[1]);

                $dealFields = explode('#', $fields[1]);
                $dealName = trim($dealFields[0]);
                $dealId = trim($dealFields[1]);

                $hour = $fields[2];
                $accept = $fields[3];
                $refuse = $fields[4];
                $sql.="INSERT IGNORE INTO users(id, name) VALUES('$userId','$userName');";
                $sql.="INSERT IGNORE INTO deals(id, name) VALUES('$dealId','$dealName');";
                $sql.="INSERT INTO user_deal(user_id, deal_id, hour, accept, refuse)
                    VALUES('$userId','$dealId','$hour','$accept','$refuse');";
            }
            if($db->multi_query($sql)){
                do{}while($db->next_result());
                http_response_code(201);
                exit();
            }else{
                http_response_code(400);
                echo 'could not save file, make sure tables are created.';
                exit();
            }
        }
    }
?>