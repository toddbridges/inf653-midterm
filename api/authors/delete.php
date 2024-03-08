<?php
// headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Author.php';

//instantiate db and connect
$database = new Database();
$db = $database->connect();

// Instantiate author object
$author = new Author($db);

//get raw posted data
$data = json_decode(file_get_contents("php://input"));

// set ID to update
$author->id = $data->id;

$theId = $author->id;

// delete author
if($author->delete()) {
    echo json_encode(
        array('id' => $theId)
    );
}else {
    echo json_encode(
        array('message' => 'No Quotes Found')
    );
}