<?php
use objects\Deal;
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../config/database.php';
include_once '../objects/Deal.php';
$database = new Database();
$db = $database->getConnection();
$deal = new \objects\Deal($db);
$data = json_decode(file_get_contents("php://input"));
$deal->id_deal = $data->id_deal;
$deal->id_purchased_currency= $data->id_purchased_currency;
$deal->id_cashier= $data->id_cashier;
$deal->id_client = $data->id_client;
$deal->data_deal = $data->data_deal;
$deal->time_deal= $data->time_deal;
$deal->amount_currency_sold= $data->amount_currency_sold;
$deal->amount_purchased_currency = $data->amount_purchased_currency;
$deal->id_currency_sold= $data->id_currency_sold;
if($deal->update()){
    http_response_code(200);
    echo json_encode(array("message" => "Сделка обновленна."),
        JSON_UNESCAPED_UNICODE);
}
else
{
    http_response_code(583);
    echo json_encode(array("message" => "Невозможно обновить сделку."),
        JSON_UNESCAPED_UNICODE);
}