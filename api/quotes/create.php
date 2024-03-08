<?php
// headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Quote.php';

//instantiate db and connect
$database = new Database();
$db = $database->connect();

// Instantiate Quote object
$quote = new Quote($db);


//get raw quote data
$data = json_decode(file_get_contents("php://input"));



// $quote->id = $data->id;       
$quote->quote = $data->quote;
$quote->author_id = $data->author_id;
$quote->category_id = $data->category_id;



// create quote
if($theNewId = $quote->create()) {
    echo json_encode(
        array('id' => $theNewId, 'quote' => $quote->quote, 'author_id' => $quote->author_id, 'category_id' =>$quote->category_id)
    );
}else {
    echo json_encode(
        array('message' => 'Quote not created')
    );
}