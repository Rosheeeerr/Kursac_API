<?php

// установим HTTP-заголовки
use objects\Cashier;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// подключение файлов для соединения с БД и файл с объектом Category
include_once "../config/database.php";
include_once "../objects/Currency.php";

// создание подключения к базе данных
$database = new Database();
$db = $database->getConnection();

// инициализация объекта
$сurrency= new \objects\Currency($db);

// получаем категории
$stmt = $сurrency->readAll();
$num = $stmt->rowCount();

// проверяем, найдено ли больше 0 записей
if ($num > 0) {

    // массив для записей
    $сurrency_arr = array();
    $сurrency_arr["records"] = array();

    // получим содержимое нашей таблицы
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        // извлекаем строку
        extract($row);
        $сurrency_item = array(
            "id_currency_sold" =>$id_currency_sold,
            "id_purchased_currency" =>$id_purchased_currency,
            "name_currency" =>$name_currency,
            "course_sale" =>$course_sale,
            "course_purchases" =>$course_purchases,
        );
        $сurrency_arr["records"][] = $сurrency_item;
    }
    // код ответа - 200 OK
    http_response_code(200);

    // покажем данные категорий в формате json
    echo json_encode($сurrency_arr);
} else {

    // код ответа - 404 Ничего не найдено
    http_response_code(404);

    // сообщим пользователю, что категории не найдены
    echo json_encode(array("message" => "Категории не найдены"), JSON_UNESCAPED_UNICODE);}
