<?php

// установим HTTP-заголовки
use objects\Cashier;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// подключение файлов для соединения с БД и файл с объектом Category
include_once "../config/database.php";
include_once "../objects/Cashier.php";

// создание подключения к базе данных
$database = new Database();
$db = $database->getConnection();

// инициализация объекта
$cashier = new Cashier($db);

// получаем категории
$stmt = $cashier->readAll();
$num = $stmt->rowCount();

// проверяем, найдено ли больше 0 записей
if ($num > 0) {

    // массив для записей
    $cashier_arr = array();
    $cashier_arr["records"] = array();

    // получим содержимое нашей таблицы
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        // извлекаем строку
        extract($row);
        $cashier_item = array(
            "id_cashier" => $id_cashier,
            "name_cashier" => $name_cashier,
            "surname " => $surname,
            "patronymic" => $patronymic,
        );
        $cashier_arr["records"][] = $cashier_item;
    }
    // код ответа - 200 OK
    http_response_code(200);

    // покажем данные категорий в формате json
    echo json_encode($cashier_arr);
} else {

    // код ответа - 404 Ничего не найдено
    http_response_code(404);

    // сообщим пользователю, что категории не найдены
    echo json_encode(array("message" => "Категории не найдены"), JSON_UNESCAPED_UNICODE);}
