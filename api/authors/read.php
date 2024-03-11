<?php
// headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Author.php';

//instantiate db and connect
$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$author = new Author($db);

// author query
$result = $author->read();
// get row count
$num = $result->rowCount();

// check if any posts 
if($num > 0) {
// 
    $authors_arr = array();
    // $authors_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $author_item = array(
            'id' => $id,
            'author' => $author
        );

        //push to 'data'
        array_push($authors_arr, $author_item);

    }

    //turn to json
    echo json_encode($authors_arr);
} else {
    // no posts to show
    echo json_encode(
        array('message' => 'No authors found')
    );
}