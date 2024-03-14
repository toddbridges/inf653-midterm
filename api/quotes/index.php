<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method === 'OPTIONS') {
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
        header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
        exit();
    }

    /* $data = json_decode(file_get_contents("php://input"));

    include_once '../../config/Database.php';
    include_once '../../models/Quote.php';
    include_once '../../functions/isValid.php';
    include_once 'read_single.php'; */

    
    //$database = new Database();
    //$db = $database->connect();

    // Instantiate author object
    //$quote = new Quote($db);


    // get author 
    //$quote->read_single();
    //$quote->isValid($data->id, )


    
    /* echo $data->id . " IS THE DATA ID";       
    echo $data->quote . " is the quote";
    $data->author_id;
    $data->category_id; */


        // beginning of change
/*         require_once '../../models/Author.php';
        require_once '../../config/Database.php';
        $db = new Database();
        $conn = $db->connect();
    
        $theData = json_decode(file_get_contents("php://input"));
        $theData->id;
    
        $auth = new Author( $conn );
        $sql = 'SELECT * from authors where id = ' . $theData->id;
        $st = $conn->prepare($sql);
        $st->execute();
        $theRow = $st->fetch(PDO::FETCH_ASSOC);
        if(!$theRow) {
            echo json_encode(
                array('message' => 'author_id Not Found')
            );
        } */
    


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