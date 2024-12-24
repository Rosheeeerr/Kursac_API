<?php

namespace objects;

use PDO;

class Currency
{
    private $conn;
    private $table_name = 'currency';
    public $id_currency_sold;
    public $id_purchased_currency;
    public $name_currency;
    public $course_sale;
    public $course_purchases ;
    public function __construct($db){
        $this->conn = $db;
    }

    public function create(){
        $query="insert into ".$this->table_name." (id_currency_sold,id_purchased_currency,name_currency,course_sale,course_purchases) 
        values (:id_currency_sold,:id_purchased_currency,:name_currency,:course_sale,:course_purchases)";
        $stmt = $this->conn->prepare($query);
        $this->id_currency_sold=htmlspecialchars(strip_tags($this->id_currency_sold));
        $this->id_purchased_currency=htmlspecialchars(strip_tags($this->id_purchased_currency));
        $this->name_currency=htmlspecialchars(strip_tags($this->name_currency));
        $this->course_sale=htmlspecialchars(strip_tags($this->course_sale));
        $this->course_purchases=htmlspecialchars(strip_tags($this->course_purchases));
        $stmt->bindParam(':id_currency_sold',$this->id_currency_sold);
        $stmt->bindParam(':id_purchased_currency',$this->id_purchased_currency);
        $stmt->bindParam(':name_currency',$this->name_currency);
        $stmt->bindParam(':course_sale',$this->course_sale);
        $stmt->bindParam(':course_purchases',$this->course_purchases);
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    function update()
    {
        $query = "update " . $this->table_name . " set id_currency_sold=:id_currency_sold,
                                                 id_purchased_currency=:id_purchased_currency,
                                                 name_currency=:name_currency,
                                                 course_sale=:course_sale,
                                                 course_purchases=:course_purchases
                                                 where id_currency_sold=:id_currency_sold";
        $stmt = $this->conn->prepare($query);
        $this->id_currency_sold = htmlspecialchars(strip_tags($this->id_currency_sold));
        $this->id_purchased_currency = htmlspecialchars(strip_tags($this->id_purchased_currency));
        $this->name_currency= htmlspecialchars(strip_tags($this->name_currency));
        $this->course_sale = htmlspecialchars(strip_tags($this->course_sale));
        $this->course_purchases = htmlspecialchars(strip_tags($this-> course_purchases));

        $stmt->bindParam(':id_currency_sold',$this->id_currency_sold);
        $stmt->bindParam(':id_purchased_currency',$this->id_purchased_currency );
        $stmt->bindParam(':name_currency',$this->name_currency);
        $stmt->bindParam(':course_sale',$this->course_sale);
        $stmt->bindParam(':course_purchases',$this->course_purchases);

        if($stmt->execute()){
            return true;
        }
        return false;
    }
    function delete()
    {
        $query = "delete from ".$this->table_name." where id_currency_sold=:id_currency_sold";
        $stmt = $this->conn->prepare($query);
        $this->id_currency_sold = htmlspecialchars(strip_tags($this->id_currency_sold));
        $stmt->bindParam(':id_currency_sold',$this->id_currency_sold);
        if($stmt->execute()){
            return true;
        }
        return false;
    }
    function  search($keyword)
    {
        $query="select * from ".$this->table_name." where id_currency_sold = ?";

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
    }}
