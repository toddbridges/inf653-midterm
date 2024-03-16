<?php
// headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

//instantiate db and connect
$database = new Database();
$db = $database->connect();

// Instantiate Category object
$category = new Category($db);

//get raw category data
$data = json_decode(file_get_contents("php://input"));

if(empty($data->category)) {
    echo json_encode(
        array('message' => 'Missing Required Parameters')
    );
    return;
}


// $author->id = $data->id;       
$category->category = $data->category;


// create category
if($theNewId = $category->create()) {
    echo json_encode(
        array('id' => $theNewId, 'category' => $category->category)
    );
}else {
    echo json_encode(
        array('message' => 'Category not created')
    );
}