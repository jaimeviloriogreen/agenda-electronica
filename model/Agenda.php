<?php 

class Agenda{
    public $description;
    public $today;
    public $event;

    function __construct($description, $event){
        $this->description =  $description;
        $this->today = date("Y/m/d");
        $this->event = date($event);    
    }
}


// $hoy = new Agenda("Jugar Basketball", "1/02/2023");
// print_r($hoy);
