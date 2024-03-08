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

// get id 
$category->id = isset($_GET['id']) ? $_GET['id'] : die();

// get category
$category->read_single();

//create array
    $category_arr = array(
        'id' => $category->id,  
        'category' => $category->category
    );

    if(!$category->category) {
        echo "category_id Not Found";
    } else {

    // make json
    print_r(json_encode($category_arr));
    }
 

