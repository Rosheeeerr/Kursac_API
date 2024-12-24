<?php

namespace objects;

use PDO;

class Cashier
{
    private $conn;
    private $table_name = 'cashier';
    public $id_cashier;
    public $name_cashier;
    public $surname;
    public $patronymic;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create()
    {
        $query = "insert into " . $this->table_name . " (id_cashier,name_cashier,surname,patronymic) 
        values (:id_cashier,:name_cashier,:surname,:patronymic)";
        $stmt = $this->conn->prepare($query);
        $this->id_cashier = htmlspecialchars(strip_tags($this->id_cashier));
        $this->name_cashier = htmlspecialchars(strip_tags($this->name_cashier));
        $this->surname = htmlspecialchars(strip_tags($this->surname));
        $this->patronymic = htmlspecialchars(strip_tags($this->patronymic));
        $stmt->bindParam(':id_cashier', $this->id_cashier);
        $stmt->bindParam(':name_cashier', $this->name_cashier);
        $stmt->bindParam(':surname', $this->surname);
        $stmt->bindParam(':patronymic', $this->patronymic);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    function update()
    {
        $query = "update " . $this->table_name . " set id_cashier=:id_cashier,
                                                 name_cashier=:name_cashier,
                                                 surname=:surname,
                                                 patronymic=:patronymic
                                                 where id_cashier=:id_cashier";
        $stmt = $this->conn->prepare($query);
        $this->id_cashier = htmlspecialchars(strip_tags($this->id_cashier));
        $this->name_cashier = htmlspecialchars(strip_tags($this->name_cashier));
        $this->surname = htmlspecialchars(strip_tags($this->surname));
        $this->patronymic = htmlspecialchars(strip_tags($this->patronymic));

        $stmt->bindParam(':id_cashier', $this->id_cashier);
        $stmt->bindParam(':name_cashier', $this->name_cashier);
        $stmt->bindParam(':surname', $this->surname);
        $stmt->bindParam(':patronymic', $this->patronymic);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    function delete()
    {
        $query = "delete from " . $this->table_name . " where id_cashier=:id_cashier";
        $stmt = $this->conn->prepare($query);
        $this->id_cashier = htmlspecialchars(strip_tags($this->id_cashier));
        $stmt->bindParam(':id_cashier', $this->id_cashier);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    function search($keyword)
    {
        $query = "select * from " . $this->table_name. " where id_cashier = ?";

        $stmt = $this->conn->prepare($query);
        $keyword = htmlspecialchars(strip_tags($keyword));
        $keyword = "$keyword";
        $stmt->bindParam(1, $keyword);
//        $stmt->bindParam(2, $keyword);
//        $stmt->bindParam(3, $keyword);
        $stmt->execute();
        return $stmt;
    }

    public function readAll()
    {
        $query = "SELECT * FROM $this->table_name";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
}