<?php
session_start(); // llamamos a la sesion
session_unset(); // Eliminamos las variables de sesión
session_destroy(); //Eliminamos la sesión en el servidor

//Eliminamos en la parte cliente (cookie de sesión)

setcookie("PHPSESSID",0,time()-100,"/"); 
header("location:index.php");