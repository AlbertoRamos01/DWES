<?php

class CursoIdCurso{
    private $id_curso;
    private $descripcion;

    public function __construct($id_curso, $descripcion){
        $this->id_curso = $id_curso;
        $this->descripcion = $descripcion;
    }

    public function __get($name){
        return $this->$name;
    }

    public function __set($name, $value){
        $this->$name = $value;
    }
}