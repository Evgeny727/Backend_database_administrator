<?php

    include_once "../db.php";
    include_once "../models/warranty.php";

    class WarrantyDB extends Database{
        public function getWarranty(){
            $sql = "SELECT * FROM warranty_certificate";
            $result = $this->db->query($sql);
            $warrantys = array();
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $warranty = new Warranty($row["id_warranty_certificate"], $row["id_order"], $row["valid_until"]);
                    array_push($warrantys, $warranty);
                }
            }
            return $warrantys;
        }

        public function getWarrantyByID($id){
            $sql = "SELECT * FROM warranty_certificate WHERE id_warranty_certificate = '$id'";
            $result = $this->db->query($sql);
            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                $warranty = new Warranty($row["id_warranty_certificate"], $row["id_order"], $row["valid_until"]);
                return $warranty;
            }
            return null;
        }

        public function addWarranty($id_order, $valid_until){
            $sql = "INSERT INTO warranty_certificate (id_order, valid_until) VALUES ('$id_order', '$valid_until')";
            $result = $this->db->query($sql);
            return $result;
        }

        public function deleteWarranty($id){
            $result = $this->db->query("DELETE FROM warranty_certificate WHERE id_warranty_certificate = '$id'");
            return $result;
        }

        public function updateWarranty($warranty){
            $id = $warranty->getId();
            $id_order = $warranty->getIdOrder();
            $valid_until = $warranty->getValidUntil();
            $sql = "UPDATE warranty_certificate SET id_order = '$id_order', valid_until = '$valid_until' WHERE id_warranty_certificate = '$id'";
            $result = $this->db->query($sql);
            return $result;
        }

        public function ifAlreadyExists($id_order, $valid_until){
            $result = $this->db->query("SELECT id_warranty_certificate FROM warranty_certificate WHERE id_order = '$id_order' AND valid_until = '$valid_until' LIMIT 1");
            if($result->num_rows == 1){
                return true;
            }
            return false;
        }
    }

?>