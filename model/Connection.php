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

    function deleteEvento($id){
        $id = htmlspecialchars($id);
        $connection = $this->conn;

        $sql = "DELETE FROM evento WHERE id = ?";
        $prepare = $connection->prepare($sql);
        $prepare->bind_param("i", $id);
        $prepare->execute();

        $deleted = $prepare->affected_rows;

        return $deleted;
    }
    function actualizarEvento($id, $date, $description, $event){
        $date = htmlspecialchars($date);
        $description = htmlspecialchars($description);
        $event = htmlspecialchars($event);
      
        $connection = $this->conn;

        $sql = "UPDATE evento SET descripcion = ?, hoy = ?, evento = ? WHERE id = ?";

        $pre = $connection->prepare($sql);
        $pre->bind_param("sssi", $description, $date, $event, $id);
        $pre->execute();
        
        $editado = $pre->affected_rows;
        return $editado;
    }


    function getEventoById($id){
        $id = htmlspecialchars($id);
        $connection = $this->conn;

        $sql = "SELECT * FROM evento WHERE id = ?";

        $pre = $connection->prepare($sql);
        $pre->bind_param("i", $id);
        $pre->execute();

        $pre->store_result();

        if ($pre->num_rows >= 1) {
            $pre->bind_result($id, $descripcion, $hoy, $evento);
            $pre->fetch();
            $pre->close();

            return (object)['id' => $id, 'descripcion' => $descripcion, 'hoy' => $hoy, 'evento'=>$evento];
        }
    }
}


