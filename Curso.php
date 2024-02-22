<?php

class Curso {
    
    private $id_curso;
    private $descripcion;
    private $totalpartes;

    public function __construct($id_curso, $descripcion, $totalpartes){
        $this->id_curso = $id_curso;
        $this->descripcion = $descripcion;
        $this->totalpartes = $totalpartes;
    }

    public function __get($name){
        return $this->$name;
    }

    public function __set($name, $value){
        $this->$name = $value;
    }
}