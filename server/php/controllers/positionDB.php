<?php

    include_once "db.php";
    include_once "../models/position.php";

    class PositionDB extends Database{
        public function getPosition(){
            $sql = "SELECT * FROM position";
            $result = $this->db->query($sql);
            $positions = array();
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $position = new Position($row["id_position"], $row["position"]);
                    array_push($positions, $position);
                }
            }
            return $positions;
        }

        public function getPositionByID($id){
            $sql = "SELECT * FROM position WHERE id_position = '$id'";
            $result = $this->db->query($sql);
            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                $position = new Position($row["id_position"], $row["position"]);
                return $position;
            }
            return null;
        }

        public function addPosition($position){
            $sql = "INSERT INTO position (position) VALUES ('$position')";
            $result = $this->db->query($sql);
            return $result;
        }

        public function deletePosition($id){
            $result = $this->db->query("DELETE FROM position WHERE id_position = '$id'");
            return $result;
        }

        public function updatePosition($position){
            $id = $position->getId();
            $position = $position->getPosition();
            $sql = "UPDATE position SET position = '$position' WHERE id_position = '$id'";
            $result = $this->db->query($sql);
            return $result;
        }

        public function ifAlreadyExists($position){
            $result = $this->db->query("SELECT id_position FROM position WHERE position = '$position' LIMIT 1");
            if($result->num_rows == 1){
                return true;
            }
            return false;
        }
    }

?>