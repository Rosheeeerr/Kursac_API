<?php
use objects\Client;
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../config/database.php';
include_once '../objects/Client.php';
$database = new Database();
$db = $database->getConnection();
$client = new Client($db);
$data = json_decode(file_get_contents("php://input"));
$client->id_client = $data->id_client;
$client-> name_client = $data-> name_client;
$client->surname  = $data->surname ;
$client->patronymic = $data->patronymic;
$client->id_passport = $data->id_passport;
if($client->update()){
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