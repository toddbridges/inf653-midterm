<?php
// headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

//instantiate db and connect
$database = new Database();
$db = $database->connect();

// Instantiate Category object
$category = new Category($db);

// category query
$result = $category->read();
// get row count
$num = $result->rowCount();

// check if any categories 
if($num > 0) {
// 
    $categories_arr = array();
    $categories_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $category_item = array(
            'id' => $id,
            'category' => $category
        );

        //push to 'data'
        array_push($categories_arr['data'], $category_item);

    }

    //turn to json
    echo json_encode($categories_arr);
} else {
    // no posts to show
    echo json_encode(
        array('message' => 'No categories found')
    );
}