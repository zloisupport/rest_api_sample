<?php

    // required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    //get database connection
    include_once '../config/database.php';
    include_once '../objects/product.php';

    $database = new Database();
    $db= $database->getConnection();

    $product = new Product($db);

    //get id of product to be edited

  $data = json_decode(file_get_contents("php://input"));

  //set  ID property of product to be edited
    $product->id=$data->id;

    //set product property values
    $product->name=$data->name;
    $product->price=$data->price;
    $product->description=$data->description;
    $product->category_id=$data->category_id;


    if($product->update()){
        //set response code 200
        http_response_code(200);

        // tell the user
        echo json_encode(array("message"=>"200 - Product was updated"));

    }
    //if unable to update the product , tell the user
    else{
        //set response code 503
        http_response_code(503);

        // tell the user
        echo json_encode(array("message"=>" 503 - Unable to update product"));
    }
    ?>