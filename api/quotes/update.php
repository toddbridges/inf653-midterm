<?php
// headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Quote.php';

//instantiate db and connect
$database = new Database();
$db = $database->connect();

// Instantiate quote object
$quote = new Quote($db);

//get raw posted data
$data = json_decode(file_get_contents("php://input"));

if(empty($data->author_id)) {
    echo json_encode(
        array('message' => 'Missing Required Parameters')
    );
    return;
} 

if(empty($data->quote)) {
    echo json_encode(
        array('message' => 'Missing Required Parameters')
    );
    return;
} 

if(empty($data->category_id)) {
    echo json_encode(
        array('message' => 'Missing Required Parameters')
    );
    return;
} 

// set ID to update
$quote->id = $data->id;
$quote->quote = $data->quote;
$quote->author_id = $data->author_id;
$quote->category_id = $data->category_id;



// update quote
if($quote->update()) {
    echo json_encode(   // ('message' => 'quote has been updated')
        array('id' => $quote->id, 'quote' => $quote->quote, 'author_id' => $quote->author_id, 'category_id' => $quote->category_id)
    );
}else {
    echo json_encode(
        array('message' => 'quote_id Not Found')
    );
}
