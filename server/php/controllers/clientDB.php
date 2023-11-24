<?php

    include_once "../db.php";
    include_once "../models/client.php";

    class ClientDB extends Database{
        public function getClient(){
            $sql = "SELECT * FROM client";
            $result = $this->db->query($sql);
            $clients = array();
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $client = new Client($row["id_client"], $row["email"], $row["last_name"], $row["name"], $row["password"], $row["birth_date"], $row["account_number"]);
                    array_push($clients, $client);
                }
            }
            return $clients;
        }

        public function getClientByID($id){
            $sql = "SELECT * FROM client WHERE id_client = '$id'";
            $result = $this->db->query($sql);
            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                $client = new Client($row["id_client"], $row["email"], $row["last_name"], $row["name"], $row["password"], $row["birth_date"], $row["account_number"]);
                return $client;
            }
            return null;
        }

        public function addClient($email, $last_name, $name, $password, $birth_date, $account_number){
            $result = $this->db->query("INSERT INTO client (email, last_name, name, password, birth_date, account_number) VALUES ('$email', '$last_name', '$name', '$password', '$birth_date', '$account_number')");
            return $result;
        }

        public function deleteClient($id){
            $result = $this->db->query("DELETE FROM client WHERE id_client = '$id'");
            return $result;
        }

        public function updateClient($client){
            $id = $client->getId();
            $email = $client->getEmail();
            $last_name = $client->getLastName();
            $name = $client->getName();
            $password = $client->getPassword();
            $birth_date = $client->getBirthDate();
            $account_number = $client->getAccountNumber();
            $sql = "UPDATE client SET email = '$email', last_name = '$last_name', name = '$name', password = '$password', birth_date = '$birth_date', account_number = '$account_number' WHERE id_client = '$id'";
            $result = $this->db->query($sql);
            return $result;
        }

        public function ifAlreadyExists($email){
            $result = $this->db->query("SELECT id_client FROM client WHERE email = '$email' LIMIT 1");
            if($result->num_rows == 1){
                return true;
            }
            return false;
        }
    }

?>