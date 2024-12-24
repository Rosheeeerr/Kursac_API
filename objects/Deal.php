<?php

namespace objects;

use PDO;

class Deal
{
    private $conn;
    private $table_name = 'deal';
    public $id_deal;
    public $id_purchased_currency;
    public $id_cashier;
    public $id_client;
    public $data_deal ;
    public $time_deal;
    public $amount_currency_sold;
    public $amount_purchased_currency;
    public $id_currency_sold;
    public function __construct($db){
        $this->conn = $db;
    }

    public function create(){
        $query="insert into ".$this->table_name." (id_deal,id_purchased_currency,id_cashier,id_client,data_deal,time_deal,amount_currency_sold,amount_purchased_currency,id_currency_sold) 
        values (:id_deal,:id_purchased_currency,:id_cashier,:id_client,:data_deal,:time_deal,:amount_currency_sold,:amount_purchased_currency,:id_currency_sold)";
        $stmt = $this->conn->prepare($query);
        $this->id_deal=htmlspecialchars(strip_tags($this->id_deal));
        $this->id_purchased_currency=htmlspecialchars(strip_tags($this->id_purchased_currency));
        $this->id_cashier=htmlspecialchars(strip_tags($this->id_cashier));
        $this->id_client=htmlspecialchars(strip_tags($this->id_client));
        $this->data_deal=htmlspecialchars(strip_tags($this->data_deal));
        $this->time_deal=htmlspecialchars(strip_tags($this->time_deal));
        $this->amount_currency_sold=htmlspecialchars(strip_tags($this->amount_currency_sold));
        $this->amount_purchased_currency=htmlspecialchars(strip_tags($this->amount_purchased_currency));
        $this->id_currency_sold=htmlspecialchars(strip_tags($this->id_currency_sold));

        $stmt->bindParam(':id_deal',$this->id_deal);
        $stmt->bindParam(':id_purchased_currency',$this->id_purchased_currency);
        $stmt->bindParam(':id_cashier',$this->id_cashier);
        $stmt->bindParam(':id_client',$this->id_client);
        $stmt->bindParam(':data_deal',$this->data_deal);
        $stmt->bindParam(':time_deal',$this->time_deal);
        $stmt->bindParam(':amount_currency_sold',$this->amount_currency_sold);
        $stmt->bindParam(':amount_purchased_currency',$this->amount_purchased_currency);
        $stmt->bindParam(':id_currency_sold',$this->id_currency_sold);
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    function update()
    {
        $query = "update " . $this->table_name . " set id_deal=:id_deal,
                                                 id_purchased_currency=:id_purchased_currency,
                                                 id_cashier=:id_cashier,
                                                 id_client=:id_client,
                                                 data_deal=:data_deal,
                                                 time_deal=:time_deal,
                                                 amount_currency_sold=:amount_currency_sold,
                                                 amount_purchased_currency=:amount_purchased_currency,
                                                 id_currency_sold=:id_currency_sold
                                                 where id_deal=:id_deal";
        $stmt = $this->conn->prepare($query);
        $this->id_deal=htmlspecialchars(strip_tags($this->id_deal));
        $this->id_purchased_currency=htmlspecialchars(strip_tags($this->id_purchased_currency));
        $this->id_cashier=htmlspecialchars(strip_tags($this->id_cashier));
        $this->id_client=htmlspecialchars(strip_tags($this->id_client));
        $this->data_deal=htmlspecialchars(strip_tags($this->data_deal));
        $this->time_deal=htmlspecialchars(strip_tags($this->time_deal));
        $this->amount_currency_sold=htmlspecialchars(strip_tags($this->amount_currency_sold));
        $this->amount_purchased_currency=htmlspecialchars(strip_tags($this->amount_purchased_currency));
        $this->id_currency_sold=htmlspecialchars(strip_tags($this->id_currency_sold));


        $stmt->bindParam(':id_deal',$this->id_deal);
        $stmt->bindParam(':id_purchased_currency',$this->id_purchased_currency);
        $stmt->bindParam(':id_cashier',$this->id_cashier);
        $stmt->bindParam(':id_client',$this->id_client);
        $stmt->bindParam(':data_deal',$this->data_deal);
        $stmt->bindParam(':time_deal',$this->time_deal);
        $stmt->bindParam(':amount_currency_sold',$this->amount_currency_sold);
        $stmt->bindParam(':amount_purchased_currency',$this->amount_purchased_currency);
        $stmt->bindParam(':id_currency_sold',$this->id_currency_sold);

        if($stmt->execute()){
            return true;
        }
        return false;
    }
    function delete()
    {
        $query = "delete from ".$this->table_name." where id_deal=:id_deal";
        $stmt = $this->conn->prepare($query);
        $this->id_deal = htmlspecialchars(strip_tags($this->id_deal));
        $stmt->bindParam(':id_deal',$this->id_deal);
        if($stmt->execute()){
            return true;
        }
        return false;
    }
    function  search($keyword)
    {
        $query="select * from ".$this->table_name." where id_deal = ?";

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
