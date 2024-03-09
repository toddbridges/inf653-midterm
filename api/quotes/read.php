<?php
// headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Quote.php';

//instantiate db and connect
$database = new Database();
$db = $database->connect();

// Instantiate quote object
$quote = new Quote($db);

// author query
$result = $quote->read();


// testing to see if there are any results and exiting if not
if(!$result) {
    echo "No Quotes Found";
    return;
}

// get row count
$num = $result->rowCount();

// check if any quotes
if($num > 0) {
// 
    $quotes_arr = array();
    $quotes_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $quote_item = array(
            'id' => $id,
            'quote' => $quote, 
            'author' => $author_id,
            'category' => $category_id
        );

        //push to 'data'
        array_push($quotes_arr['data'], $quote_item);

    }

    //turn to json
    echo json_encode($quotes_arr);
    //$jsonArray = json_encode($quotes_arr);
    //return $jsonArray;
} else {
    // no posts to show
    echo json_encode(
        array('message' => 'No quotes found')
    );
}