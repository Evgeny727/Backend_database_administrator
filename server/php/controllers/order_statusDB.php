<?php

    include_once "db.php";
    include_once "../models/order_status.php";

    class StatusDB extends Database{
        public function getStatus(){
            $sql = "SELECT * FROM order_status";
            $result = $this->db->query($sql);
            $statuses = array();
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $status = new Status($row["id_order_status"], $row["status"]);
                    array_push($statuses, $status);
                }
            }
            return $statuses;
        }

        public function getStatusByID($id){
            $sql = "SELECT * FROM order_status WHERE id_order_status = '$id'";
            $result = $this->db->query($sql);
            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                $status = new Status($row["id_order_status"], $row["status"]);
                return $status;
            }
            return null;
        }

        public function addStatus($status){
            $sql = "INSERT INTO order_status (status) VALUES ('$status')";
            $result = $this->db->query($sql);
            return $result;
        }

        public function deleteStatus($id){
            $result = $this->db->query("DELETE FROM order_status WHERE id_order_status = '$id'");
            return $result;
        }

        public function updateStatus($status){
            $id = $status->getId();
            $status = $status->getStatus();
            $sql = "UPDATE order_status SET status = '$status' WHERE id_order_status = '$id'";
            $result = $this->db->query($sql);
            return $result;
        }

        public function ifAlreadyExists($status){
            $result = $this->db->query("SELECT id_order_status FROM order_status WHERE status = '$status' LIMIT 1");
            if($result->num_rows == 1){
                return true;
            }
            return false;
        }
    }

?>