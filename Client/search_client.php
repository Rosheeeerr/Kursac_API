<?php

use objects\Client;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once '../config/database.php';
include_once '../objects/Client.php';

$database = new Database();
$db = $database->getConnection();
$client = new Client($db);
$keywords = isset($_GET['s']) ? $_GET['s'] : "";
$stmt = $client->search($keywords);
$num = $stmt->rowCount();
if($num>0){
    $client_arr = array();
    $client_arr["records"] = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $client_item = array(
            "id_client" => $id_client,
            "name_client" => $name_client,
            "surname" => $surname,
            "patronymic" => $patronymic,
            "id_passport" => $id_passport
        );
        array_push($client_arr["records"], $client_item);
    }
    http_response_code(200);
    echo json_encode($client_arr);
}
else{
    http_response_code(404);
    echo json_encode(array("message" => "Кассир не найден."),JSON_UNESCAPED_UNICODE);
}
