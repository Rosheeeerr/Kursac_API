<?php

use objects\Cashier;

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once '../config/database.php';
    include_once '../objects/Cashier.php';
    $database = new Database();
    $db = $database->getConnection();
    $cashier = new Cashier($db);
    $data = json_decode(file_get_contents("php://input"));
//    echo $data->product_name;
////    echo $data->description;
//    echo $data->price;
//    echo $data->category_id;
    if(!empty($data->id_cashier)&&!empty($data-> name_cashier)
        &&!empty($data->surname)&&!empty($data->patronymic)) {
        $cashier->id_cashier = $data->id_cashier;
        $cashier->name_cashier = $data->name_cashier;
        $cashier->surname = $data->surname;
        $cashier->patronymic = $data->patronymic;

        if ($cashier->create()) {
            http_response_code(201);
            echo json_encode(array("message" => "Кассир был добавлен"),
                JSON_UNESCAPED_UNICODE);
        }
        else
        {
            http_response_code(503);
            echo json_encode(array("message" => "Невозможно добавить кассира"),
            JSON_UNESCAPED_UNICODE);
        }
    }
    else
    {
        http_response_code(400);
        echo json_encode(array("message" => "Невозможно найти кассира.",JSON_UNESCAPED_UNICODE));
    }