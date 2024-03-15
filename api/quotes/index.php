<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method === 'OPTIONS') {
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
        header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
        exit();
    }


        // beginning of change
        require_once '../../models/Quote.php';
        require_once '../../config/Database.php';
        $db = new Database();
        $conn = $db->connect();
    
        $data = json_decode(file_get_contents("php://input"));
        
        if(isset($data->author_id)) {
    
            $quot = new Quote( $conn );
            $sql = 'SELECT * from authors where id = ' . $data->author_id;
            $st = $conn->prepare($sql);
            $st->execute();
            $theRow = $st->fetch(PDO::FETCH_ASSOC);
            echo $theRow;
            if((!$theRow) && ($method == 'POST')) {
                echo json_encode(
                    array('message' => 'author_id Not Found')
                );
                die();
            }
        }
        // end of change
    


    if ($method == 'GET') {
         if (isset($_GET['id'])) {
             include_once 'read_single.php';
         } else if (isset($_GET['author_id'])){ 
             include_once 'read.php';
         } else if (isset($_GET['category_id'])){ 
             include_once 'read.php';
         } else {
             include_once 'read.php';
         } 
     } else if($method == 'POST') {
         include_once 'create.php';
     } else if ($method == 'PUT') {
         include_once 'update.php';
     } else if ($method == 'DELETE') {
         include_once 'delete.php';
     }