<?php

    include_once "db.php";
    include_once "../models/improve.php";
    include_once "../models/component_type.php";
    include_once "../models/client.php";
    include_once "../controllers/component_typeDB.php";
    include_once "../controllers/clientDB.php";

    class ImproveDB extends Database{
        private $component_typeDB;
        private $clientDB;

        public function __construct(){
            parent::__construct();
            $this->component_typeDB = new Component_typeDB();
            $this->clientDB = new ClientDB();
        }

        public function getImprove(){
            $sql = "SELECT * FROM necessary_improvement";
            $result = $this->db->query($sql);
            $improves = array();
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $typeDB = $this->component_typeDB->getComponent_typeByID($row["id_component_type"]);
                    $userDB = $this->clientDB->getClientByID($row["id_client"]);
                    $improve = new Improve($row["id_necessary_improvement"], $typeDB, $userDB);
                    array_push($improves, $improve);
                }
            }
            return $improves;
        }

        public function getImproveByID($id){
            $sql = "SELECT * FROM necessary_improvement WHERE id_necessary_improvement = '$id'";
            $result = $this->db->query($sql);
            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                $typeDB = $this->component_typeDB->getComponent_typeByID($row["id_component_type"]);
                $userDB = $this->clientDB->getClientByID($row["id_client"]);
                $improve = new Improve($row["id_necessary_improvement"], $typeDB, $userDB);
                return $improve;
            }
            return null;
        }

        public function addImprove($type, $client){
            $result = $this->db->query("INSERT INTO necessary_improvement (id_component_type, id_client) VALUES ('$type', '$client')");
            return $result;
        }

        public function deleteImprove($id){
            $result = $this->db->query("DELETE FROM necessary_improvement WHERE id_necessary_improvement = '$id'");
            return $result;
        }

        public function updateImprove($improve){
            $id = $improve->getId();
            $id_type = $improve->getType()->getId();
            $id_client = $improve->getClient()->getId();
            $typeDB = $this->component_typeDB->getComponent_typeByID($id_type);
            $userDB = $this->clientDB->getClientByID($id_client);
            if($typeDB && $userDB){
                $sql = "UPDATE necessary_improvement SET id_component_type = '$id_type', id_client = '$id_client' WHERE id_necessary_improvement = '$id'";
                $result = $this->db->query($sql);
                return $result;
            }
            return false;
        }
    }

?>