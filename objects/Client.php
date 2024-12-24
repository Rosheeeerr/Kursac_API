<?php

namespace objects;

use PDO;

class Client
{
    private $conn;
    private $table_name = 'client';
    public $id_client ;
    public $name_client;
    public $surname;
    public $patronymic;
    public $id_passport;
    public function __construct($db){
        $this->conn = $db;
    }

    public function create(){
        $query="insert into ".$this->table_name." (id_client,name_client,surname,patronymic,id_passport) values (:id_client,:name_client,:surname,:patronymic,:id_passport)";
        $stmt = $this->conn->prepare($query);
        $this->id_client=htmlspecialchars(strip_tags($this->id_client));
        $this->name_client=htmlspecialchars(strip_tags($this->name_client));
        $this->surname=htmlspecialchars(strip_tags($this->surname));
        $this->patronymic=htmlspecialchars(strip_tags($this->patronymic));
        $this->id_passport=htmlspecialchars(strip_tags($this->id_passport));
        $stmt->bindParam(':id_client',$this->id_client);
        $stmt->bindParam(':name_client',$this->name_client);
        $stmt->bindParam(':surname',$this->surname);
        $stmt->bindParam(':patronymic',$this->patronymic);
        $stmt->bindParam(':id_passport',$this->id_passport);
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    function update()
    {
        $query = "update " . $this->table_name . " set id_client=:id_client,
                                                 name_client=:name_client,
                                                 surname=:surname,
                                                 patronymic=:patronymic,
                                                  id_passport=:id_passport
                                                 where id_client=:id_client";
        $stmt = $this->conn->prepare($query);
        $this->id_client = htmlspecialchars(strip_tags($this->id_client));
        $this->name_client = htmlspecialchars(strip_tags($this->name_client));
        $this->surname = htmlspecialchars(strip_tags($this->surname));
        $this->patronymic = htmlspecialchars(strip_tags($this->patronymic));
        $this->id_passport = htmlspecialchars(strip_tags($this->id_passport));

        $stmt->bindParam(':id_client',$this->id_client);
        $stmt->bindParam(':name_client',$this->name_client);
        $stmt->bindParam(':surname',$this->surname );
        $stmt->bindParam(':patronymic',$this->patronymic);
        $stmt->bindParam(':id_passport',$this->id_passport);

        if($stmt->execute()){
            return true;
        }
        return false;
    }
    function delete()
    {
        $query = "delete from ".$this->table_name." where id_client=:id_client";
        $stmt = $this->conn->prepare($query);
        $this->id_client = htmlspecialchars(strip_tags($this->id_client));
        $stmt->bindParam(':id_client',$this->id_client);
        if($stmt->execute()){
            return true;
        }
        return false;
    }
    function  search($keyword)
    {
        $query="select * from ".$this->table_name." where id_client = ?";

        $stmt = $this->conn->prepare($query);
        $keyword=htmlspecialchars(strip_tags($keyword));
        $keyword="$keyword";
        $stmt->bindParam(1,$keyword);
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
