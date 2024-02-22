<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Partes</title>
</head>

<body>

    <?php
    require_once '../controller/ProfesorController.php';
    require_once '../controller/Conexion.php';
    $error = "";
    $maxIntentos = 3;

    if (isset($_COOKIE['intentos'])) {
        $intentos = $_COOKIE['intentos'];
    } else {
        $intentos = $maxIntentos;
    }

    if (isset($_POST['entrar'])) {
        if ($intentos <= 1) {
            echo "<font color='red'>USUARIO BLOQUEADO</font>";
        } else {
            $usuario =ProfesorController::comprobarUsuario($_POST['user'], $_POST['pass']);

            if ($usuario === false) {
                echo "Error en la base de datos";
            } else if ($usuario) {
                session_start();
                $_SESSION['usuario'] = $usuario;
                setcookie('intentos', $maxIntentos, 0); // Reseteamos los intentos al iniciar sesión correctamente
                header("Location: partes.php");
            } else {
                $intentos--;
                setcookie('intentos', $intentos, 0); // Actualizamos la cookie con el nuevo número de intentos
                if ($intentos > 1)
                    echo "<font color='red'>LE QUEDAN " . $intentos . " intentos</font><br>";
                else
                    echo "<font color='red'>LE QUEDA " . $intentos . " intento</font><br>";
                $error = "<font color='red'> Nombre de usuario o clave incorrectos. </font>";
            }
        }
    }

    echo $error;

    ?>

    <div style="text-align: center;">
        <h2>LOGIN</h2>
        <form action="" method="POST">
            Usuario: <input type="text" name="user" placeholder="DNI" required><!-- comment --><br><br>
            Contraseña: <input type="password" name="pass" placeholder="Contraseña" required><!-- comment --><br><br>
            <input type="submit" name="entrar" value="Entrar">
        </form>
    </div>

</body>

</html>