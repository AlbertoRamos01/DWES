<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Partes</title>
</head>

<body>

    <a href="cerrarSesion.php">Cerrar Sesión</a>
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

    <form action="" method="POST">
        Cursos del Profesor:
        <select name="cursos">
            <?php
            $cursos = ProfesorController::findAll($usuario->dni_p);
            foreach ($cursos as $curso) {
                echo "<option value='$curso->id_curso'>$curso->descripcion</option>";
            }
            ?>
        </select>
        <input type="submit" name="seleccionar" value="Seleccionar Curso">


    </form>


    <?php

    if (isset($_POST['seleccionar'])) {
        echo '<table border="1">';
        echo '<tr>';
        echo '<th>Alumnos</th>';
        echo '<th>Acciones</th>';
        echo '</tr>';
        foreach (AlumnoController::findalumnosByCurso($_POST['cursos']) as $a) {
            echo '<tr>';
            echo '<td>' . $a->nombre . ' ' . $a->apellidos . '</td>';
            echo '<td><form action="nuevoParte.php">
                    <input type="submit" name="nuevoParte" value="Nuevo Parte">
                </form>
                <form action="">
                    <input type="submit" name="historial" value="Historial">
                </form></td>';
            echo '</tr>';
        }

        echo '</table>';
    }
    ?>


</body>

</html>