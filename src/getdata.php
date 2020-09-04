<?php
    include __DIR__.'/connect.php';
    $limit = $_GET['limit'];
    $offset = intval($_GET['page']) * intval($_GET['limit']);
    $table = $_GET['s']; 
    
    $sql = "SELECT * FROM $table LIMIT $limit OFFSET $offset";
    $result = $db->query($sql);
    if($result != false){
        $ud = $result -> fetch_all(MYSQLI_ASSOC);
        $result->free_result();
        $data['data']= $ud;
    }else{
        $data['data'] = [];
    }

    $sql = "SELECT COUNT(*) as count FROM $table";
    $result = $db->query($sql);
    if($result != false){
        $count = $result -> fetch_all(MYSQLI_ASSOC);
        $result->free_result();
        $data['count']= $count;
    }else{
        $data['count']= 0;
    }

    echo json_encode($data);
?>