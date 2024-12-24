<?php

// установим HTTP-заголовки
use objects\Client;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// подключение файлов для соединения с БД и файл с объектом Category
include_once "../config/database.php";
include_once "../objects/Client.php";

// создание подключения к базе данных
$database = new Database();
$db = $database->getConnection();

// инициализация объекта
$client= new Client($db);

// получаем категории
$stmt = $client->readAll();
$num = $stmt->rowCount();

// проверяем, найдено ли больше 0 записей
if ($num > 0) {

    // массив для записей
    $client_arr = array();
    $client_arr["records"] = array();

    // получим содержимое нашей таблицы
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        // извлекаем строку
        extract($row);
        $client_item = array(
            "id_client" => $id_client,
            "name_client" => $name_client,
            "surname " => $surname,
            "patronymic" => $patronymic,
            "id_passport" => $id_passport,
        );
        $client_arr["records"][] = $client_item;
    }
    // код ответа - 200 OK
    http_response_code(200);

    // покажем данные категорий в формате json
    echo json_encode($client_arr);
} else {

    // код ответа - 404 Ничего не найдено
    http_response_code(404);

    // сообщим пользователю, что категории не найдены
    echo json_encode(array("message" => "Категории не найдены"), JSON_UNESCAPED_UNICODE);}
