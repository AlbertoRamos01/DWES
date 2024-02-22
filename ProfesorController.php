<?php

require_once('../controller/Conexion.php');
require_once('../model/Profesor.php');
require_once('../model/CursoIdCurso.php');

class ProfesorController
{

    public static function comprobarUsuario($user, $pass)
    {
        $usuario = null;
        try {
            $conex = new Conexion();
            $stmt = $conex->prepare("select * from profesores where dni_p = ?");
            $stmt->bind_param("s", $user);
            $stmt->execute();
            $resultado = $stmt->get_result()->fetch_object();
            if ($resultado) {
                if (md5($pass) == $resultado->pass) {
                    $usuario = new Profesor(
                        $resultado->dni_p,
                        $resultado->nombre,
                        $resultado->apellidos,
                        $resultado->pass,
                        $resultado->bloqueado,
                        $resultado->hora_bloqueo,
                        $resultado->intentos
                    );
                }
            }
            $stmt->close();
            $conex->close();
        } catch (Exception $ex) {
            echo "Fallo en comprobarUsuario" . $ex->getMessage();
        }
        return $usuario;
    }

    public static function findAll($user) {
        $cursos = [];
        
        try {
            $conex = new Conexion();
            $resultado = $conex->query("SELECT c.descripcion, c.id_curso FROM prof_curso pc JOIN curso c ON pc.id_curso = c.id_curso WHERE pc.dni_p = '$user'");
            while ($fila = $resultado->fetch_object()) {
                $cursos[] = new CursoIdCurso($fila->id_curso, $fila->descripcion);
            }
            $conex->close();
        } catch (Exception $ex) {
            echo 'Error en findAll: ' . $ex->getMessage(); 
        }
        return $cursos;
    }
}
