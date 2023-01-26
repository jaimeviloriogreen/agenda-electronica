<?php

class Connection{
    private $conn;

    function __construct(){
        $this->conn = new mysqli("localhost", "usertemp", "P@ssword123", "agenda");
    }

    function getEventos(){
        $result = $this->conn->query("SELECT * FROM evento");
        $rows = [];
        while ($row = $result->fetch_assoc()) {
            array_push($rows, $row);
        }
        return $rows;
    }

    function saveEvents($date, $description, $event){
        $date = htmlspecialchars($date);
        $description = htmlspecialchars($description);
        $event = htmlspecialchars($event);
        // Queries
        try{
            $id = NULL;
            $connection = $this->conn;
            $sql = $connection->prepare("INSERT INTO evento(id, descripcion, hoy, evento) VALUES(?,?,?,?)");
            $sql->bind_param('ssss', $id, $description, $date, $event);
            $sql->execute();
            return true;
        
        }catch(mysqli_sql_exception $e){
            echo $e->getMessage();
            return NULL;
        }
    }
}


