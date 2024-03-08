<?php
// headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Author.php';

//instantiate db and connect
$database = new Database();
$db = $database->connect();

// Instantiate Author object
$author = new Author($db);

//get raw author data
$data = json_decode(file_get_contents("php://input"));

// $author->id = $data->id;       
$author->author = $data->author;


// create author
if($theNewId = $author->create()) {

    echo json_encode(
        array('id' => $theNewId, 'author' => $author->author)
    );
}else {
    echo json_encode(
        array('message' => 'Author not created')
    );
}