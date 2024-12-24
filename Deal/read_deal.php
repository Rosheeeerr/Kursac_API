<?php

// установим HTTP-заголовки
use objects\Deal;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// подключение файлов для соединения с БД и файл с объектом Category
include_once "../config/database.php";
include_once "../objects/Deal.php";

// создание подключения к базе данных
$database = new Database();
$db = $database->getConnection();

// инициализация объекта
$deal = new Deal($db);

// получаем категории
$stmt = $deal->readAll();
$num = $stmt->rowCount();

// проверяем, найдено ли больше 0 записей
if ($num > 0) {

    // массив для записей
    $deal_arr = array();
    $deal_arr["records"] = array();

    // получим содержимое нашей таблицы
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        // извлекаем строку
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
        $deal_arr["records"][] = $deal_item;
    }
    // код ответа - 200 OK
    http_response_code(200);

    // покажем данные категорий в формате json
    echo json_encode($deal_arr);
} else {

    // код ответа - 404 Ничего не найдено
    http_response_code(404);

    // сообщим пользователю, что категории не найдены
    echo json_encode(array("message" => "Сделка не найдена"), JSON_UNESCAPED_UNICODE);}
