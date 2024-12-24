<?php
use objects\Client;
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../config/database.php';
include_once '../objects/Currency.php';
$database = new Database();
$db = $database->getConnection();
$currency = new \objects\Currency($db);
$data = json_decode(file_get_contents("php://input"));
$currency->id_currency_sold = $data->id_currency_sold;
$currency->id_purchased_currency = $data->id_purchased_currency;
$currency->name_currency= $data->name_currency ;
$currency->course_sale = $data->course_sale ;
$currency->course_purchases = $data->course_purchases;
if($currency->update()){
    http_response_code(200);
    echo json_encode(array("message" => "Валюта была обновленна."),
        JSON_UNESCAPED_UNICODE);
}
else
{
    http_response_code(583);
    echo json_encode(array("message" => "Невозможно обновить валюту."),
        JSON_UNESCAPED_UNICODE);
}