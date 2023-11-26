<?php

    include_once "../db.php";
    include_once "../models/order.php";
    include_once "../models/client.php";
    include_once "../models/employee.php";
    include_once "../models/order_status.php";
    include_once "../controllers/clientDB.php";
    include_once "../controllers/employeeDB.php";
    include_once "../controllers/order_statusDB.php";

    class OrderDB extends Database{
        private $clientDB;
        private $employeeDB;
        private $statusDB;

        public function __construct(){
            parent::__construct();
            $this->clientDB = new ClientDB();
            $this->employeeDB = new EmployeeDB();
            $this->statusDB = new StatusDB();
        }

        public function getOrder(){
            $sql = "SELECT * FROM orders";
            $result = $this->db->query($sql);
            $orders = array();
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $userDB = $this->clientDB->getClientByID($row["id_client"]);
                    $jobDB = $this->employeeDB->getEmployeeByID($row["id_employee"]);
                    $order_statusDB = $this->statusDB->getStatusByID($row["id_order_status"]);
                    $order = new Order($row["id_order"], $userDB, $jobDB, $order_statusDB, $row["total_price"]);
                    array_push($orders, $order);
                }
            }
            return $orders;
        }

        public function getOrderByID($id){
            $sql = "SELECT * FROM orders WHERE id_order = '$id'";
            $result = $this->db->query($sql);
            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                $userDB = $this->clientDB->getClientByID($row["id_client"]);
                $jobDB = $this->employeeDB->getEmployeeByID($row["id_employee"]);
                $order_statusDB = $this->statusDB->getStatusByID($row["id_order_status"]);
                $order = new Order($row["id_order"], $userDB, $jobDB, $order_statusDB, $row["total_price"]);
                return $order;
            }
            return null;
        }

        public function addOrder($id_client, $id_employee, $id_status, $price){
            $result = $this->db->query("INSERT INTO orders (id_client, id_employee, id_order_status, total_price) VALUES ('$id_client', '$id_employee', '$id_status', '$price')");
            return $result;
        }

        public function deleteOrder($id){
            $result = $this->db->query("DELETE FROM orders WHERE id_order = '$id'");
            return $result;
        }

        public function updateOrder($order){
            $id = $order->getId();
            $id_client = $order->getClient()->getId();
            $id_employee = $order->getEmployee()->getId();
            $id_status = $order->getStatus()->getId();
            $price = $order->getPrice();
            $userDB = $this->clientDB->getClientByID($id_client);
            $jobDB = $this->employeeDB->getEmployeeByID($id_employee);
            $order_statusDB = $this->statusDB->getStatusByID($id_status);
            if($userDB && $jobDB && $order_statusDB){
                $sql = "UPDATE orders SET id_client = '$id_client', id_employee = '$id_employee', id_order_status = '$id_status', total_price = '$price' WHERE id_order = '$id'";
                $result = $this->db->query($sql);
                return $result;
            }
            return false;
        }
    }

?>