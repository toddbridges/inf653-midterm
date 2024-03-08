<?php
// headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Author.php';

//instantiate db and connect
$database = new Database();
$db = $database->connect();

// Instantiate author object
$author = new Author($db);

// get id 
$author->id = isset($_GET['id']) ? $_GET['id'] : die();

// get author 
$author->read_single();



//create array
    $author_arr = array(
        'id' => $author->id,  
        'author' => $author->author
    );

    if(!$author->author) {
        echo "author_id Not Found";
    } else {

    // make json
    print_r(json_encode($author_arr));
    }
 

