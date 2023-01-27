<?php
require("model/Connection.php");
require("model/Agenda.php");

class PageController{
    private static $id;

    public static function routerControll($page, $location){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            require_once("views/$page");
        } else {
            header("Location:$location");
        };
    }

    public static function router(){
        $url = $_SERVER["REQUEST_URI"];
        $id = $_GET["id"] ?? NULL;
        self::$id = is_int($id) ? $id : (int)$id;

        switch ($url) {
            case '/':
                $conn = new Connection();
                $events = $conn->getEventos();
                
                require_once("views/home.php");
                break;
            case '/agendar':
                
                self::routerControll("agendar.php", "/");

                if(isset($_POST["submit"])){
                    extract($_POST);

                    if(!empty($date) && !empty($description)){
                        $agenda = new Agenda($description, $date);

                        $conn = new Connection();
                        $inserted = $conn->saveEvents($agenda->today, $agenda->description, $agenda->event);

                        if ($inserted) {
                            header("Location:/");
                        }
                    }else{
                        header("Location:/");
                    }
                                        
                }
                break;
            case "/editado":
                extract($_POST);
                $agenda = new Agenda($description, $date);
                $id = $submit;
                $conn = new Connection();

                $editado = $conn->actualizarEvento($id, $agenda->today, $agenda->description, $agenda->event);

                if($editado > 0){
                    header("Location:/");
                }
                break;
            case '/eliminar?id=' . $id:
                $conn = new Connection();
                $res = $conn->deleteEvento($id);
                if ($res > 0 ){
                    self::routerControll("home.php", "/");
                }
                require_once("views/eliminar.php");
                break;
            case '/editar?id=' . $id:
                $conn = new Connection();
                $even = $conn->getEventoById($id); 
                require_once("views/editar.php");
                break;
            default:
                header("Location:/");
                break;
        }
    }
    
};