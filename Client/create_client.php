<?php

use objects\Client;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../config/database.php';
include_once '../objects/Client.php';
$database = new Database();
$db = $database->getConnection();
$client = new Client($db);
$data = json_decode(file_get_contents("php://input"));
//    echo $data->description;
//    echo $data->price;
//    echo $data->category_id;
if(!empty($data->id_client)&&!empty($data-> name_client)
    &&!empty($data->surname)&&!empty($data->patronymic)&&!empty($data->id_passport)) {
    $client->id_client = $data->id_client;
    $client->name_client = $data->name_client;
    $client->surname = $data->surname;
    $client->patronymic = $data->patronymic;
    $client->id_passport = $data->id_passport;

    if ($client->create()) {
        http_response_code(201);
        echo json_encode(array("message" => "Клиент был добавлен"),
            JSON_UNESCAPED_UNICODE);
    }
    else
    {
        http_response_code(503);
        echo json_encode(array("message" => "Невозможно добавить клиента"),
            JSON_UNESCAPED_UNICODE);
    }
}
     else
     {
    http_response_code(400);
    echo json_encode(array("message" => "Невозможно найти клиента.",JSON_UNESCAPED_UNICODE));
     }