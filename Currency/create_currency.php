<?php

use objects\Cashier;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../config/database.php';
include_once '../objects/Currency.php';
$database = new Database();
$db = $database->getConnection();
$currency = new \objects\Currency($db);
$data = json_decode(file_get_contents("php://input"));
//    echo $data->product_name;
////    echo $data->description;
//    echo $data->price;
//    echo $data->category_id;
if(!empty($data->id_currency_sold)&&!empty($data-> id_purchased_currency)
    &&!empty($data->name_currency)&&!empty($data->course_sale)&&!empty($data->course_purchases)) {
    $currency->id_currency_sold = $data->id_currency_sold;
    $currency->id_purchased_currency = $data->id_purchased_currency;
    $currency->name_currency = $data->name_currency;
    $currency->course_sale = $data->course_sale;
    $currency->course_purchases = $data->course_purchases;

    if ($currency->create()) {
        http_response_code(201);
        echo json_encode(array("message" => "Валюты была добавлена"),
            JSON_UNESCAPED_UNICODE);
    }
    else
    {
        http_response_code(503);
        echo json_encode(array("message" => "Невозможно добавить валюту"),
            JSON_UNESCAPED_UNICODE);
    }
}
else
{
    http_response_code(400);
    echo json_encode(array("message" => "Невозможно найти валюту.",JSON_UNESCAPED_UNICODE));
}