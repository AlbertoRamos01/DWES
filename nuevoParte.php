<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Parte</title>
</head>
<body>
    <a href="cerrarSesion.php">Cerrar Sesion</a>
    <a href="partes.php">Inicio</a>
    <br>

    <?php
    require_once('../controller/ProfesorController.php');
    require_once('../controller/AlumnoController.php');
    require_once('../model/CursoIdCurso.php');
    require_once('../model/Profesor.php');
    require_once('../model/Curso.php');

    session_start();
    if (isset($_SESSION['usuario'])) {
        $usuario = $_SESSION['usuario'];
    } else {
        header("location:index.php");
    }

    echo 'Bienvenido, Profesor: ' . $usuario->nombre;
    ?>

    <h1>Partes de incidencias</h1>
    <p>D / Dª <?php $usuario->nombre ?> comunica que el alumno X ha cometido la siguiente falta:</p>

    <input type="text" placeholder="Ecriba el motivo aquí." size="200" >

    <input type="submit" value="Grabar Parte">
</body>
</html>