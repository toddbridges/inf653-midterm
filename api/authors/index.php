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
    require_once '../../models/Author.php';
    require_once '../../config/Database.php';
    //$db = new Database();
    // $conn = $db->connect();

    $theData = json_decode(file_get_contents("php://input"));
    
    

    if ($method == 'GET') {
        if (isset($_GET['id'])) {
            include_once 'read_single.php';
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