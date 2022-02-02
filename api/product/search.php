<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    //get database connection
    //include_once '../config/core.php';
    include_once '../config/database.php';
    include_once '../objects/product.php';

    $database = new Database();
    $db= $database->getConnection();

    $product = new Product($db);

    $keywords= isset($_GET['s']) ? $_GET['s']:"";

    $stmt = $product->search($keywords);
    $num = $stmt->rowCount();

    //check id more than 0 record found
    if($num>0){
        //product array
        $product_arr= array();
        $product_arr["records"]=array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            //extract row
            // this will mkae $row['name'] to
            //just $name only
            extract($row);
            $product_item = array(
                "id"=>$id,
                "name"=>$name,
                "description" => html_entity_decode($description),
                "price"=>$price,
                "category_id"=>$category_id,
                "category_name"=>$category_name
            );
            array_push($product_arr['records'],$product_item);
        }
        // set response code - 200 OK
        http_response_code(200);
        // show products data in json format
        echo json_encode($product_arr);
    }
    else{
        // set response code - 404 not found
        http_response_code(404);
        // show products data in json format
        echo json_encode(array("message"=>"not found"));
    }
?>