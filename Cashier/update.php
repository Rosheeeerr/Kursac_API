<?php
use objects\Cashier;
header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: PUT");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once '../config/database.php';
    include_once '../objects/Cashier.php';
    $database = new Database();
    $db = $database->getConnection();
    $cashier = new Cashier($db);
    $data = json_decode(file_get_contents("php://input"));
    $cashier->id_cashier = $data->id_cashier;
    $cashier-> name_cashier = $data-> name_cashier;
    $cashier->surname  = $data->surname ;
    $cashier->patronymic = $data->patronymic;
    if($cashier->update()){
        http_response_code(200);
        echo json_encode(array("message" => "Кассир обновлен."),
            JSON_UNESCAPED_UNICODE);
    }
    else
    {
        http_response_code(583);
        echo json_encode(array("message" => "Невозможно обновить кассира."),
            JSON_UNESCAPED_UNICODE);
    }