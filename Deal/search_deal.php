<?php

use objects\Cashier;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once '../config/database.php';
include_once '../objects/Deal.php';

$database = new Database();
$db = $database->getConnection();
$deal = new \objects\Deal($db);
$keywords = isset($_GET['s']) ? $_GET['s'] : "";
$stmt = $deal->search($keywords);
$num = $stmt->rowCount();
if($num>0){
    $deal_arr = array();
    $deal_arr["records"] = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $deal_item = array(
            "id_deal" => $id_deal,
            "id_purchased_currency" => $id_purchased_currency,
            "id_cashier" => $id_cashier,
            "id_client" => $id_client,
            "data_deal" => $data_deal,
            "time_deal" => $time_deal,
            "amount_currency_sold" => $amount_currency_sold,
            "amount_purchased_currency" => $amount_purchased_currency,
            "id_currency_sold" => $id_currency_sold,
        );
        array_push($deal_arr["records"], $deal_item);
    }
    http_response_code(200);
    echo json_encode($deal_arr);
}
else{
    http_response_code(404);
    echo json_encode(array("message" => "Сделка не найдена."),JSON_UNESCAPED_UNICODE);
}
