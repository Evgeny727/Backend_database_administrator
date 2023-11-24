<?php
    $conn = new mysqli("db", "user", "password", "appDB");
    if($conn->connect_errno){
        echo "Failed to connect to MySQL: " . $conn->connect_error;
    }
?>