<?php

    include_once "db.php";
    include_once "../models/employee.php";
    include_once "../models/position.php";
    include_once "../controllers/positionDB.php";

    class EmployeeDB extends Database{
        private $positionDB;

        public function __construct(){
            parent::__construct();
            $this->positionDB = new PositionDB();
        }

        public function getEmployee(){
            $sql = "SELECT * FROM employee";
            $result = $this->db->query($sql);
            $employees = array();
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $posDB = $this->positionDB->getPositionByID($row["id_position"]);
                    $employee = new Employee($row["id_employee"], $row["last_name"], $row["name"], $posDB);
                    array_push($employees, $employee);
                }
            }
            return $employees;
        }

        public function getEmployeeByID($id){
            $sql = "SELECT * FROM employee WHERE id_employee = '$id'";
            $result = $this->db->query($sql);
            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                $posDB = $this->positionDB->getPositionByID($row["id_position"]);
                $employee = new Employee($row["id_employee"], $row["last_name"], $row["name"], $posDB);
                return $employee;
            }
            return null;
        }

        public function addEmployee($last_name, $name, $id_position){
            $result = $this->db->query("INSERT INTO employee (last_name, name, id_position) VALUES ('$last_name', '$name', '$id_position')");
            return $result;
        }

        public function deleteEmployee($id){
            $result = $this->db->query("DELETE FROM employee WHERE id_employee = '$id'");
            return $result;
        }

        public function updateEmployee($employee){
            $id = $employee->getId();
            $last_name = $employee->getLastName();
            $name = $employee->getName();
            $position = $employee->getPosition();
            $id_position = $employee->getPosition()->getId();
            $posDB = $this->positionDB->getPositionByID($id_position);
            if($posDB){
                $sql = "UPDATE employee SET last_name = '$last_name', name = '$name', id_position = '$id_position' WHERE id_employee = '$id'";
                $result = $this->db->query($sql);
                return $result;
            }
            return false;
        }
    }

?>