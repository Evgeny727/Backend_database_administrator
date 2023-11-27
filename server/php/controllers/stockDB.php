<?php

    include_once "db.php";
    include_once "../models/stock.php";
    include_once "../models/component_type.php";
    include_once "../controllers/component_typeDB.php";

    class StockDB extends Database{
        private $component_typeDB;

        public function __construct(){
            parent::__construct();
            $this->component_typeDB = new Component_typeDB();
        }

        public function getStock(){
            $sql = "SELECT * FROM stock";
            $result = $this->db->query($sql);
            $stocks = array();
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $typeDB = $this->component_typeDB->getComponent_typeByID($row["id_component_type"]);
                    $stock = new Stock($row["id_stock"], $row["name"], $row["quantity_avaible"], $row["price"], $typeDB);
                    array_push($stocks, $stock);
                }
            }
            return $stocks;
        }

        public function getStockByID($id){
            $sql = "SELECT * FROM stock WHERE id_stock = '$id'";
            $result = $this->db->query($sql);
            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                $typeDB = $this->component_typeDB->getComponent_typeByID($row["id_component_type"]);
                $stock = new Stock($row["id_stock"], $row["name"], $row["quantity_avaible"], $row["price"], $typeDB);
                return $stock;
            }
            return null;
        }

        public function addStock($name, $quantity_avaible, $price, $id_type){
            $result = $this->db->query("INSERT INTO stock (name, quantity_avaible, price, id_component_type) VALUES ('$name', '$quantity_avaible', '$price', '$id_type')");
            return $result;
        }

        public function deleteStock($id){
            $result = $this->db->query("DELETE FROM stock WHERE id_stock = '$id'");
            return $result;
        }

        public function updateStock($stock){
            $id = $stock->getId();
            $name = $stock->getName();
            $quantity = $stock->getQuantity();
            $price = $stock->getPrice();
            $id_type = $stock->getType()->getId();
            $typeDB = $this->component_typeDB->getComponent_typeByID($id_type);
            if($typeDB){
                $sql = "UPDATE stock SET name = '$name', quantity_avaible = '$quantity', price = '$price', id_component_type = '$id_type' WHERE id_stock = '$id'";
                $result = $this->db->query($sql);
                return $result;
            }
            return false;
        }
    }

?>