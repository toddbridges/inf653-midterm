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

$parameters = true;  // setting a bool to test for existence of data  adjusting 21- 34
if(!$data->id) {
    $parameters = false;
}
if(!$data->author) {
    $parameters = false;
}

if($parameters == false) {
    echo json_encode(
        array('message', 'Missing Required Parameters')
    );
    return;
}

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