<?php

    include_once "db.php";
    include_once "../models/component_type.php";

    class Component_typeDB extends Database{
        public function getComponent_type(){
            $sql = "SELECT * FROM component_type";
            $result = $this->db->query($sql);
            $types = array();
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $type = new Component_type($row["id_component_type"], $row["pc_part_type"]);
                    array_push($types, $type);
                }
            }
            return $types;
        }

        public function addType($type){
            $sql = "INSERT INTO component_type (pc_part_type) VALUES ('$type')";
            $result = $this->db->query($sql);
            return $result;
        }

        public function deleteType($id){
            $result = $this->db->query("DELETE FROM component_type WHERE id_component_type = '$id'");
            return $result;
        }

        public function updateType($type){
            $id = $type->getId();
            $type = $type->getType();
            $sql = "UPDATE component_type SET pc_part_type = '$type' WHERE id_component_type = '$id'";
            $result = $this->db->query($sql);
            return $result;
        }

        public function getComponent_typeByID($id){
            $sql = "SELECT * FROM component_type WHERE id_component_type = '$id'";
            $result = $this->db->query($sql);
            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                $type = new Component_type($row["id_component_type"], $row["pc_part_type"]);
                return $type;
            }
            return null;
        }

        public function ifAlreadyExists($type){
            $result = $this->db->query("SELECT id_component_type FROM component_type WHERE pc_part_type = '$type' LIMIT 1");
            if($result->num_rows == 1){
                return true;
            }
            return false;
        }
    }

?>