<?php
require("model/Connection.php");
require("model/Agenda.php");

class PageController{
    public static function routerControll($page, $location){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            require_once("views/$page");
        } else {
            header("Location:$location");
        };
    }
    public static function router(){
        $url = $_SERVER["REQUEST_URI"];
        
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
                    $agenda = new Agenda($description, $date);
                    
                    $conn = new Connection();
                    $inserted = $conn->saveEvents($agenda->today, $agenda->description, $agenda->event);

                    if($inserted){
                        header("Location:/");
                    }
                }
                break;
            default:
                require_once("views/home.php");
                break;
        }
    }
    
};