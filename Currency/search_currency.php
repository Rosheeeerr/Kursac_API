<?php

use objects\Currency;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once '../config/database.php';
include_once '../objects/Currency.php';

$database = new Database();
$db = $database->getConnection();
$currency = new Currency($db);
$keywords = isset($_GET['s']) ? $_GET['s'] : "";
$stmt = $currency->search($keywords);
$num = $stmt->rowCount();
if($num>0){
    $currency_arr = array();
    $currency_arr["records"] = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $currency_item = array(
            "id_currency_sold " => $id_currency_sold ,
            "id_purchased_currency" => $id_purchased_currency,
            "name_currency" => $name_currency,
            "course_sale" => $course_sale,
            "course_purchases" => $course_purchases
        );
        array_push($currency_arr["records"], $currency_item);
    }
    http_response_code(200);
    echo json_encode($currency_arr);
}
else{
    http_response_code(404);
    echo json_encode(array("message" => "Валюта не найдена."),JSON_UNESCAPED_UNICODE);
}
