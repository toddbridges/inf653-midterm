<?php
// headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Quote.php';

//instantiate db and connect
$database = new Database();
$db = $database->connect();

// Instantiate author object
$quote = new Quote($db);

// get id 
if(isset($_GET['id'])) {
    $quote->id = $_GET['id'];
}

// get author 
$quote->read_single();



//create array
    $quote_arr = array(
        'id' => $quote->id,  
        'quote' => $quote->quote, 
        'author' => $quote->author_id, 
        'category' => $quote->category_id
    );

    if(!$quote->quote) {
        echo "No Quotes Found";
    } else {

    // make json
    print_r(json_encode($quote_arr));
    }
 

