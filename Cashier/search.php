<?php

use objects\Cashier;

header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    include_once '../config/database.php';
    include_once '../objects/Cashier.php';

    $database = new Database();
    $db = $database->getConnection();
    $cashier = new Cashier($db);
    $keywords = isset($_GET['s']) ? $_GET['s'] : "";
    $stmt = $cashier->search($keywords);
    $num = $stmt->rowCount();
    if($num>0){
        $cashier_arr = array();
        $cashier_arr["records"] = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $cashier_item = array(
                "id_cashier" => $id_cashier,
                "name_cashier" => $name_cashier,
                "surname" => $surname,
                "patronymic" => $patronymic
            );
            array_push($cashier_arr["records"], $cashier_item);
        }
        http_response_code(200);
        echo json_encode($cashier_arr);
    }
    else{
        http_response_code(404);
        echo json_encode(array("message" => "Кассир не найден."),JSON_UNESCAPED_UNICODE);
    }
