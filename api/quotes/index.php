<?php

    header('Access-Control-Allow-Origin: *');
    
    header('Content-Type: application/json');
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method === 'OPTIONS') {
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
        header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
        exit();
    }

    $data = json_decode(file_get_contents("php://input"));

    if($method == 'PUT') {
        if(!data->author_id){
            echo "author_id not found";
        }
    }

    
    /* echo $data->id . " IS THE DATA ID";       
    echo $data->quote . " is the quote";
    $data->author_id;
    $data->category_id; */
    /* if($method != 'POST') {
        // set the id on the model
        // call the read single method from the model
        // return the result
        echo "This method is not post";
    }
    
    function isValid($theId, $theModel) {

    } 
    */


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