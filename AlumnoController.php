<?php

require_once('../controller/Conexion.php');
require_once('../model/Alumno.php');
class AlumnoController {

    public static function findalumnosByCurso($id_curso) {
        $alumnos = [];
        
        try {
            $conex = new Conexion();
            $result = $conex->query("SELECT * from alumnos where id_curso = '$id_curso'");
            while($fila = $result->fetch_object()){
                $alumnos[] = new Alumno($fila->dni_a, $fila->nombre, $fila->apellidos, $fila->direccion, $fila->telf, $fila->id_curso);
            }
            $conex->close();
        } catch (Exception $ex) {
            echo 'Error en findAlumnosByCurso: ' . $ex->getMessage(); 
        }
        return $alumnos;
    }
}